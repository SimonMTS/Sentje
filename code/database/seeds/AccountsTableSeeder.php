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
            'IBAN' => 'NL91 ABNA 0417 1643 00',
            'user_id' => 1
        ]);
        DB::table('accounts')->insert([
            'IBAN' => 'NL28 ABNA 4636 6819 24',
            'user_id' => 1
        ]);

        DB::table('accounts')->insert([
            'IBAN' => 'NL75 ABNA 8434 2482 47',
            'user_id' => 2
        ]);

        DB::table('accounts')->insert([
            'IBAN' => 'GB29 NWBK 6016 1331 9268 19',
            'user_id' => 3
        ]);
    }
}
