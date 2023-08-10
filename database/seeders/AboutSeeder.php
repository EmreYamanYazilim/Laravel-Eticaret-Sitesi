<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name'          => 'Yaman Shop',
            'content'       => 'Hakkımızda yazısı burada ',
            'text_1_icon'   => 'icon-truck',
            'text_1_title'  => 'Ücretsiz Kargoo',
            'text_1_content'=> '250 ₺ üzeri alış verişlerinizde tarafımızla anlaşmalı kargo şirketlerinden ücretsiz olarak kargolarınızı teslim alabilirsiniz',
            'text_2_icon'   => 'icon-refresh2',
            'text_2_title'  => 'Geri İade.',
            'text_2_content'=> 'Satış sözleşmesindeki şartlara uyarak mağazamız tarafından ürünlerinizi geri iade alabiliriz',
            'text_3_icon'   => 'icon-help',
            'text_3_title'  => 'destek',
            'text_3_content'=> 'Sorunlarınızı en hızlı ve etkili şekilde çözebilmek için bizle iletişime geçtiğinizde sorunlarınızı düzeltebiliriz',
        ]);
    }
}
