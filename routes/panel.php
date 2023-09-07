<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['panelsetting','auth'], 'prefix' =>'panel' ,'as' =>'panel.'], function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');// as'tan dolayı panel.index olacak
    //resourcesiz yol
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/ekle', [SliderController::class, 'create'])->name('slider.create');
    Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider/{id}/update', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/{id}/destroy', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::post('/slider-durum/update', [SliderController::class, 'status'])->name('slider.status');

    //resourceli
    Route::resource('/category',CategoryController::class)->except('destroy');
    Route::delete('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category-durum/update', [CategoryController::class, 'status'])->name('category.status');

    //-----//
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{id}/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contact-durum/update', [ContactController::class, 'status'])->name('contact.status');


    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setting/create', [SettingController::class, 'create'])->name('setting.create');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
    Route::get('/setting/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting/{id}/update', [SettingController::class, 'update'])->name('setting.update');
    Route::delete('setting/{id}/destroy', [SettingController::class, 'destory'])->name('setting.destory');





});








