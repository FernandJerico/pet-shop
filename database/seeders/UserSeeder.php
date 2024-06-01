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

        //make user
        DB::table('users')->insert([
            'first_name' => 'Fajar',
            'last_name' => 'Gema',
            'email' => 'user@gmail.com',
            'roles' => 'user',
            'password' => Hash::make('user'),
        ]);
    }
}