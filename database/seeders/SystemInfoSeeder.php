<?php

namespace Database\Seeders;

use App\Models\SystemInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemInfo::create([
            'meta_field' => 'name',
            'meta_value' => 'Pet Shop Food and Accessories Shop'
        ]);
        SystemInfo::create([
            'meta_field' => 'short_name',
            'meta_value' => 'CLeoow'
        ]);
        SystemInfo::create([
            'meta_field' => 'logo',
            'meta_value' => ''
        ]);
        SystemInfo::create([
            'meta_field' => 'cover',
            'meta_value' => ''
        ]);
    }
}