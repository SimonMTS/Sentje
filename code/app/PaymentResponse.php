<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentResponse extends Model
{
    protected $table = 'payment_response';

    public $timestamps = true;


    public function request()
    {
        return $this->belongsTo('App\PaymentRequest');
    }

}
