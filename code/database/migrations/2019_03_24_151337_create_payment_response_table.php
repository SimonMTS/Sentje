<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->string('mollie_id');
            $table->boolean('paid');
            $table->string('information');
            $table->string('name');
            $table->string('location_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_response');
    }
}
