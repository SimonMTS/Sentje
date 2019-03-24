<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'IBAN' => encrypt('NL91 ABNA 0417 1643 00'),
            'user_id' => 1,
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ]);
        DB::table('accounts')->insert([
            'IBAN' => encrypt('NL28 ABNA 4636 6819 24'),
            'user_id' => 1,
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ]);

        DB::table('accounts')->insert([
            'IBAN' => encrypt('NL75 ABNA 8434 2482 47'),
            'user_id' => 2,
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ]);

        DB::table('accounts')->insert([
            'IBAN' => encrypt('GB29 NWBK 6016 1331 9268 19'),
            'user_id' => 3,
            'created_at' => date( 'Y-m-d H:i:s' ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ]);
    }
}
