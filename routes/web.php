<?php

use App\Http\Controllers\Frontend\AjaxController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'sitesetting'], function () {

    Route::get('/', [PageHomeController::class, 'home'])->name('home');

    Route::get('/urunler', [PageController::class, 'products'])->name('product');// ürünler
    Route::get('/erkek/{slug?}', [PageController::class, 'products'])->name('erkekproduct');
    Route::get('/kadin/{slug?}', [PageController::class, 'products'])->name('kadinproduct');
    Route::get('/cocuk/{slug?}', [PageController::class, 'products'])->name('cocukproduct');
    Route::get('/indirimdekiler', [PageController::class, 'discountproducts'])->name('discount');



    Route::get('/urun/{slug}', [PageController::class, 'productdetail'])->name('productdetail'); // ürün detayım

    Route::get('/hakkimizda', [PageController::class, 'about'])->name('about');//hakkimizda

    Route::get('/iletisim', [PageController::class, 'contact'])->name('contact');//iletişim
    Route::post('/iletisim/kaydet', [AjaxController::class, 'contactsave'])->name('contact.store');//iletişim veri kaydetme

    Route::get('/alisverissepeti', [PageController::class, 'shopingbasket'])->name('shopingbasket');//sepet

});




