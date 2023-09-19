<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categoryHasOne:id,category_up,name')->orderBy('id','desc')->paginate(20);
        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Product::get();
        return view('backend.pages.product.edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $image          = $request->file('image');
            $dosyadi        = $request->name;
            $yukleKlasor    =  'image/urun/';
            $resimurl       = resimyukle($image, $dosyadi, $yukleKlasor);
        }


        Product::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'content'=>$request->content1,
            'short_text'=>$request->short_text,
            'price'=>$request->price,
            'size'=>$request->size,
            'color'=>$request->color,
            'qty'=>$request->qty,
            'image' => $resimurl ?? null,
            'status'=>$request->status,



        ]);
        return back()->withSuccess('başarı ile değiştirildi');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product   = Product::where('id',$id)->first();
        $categories = Category::get();
        return view('backend.pages.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        if ($request->hasFile('image')) {
            dosyasil($product->image);
            $image          = $request->file('image');
            $dosyadi        = $request->name;
            $yukleKlasor    =  'image/urun/';
            $resimurl       = resimyukle($image, $dosyadi, $yukleKlasor);
        }
        $product->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'content'=>$request->content1,
            'short_text'=>$request->short_text,
            'price'=>$request->price,
            'size'=>$request->size,
            'color'=>$request->color,
            'qty'=>$request->qty,
            'image' => $resimurl ?? $product->image,
            'status'=>$request->status,



        ]);
        return back()->withSuccess('başarı ile değiştirildi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::where('id',$id)->firstorfail();
        dosyasil($product->image); // helper.php de dinamik hale getirerek  silme işlemini yaptırıcak komutlar orada
        $product->delete();
        return back()->withSuccess('Slider Başarı İle Silindi');

    }

    public function status(Request $request)  //aktif pasif bölümü
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Product::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false, 'status'=>$update]);
    }
}
