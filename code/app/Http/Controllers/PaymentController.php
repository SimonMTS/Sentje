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
            "redirectUrl" => URL::to('/paycomplete'),
            "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
        ]);

        $payment = $mollie->payments->get($init_payment->id);
        
        return redirect( $payment->getCheckoutUrl() );
        //echo '<pre>';var_dump( $mollie );exit;        
    }
}
