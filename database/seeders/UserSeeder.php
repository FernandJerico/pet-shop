<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //make admin
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Utama',
            'email' => 'admin@gmail.com',
            'roles' => 'admin',
            'password' => Hash::make('admin'),
        ]);

        //make admin
        DB::table('users')->insert([
            'first_name' => 'Valeria',
            'last_name' => 'Cyrilla',
            'email' => 'valeriacyrilla@gmail.com',
            'roles' => 'admin',
            'password' => Hash::make('valeria123'),
        ]);
    }
}