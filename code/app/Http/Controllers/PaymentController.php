<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{

    public function index()
    {
        return view('payment.index');
    }

    public function addPOST( Request $request )
    {
        $paymentRequest = new \App\PaymentRequest;

        $paymentRequest->text = $request->text;
        $paymentRequest->money_amount = $request->money_amount;
        $paymentRequest->possible_payments = $request->possible_payments;

        $paymentRequest->owner_id = auth()->user()->id;
        $paymentRequest->created_at = date( 'Y-m-d H:i:s' );
        $paymentRequest->updated_at = date( 'Y-m-d H:i:s' );

        $paymentRequest->location = '';
        $paymentRequest->completed_payments = 0;

        $paymentRequest->save();

        $request->session()->flash('sentjeSuccess', [__('payment.success'), __('payment.sentjeAdded')]);
        return redirect('');
    }

    public function receivePayment( $id ){
        $paymentRequest = \App\PaymentRequest::find($id);
        
        if ( !isset($paymentRequest) ) {
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

    public function setupPayment( $id ) {
        $paymentRequest = \App\PaymentRequest::find($id);
        
        if ( !isset($paymentRequest) ) {
            return abort(404);
        }
        
        $mollie = new MollieAPIClient;
        $mollie->setApiKey("test_CwJ8nvTDC9gzxkTAbf7HQN8veTCCUf");
        
        $init_payment = $mollie->payments->create([
            "amount" => [  
                "currency" => 'EUR', 
                "value" => "".number_format( $paymentRequest['money_amount'], 2 )
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
       
        $paymentResponse->save();

        $payment = $mollie->payments->get($init_payment->id);
        
        return redirect( $payment->getCheckoutUrl() );
    }

    public function completePayment( $id ) {
        $paymentResponse = \App\PaymentResponse::find($id);    

        if ( !isset($paymentResponse) ) {
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
        return redirect("paymentdone/".$paymentResponse['id']);
        // echo '<pre>';var_dump( $payment );exit;
    }

    public function paymentDone( $id ) {
        $paymentResponse = \App\PaymentResponse::find($id);    

        if ( !isset($paymentResponse) ) {
            return abort(503);
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
