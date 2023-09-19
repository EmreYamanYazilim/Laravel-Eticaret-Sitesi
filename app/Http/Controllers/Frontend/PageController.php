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
        $sizes      = !empty($request->size) ? explode(',',$request->size) : null ;
        $colors     = !empty($request->color) ? explode(',',$request->color) : null;
        $startprice = $request->min     ?? null;
        $endprice   = $request->max     ?? null;
        $order      = $request->order   ??  'id';
        $sort       = $request->sort    ?? 'desc';


        $products = Product::where('status', '1')->select(['id', 'name', 'slug', 'size', 'color', 'price', 'category_id', 'image'])
            ->where(function ($q) use ($sizes, $colors, $startprice, $endprice) {
                if (!empty($sizes)) {
                    $q->whereIn('size', $sizes);
                }
                if (!empty($colors)) {
                    $q->whereIn('color', $colors);
                }
                if (!empty($startprice && $endprice)) {
//                    $q->whereBetween('price', [$startprice, $endprice]);
                    $q->where('price', '>=', $startprice);
                    $q->where('price', '<=', $endprice);

                }
                return $q;
            })->with('categoryHasOne:id,name,slug')
            ->whereHas('categoryHasOne', function ($q) use ($category,$slug){
                if (!empty($slug)) {
                    $q->where('slug',$slug);
                }
                return $q;
            })->orderBy($order,$sort)->paginate(9);
        if ($request->ajax()) {
            $view = view('frontend.ajax.productList', compact('products'))->render();
            return response(['data'=>$view, 'paginate'=> (string) $products->withQueryString()->links('vendor.pagination.bootstrap-4')]);
        }

        $sizelist = Product::where('status','1')
            ->groupBY('size')
            ->pluck('size')
            ->toArray();
        $colors   = Product::where('status', '1')
            ->groupBy('color')
            ->pluck('color')
            ->toArray();
        $maxprice = Product::max('price');

        return view('frontend.pages.products', compact('products','maxprice','sizelist','colors','category'));
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
            ->orderBy('id','desc')
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




}
