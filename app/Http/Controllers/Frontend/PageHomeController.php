<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class PageHomeController extends Controller
{
    public function home()
    {
        $slider = Slider::where('status','1')->first();
        $title = 'Anasayfa';
        $about = About::where('id',1)->first();
        $lastProducts = Product::where('status', '1')
            ->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
            ->with('categoryHasOne')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();


        return view('frontend.pages.index',compact('slider','title','about','lastProducts'));

    }


}
