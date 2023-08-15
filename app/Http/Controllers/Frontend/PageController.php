<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function products(Request $request,$slug=null)
    {
        $category   = $request->segment(1) ?? null;
        $size       = $request->size ?? null;
        $color      = $request->color ?? null;
        $startprice = $request->start_price ?? null;
        $endprice   = $request->end_price ?? null;
        $order      = $request->order ??  'id';
        $short      = $request->short ?? 'desc';


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
            })->with('categoryHasOne:id,name,slug')
            ->whereHas('categoryHasOne', function ($q) use ($category,$slug){
                if (!empty($slug)) {
                    $q->where('slug',$slug);
                }
                return $q;
            });
        $minprice = $products->min('price');
        $maxprice = $products->max('price');
        $sizelist = Product::where('status','1')
            ->groupBY('size')
            ->pluck('size')
            ->toArray();
        $colors   = Product::where('status', '1')
            ->groupBy('color')
            ->pluck('color')
            ->toArray();

        $products = $products->orderBy($order,$short)->paginate(3);

        return view('frontend.pages.products', compact('products','minprice','maxprice','sizelist','colors','category'));
    }

    public function discountproducts()
    {
        return view('frontend.pages.products');
    }

    public function productdetail($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status','1')
            ->firstOrFail();// firstorfail  slug yoksa hata versin

        $products = Product::where('id','!=',$product->id) //sayfada gösterilen veri olmasın
            ->where('category_id',$product->category_id) //aynı kategorideki ürünler
            ->where('status', '1')
            ->limit(6)
            ->get();

        return view('frontend.pages.productdetail', compact('product','products'));
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
