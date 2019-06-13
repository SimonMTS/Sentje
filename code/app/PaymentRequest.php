<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_requests';

    public $timestamps = true;


    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function responses()
    {
        return $this->hasMany('App\PaymentResponse', 'request_id');
    }

}
