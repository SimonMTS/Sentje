<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Account extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
