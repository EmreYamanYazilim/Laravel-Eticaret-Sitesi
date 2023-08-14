<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products(Request $request,$slug)
    {
        $category = $request->segment(1) ?? null;

        $size       = $request->size ?? null;
        $color      = $request->color ?? null;
        $startprice = $request->start_price ?? null;
        $endprice   = $request->end_price ?? null;
        $short      = $request->short ?? 'desc';
        $order      = $request->order ?? 'id';

        $products = Product::where('status', '1')->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
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
//            })->with('categoryHasOne:id,name,slug')
            })->with('category:id,name,slug')
            ->whereHas('category', function ($q) use ($category,$slug){
                if (!empty($slug)) {
                    $q->where('slug',$slug);
                }
                return $q;
            });


        $minprice = $products->min('price');
        $maxprice = $products->max('price');
        $sizelist = Product::where('status','1')->groupBY('size')->pluck('size')->toArray();
        $colors   = Product::where('status', '1')->groupBy('color')->pluck('color')->toArray();

        $products = $products->orderBy($order,$short)->paginate(2);


        return view('frontend.pages.products', compact('products','minprice','maxprice','sizelist','colors'));
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
