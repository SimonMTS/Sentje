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
    }
}
