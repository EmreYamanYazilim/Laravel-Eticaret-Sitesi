<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products()
    {
        $products = Product::where('status','1')->get();
        return view('frontend.pages.products',compact('products'));
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
