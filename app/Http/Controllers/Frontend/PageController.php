<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products()
    {
        return view('frontend.pages.products');
    }
    public function discountproducts()
    {
        return view('frontend.pages.products');
    }

    public function productdetail()
    {
        return view('frontend.pages.productdetail');
    }
    public function about()
    {
        $about = About::where('id',1)->first();// hakkımızda bölümü tek bölüm olduğu için first yapmamız yeterli
       return view('frontend.pages.about', compact('about'));
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function shopingbasket()
    {
        return view('frontend.pages.shopingbasket');
    }

}
