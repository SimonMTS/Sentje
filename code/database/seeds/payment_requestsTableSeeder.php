<?php

use Illuminate\Database\Seeder;

class payment_requestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_requests')->insert([
            'owner_id' => 1,
            'money_amount' => 10.30,
            'text' => 'voor de film',
            'possible_payments' => 5,
            'completed_payments' => 0,
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => date( 'Y-m-d H:i:s' ),
            'location' => '',
            'file_location' => ''
        ]);
    }
}
