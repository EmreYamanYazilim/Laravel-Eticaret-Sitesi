<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Product::create([
            'name'          => 'Ürün 1',
            'image'         => 'images/shoe_1.jpg',
            'category_id'   => 1,
            'short_text'    => 'Ksa bilgi 1',
            'price'         => 111,
            'size'          => 'small',
            'color'         => 'mavi',
            'qty'           => 5,
            'status'        => '1',
            'content'       => '<p>ürünkerimiz  özenle dokınmaktadır mavi renklidir</p>',
        ]);

        Product::create([
            'name'          => 'Ürün 2',
            'image'         => 'images/cloth_3.jpg',
            'category_id'   => 2,
            'short_text'    => ' Ksa bilgi 2',
            'price'         => 222,
            'size'          => 'large',
            'color'         => 'beyaz',
            'qty'           => 7,
            'status'        => '1',
            'content'       => '<p>ürünkerimiz  özenle dokınmaktadır beyaz renklidir </p>',
        ]);
    }
}
