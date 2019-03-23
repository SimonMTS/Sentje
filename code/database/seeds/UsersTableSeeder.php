<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Henk Janssen',
            'email' => 'henk.janssen@email.com',
            'password' => bcrypt('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Rania Ellison',
            'email' => 'rania.ellison@email.com',
            'password' => bcrypt('password')
        ]);

        DB::table('users')->insert([
            'name' => 'Pierre Caldwell',
            'email' => 'pierre.caldwell@email.com',
            'password' => bcrypt('password')
        ]);
    }
}
