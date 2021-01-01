<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;
use Illuminate\Support\facades\Hash;

class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Mayuresh Rambade',
            'email' => 'rambade.mayuresh111@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
