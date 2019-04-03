<?php

use Illuminate\Database\Seeder;

class payment_responseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_response')->insert([
            'request_id' => 1,
            'mollie_id' => "tr_aaaaaa",
            'paid' => 1,
            'information' => 'unknown--unknown',
            'name' => 'Jan van Dijk',
            'location_info' => '["213.73.228.52","Netherlands","North Brabant","Oss","51.767","5.5017"]',
            'created_at' => date( 'Y-m-d H:i:s', strtotime('-3 day') ),
            'updated_at' => date( 'Y-m-d H:i:s', strtotime('-3 day') )
        ]);

        DB::table('payment_response')->insert([
            'request_id' => 1,
            'mollie_id' => "tr_aaaaaa",
            'paid' => 1,
            'information' => 'unknown--unknown',
            'name' => 'unknown',
            'location_info' => '"unknown"',
            'created_at' => date( 'Y-m-d H:i:s', strtotime('-1 day') ),
            'updated_at' => date( 'Y-m-d H:i:s', strtotime('-1 day') )
        ]);

        DB::table('payment_response')->insert([
            'request_id' => 1,
            'mollie_id' => "tr_aaaaaa",
            'paid' => 1,
            'information' => 'unknown--unknown',
            'name' => 'piet wagemakers',
            'location_info' => '"unknown"',
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ]);
    }
}
