<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'name' => 'adres',
            'data' => 'EdirneMerkez'
        ]);

        SiteSetting::create([
            'name' => 'telefon',
            'data' => '0551 000 00 01'
        ]);

        SiteSetting::create([
            'name' => 'email',
            'data' => 'alya@hotmail.com'
        ]);

        SiteSetting::create([
            'name'=>'harita',
            'data'=> null
        ]);
    }
}
