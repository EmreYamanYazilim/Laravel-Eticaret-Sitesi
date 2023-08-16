<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId = [1,2,3,4,5,6,7,8,9];
        $sizelist   = ['XL','L','M','S'];
        $color      = ['Mavi','Kırmızı','Sarı','Beyaz'];
        $colortext  = $color[random_int(0,3)];
        $size       = $sizelist[random_int(0, 3)];

        return [
            'image' => 'https://fakeimg.pl/250x190/',
            'name'=>$colortext.' '.$size.' '.' Urun',
            'category_id'=>$categoryId[random_int(0,8)],  //katgori içinden aray olarak  1 den 9 a kadar random atıcak
            'short_text'=>$categoryId[random_int(0,8)].' id li ürün ',
            'price'=>random_int(100,500), //100 500 arası random atama
            'size'=>$size,
            'color'=>$colortext,
            'qty'=> 5,
            'status'=>'1',
            'content'=>'Ürün İçerikleri',
        ];
    }
}
