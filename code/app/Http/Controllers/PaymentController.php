<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use Illuminate\Support\Facades\URL;
use App\Http\Sanitize;
use App\Http\ConvertCurrency;

class PaymentController extends Controller
{

    public function index()
    {
        return view('payment.index');
    }

    public function viewPaymentRequest( $id )
    {
        $id = Sanitize::Input( $id );

        $paymentRequest = \App\PaymentRequest::find($id);
        if ( !isset($paymentRequest) ) {
            return abort(404);
        }

        $paymentResponses = \App\PaymentResponse::where('request_id', $paymentRequest->id)->get();

        return view('payment.view', [
            'request' => $paymentRequest,
            'responses' => $paymentResponses
        ]);
    }

    public function addPOST( Request $request )
    {
        $paymentRequest = new \App\PaymentRequest;

        $paymentRequest->text = Sanitize::Input( $request->text );
        $paymentRequest->money_amount = Sanitize::Input( $request->money_amount );
        $paymentRequest->possible_payments = Sanitize::Input( $request->possible_payments );

        $paymentRequest->owner_id = auth()->user()->id;
        $paymentRequest->created_at = date( 'Y-m-d H:i:s' );
        $paymentRequest->updated_at = date( 'Y-m-d H:i:s' );

        $paymentRequest->location = '';
        $paymentRequest->completed_payments = 0;

        $paymentRequest->save();

        $request->session()->flash('sentjeSuccess', [__('payment.success'), __('payment.sentjeAdded')]);
        return redirect('');
    }

    public function receivePayment( $id )
    {
        $id = Sanitize::Input( $id );

        $paymentRequest = \App\PaymentRequest::find($id);
        
        if ( !isset($paymentRequest) || $paymentRequest['completed_payments'] >= $paymentRequest['possible_payments'] ) {
            return abort(404);
        }
        
        $receiver = \App\User::find( $paymentRequest['owner_id'] );
        
        if ( !isset($receiver) ) {
            return abort(503);
        }
        
        return view('payment.pay', [
            'paymentRequest' => $paymentRequest,
            'receiver' => $receiver['name']
        ]);
    }

    public function setupPayment( Request $request, $id )
    {
        $id = Sanitize::Input( $id );

        if ( isset( $request->respondername ) ) {
            $respondername = Sanitize::Input( $request->respondername );
        } else {
            $respondername = 'unknown';
        }

        if ( isset( $request->loccheckbox ) && isset( $request->locinfo ) ) {
            $locinfo = explode( '|', Sanitize::Input( $request->locinfo ) );
        } else {
            $locinfo = 'unknown';
        }

        $paymentRequest = \App\PaymentRequest::find($id);
        
        if ( !isset($paymentRequest) ) {
            return abort(404);
        }
        
        $mollie = new MollieAPIClient;
        $mollie->setApiKey("test_CwJ8nvTDC9gzxkTAbf7HQN8veTCCUf");
        
        if ( app()->getLocale() === 'us' ) {
            $currency = 'USD';
            $money_amount = "".number_format( ConvertCurrency::EURtoUSD($paymentRequest['money_amount']), 2 );
        } else {
            $currency = 'EUR';
            $money_amount = "".number_format( $paymentRequest['money_amount'], 2 );
        }

        $init_payment = $mollie->payments->create([
            "amount" => [  
                "currency" => $currency, 
                "value" => $money_amount
            ],
            "description" => $paymentRequest['text'],
            "redirectUrl" => URL::to('/paycomplete/'.$paymentRequest['id']),
            "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
        ]);

        $paymentResponse = new \App\PaymentResponse;

        $paymentResponse->request_id = $paymentRequest['id'];
        $paymentResponse->mollie_id = $init_payment->id;
        $paymentResponse->paid = false;
        $paymentResponse->information = "";
        $paymentResponse->name = $respondername;
        $paymentResponse->location_info = json_encode($locinfo);
       
        $paymentResponse->save();

        $payment = $mollie->payments->get($init_payment->id);
        
        return redirect( $payment->getCheckoutUrl() );
    }

    public function completePayment( $id )
    {
        $id = Sanitize::Input( $id );

        $paymentResponse = \App\PaymentResponse::find($id);
        if ( !isset($paymentResponse) ) {
            return abort(404);
        }

        $paymentRequest = \App\PaymentRequest::find($id);    
        if ( !isset($paymentRequest) ) {
            return abort(503);
        }

        $mollie = new MollieAPIClient;
        $mollie->setApiKey("test_CwJ8nvTDC9gzxkTAbf7HQN8veTCCUf");

        $payment = $mollie->payments->get($paymentResponse->mollie_id);
        $paymentResponse->paid = true;
        
        if (isset( $payment->details->consumerName )) {
            $details_consumerName = $payment->details->consumerName;
        } else {
            $details_consumerName = 'unknown';
        }
        if (isset( $payment->details->consumerAccount )) {
            $details_consumerAccount = $payment->details->consumerAccount;
        } else {
            $details_consumerAccount = 'unknown';
        }
        
        $paymentResponse->information = $details_consumerName."---".$details_consumerAccount;

        $paymentResponse->save(); 


        $paymentRequest->completed_payments++;
        $paymentRequest->save();

        return redirect("paymentdone/".$paymentResponse['id']);
    }

    public function paymentDone( $id )
    {
        $id = Sanitize::Input( $id );

        $paymentResponse = \App\PaymentResponse::find($id);    
        if ( !isset($paymentResponse) ) {
            return abort(404);
        }
        
        $paymentRequest = \App\PaymentRequest::find($id);    
        if ( !isset($paymentRequest) ) {
            return abort(503);
        }

        $receiver = \App\User::find( $paymentRequest['owner_id'] );
        if ( !isset($receiver) ) {
            return abort(503);
        }

        return view('payment.complete', [
            'paymentRequest'=> $paymentRequest,
            'receiver' => $receiver['name']
        ]);
    }
}
