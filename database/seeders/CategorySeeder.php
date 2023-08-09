<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $erkek = Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Erkek',
            'content'=> 'Erkek giyim',
            'category_up'=> null,
            'status'=> '1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Erkek Kazak',
            'content'=> 'Erkek  Kazakları ',
            'category_up'=> $erkek->id,
            'status'=> '1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Erkek pantolon',
            'content'=> 'Erkek pantolonları ',
            'category_up'=> $erkek->id,
            'status'=> '1'
        ]);

        $kadın = Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Kadin',
            'content'=> 'Kadin giyim',
            'category_up'=> null,
            'status'=> '1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Kadin Çanta',
            'content'=> 'Kadin Çantaları ',
            'category_up'=> $kadın->id,
            'status'=> '1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Kadin pantolon',
            'content'=> 'Kadin pantolonları ',
            'category_up'=> $kadın->id,
            'status'=> '1'
        ]);


        $cocuk = Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Cocuk',
            'content'=> 'Cocuk giyim',
            'category_up'=> null,
            'status'=> '1'
        ]);

        Category::create([
            'image'=>null,
            'thumbnail'=>null,
            'name'=> 'Cocuk montları',
            'content'=> 'Cocuk montları ',
            'category_up'=> $cocuk->id,
            'status'=> '1'
        ]);
    }

}
