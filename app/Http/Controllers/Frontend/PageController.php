<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products(Request $request)
    {
        $size = $request->size ?? null;
        $color = $request->color ?? null;
        $startprice = $request->start_price ?? null;
        $endprice = $request->end_price ?? null;

        $products = Product::where('status', '1')->select(['id','name','slug','size','color','price','category_id','image'])
            ->where(function ($q) use ($size, $color, $startprice, $endprice) {
                if (!empty($size)) {
                    $q->where('size', $size);
                }
                if (!empty($color)) {
                    $q->where('color', $color);
                }
                if (!empty($startprice && $endprice)) {
                    $q->whereBetween('price', [$startprice, $endprice]);
                }
                return $q;
            })->with('categoryHasOne:id,name,slug')
            ->paginate(22);
        $minprice = $products->min('price');
        $maxprice = $products->max('price');


        $categories = Category::where('status', '1')->where('category_up', null)->withCount('items')->get();

        return view('frontend.pages.products', compact('products','categories','minprice','maxprice'));
    }

    public function discountproducts()
    {
        return view('frontend.pages.products');
    }

    public function productdetail($slug)
    {
        $products = Product::where('slug', $slug)->first();
        return view('frontend.pages.productdetail', compact('products'));
    }

    public function about()
    {
        $about = About::where('id', 1)->first();// hakkımızda bölümü tek bölüm olduğu için first yapmamız yeterli
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
