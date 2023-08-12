<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'image' => 'https://fakeimg.pl/1250x700/',
            'name' => 'slider1',
            'content' => 'E-Ticaret Sitemize hoşgeldinizz',
            'link' => 'urunler',
            'status'=> '1'
        ]);
    }
}
