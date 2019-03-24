<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
