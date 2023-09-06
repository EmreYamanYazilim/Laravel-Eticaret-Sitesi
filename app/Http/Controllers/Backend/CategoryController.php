<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('category:id,category_up,name')->get();
        return view('backend.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.pages.category.edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if ($request->hasFile('image')) {
            $image          = $request->file('image');
            $dosyadi        = $request->name;
            $yukleKlasor    =  'image/category/';
            $resimurl       = resimyukle($image, $dosyadi, $yukleKlasor);
        }
             Category::create([
                'name'          => $request->name,
                'category_up'   => $request->category_up,
                'status'        => $request->status,
                'content'       => $request->content1,
                'image'         => $resimurl ?? null,



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
        $category   = Category::where('id',$id)->first();
        $categories = Category::get();
        return view('backend.pages.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
         $category = Category::where('id', $id)->firstOrFail();

        if ($request->hasFile('image')) {
            dosyasil($category->image);
            $image          = $request->file('image');
            $dosyadi        = $request->name;
            $yukleKlasor    =  'image/category/';
            $resimurl       = resimyukle($image, $dosyadi, $yukleKlasor);
        }
             $category->update([
                'name'          => $request->name,
                'category_up'   => $request->category_up,
                'status'        => $request->status,
                'content'       => $request->content1,
                'image'         => $resimurl ?? NULL,

            ]);
            return back()->withSuccess('başarı ile değiştirildi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::where('id',$id)->firstorfail();
        dosyasil($category->image); // helper.php de dinamik hale getirerek  silme işlemini yaptırıcak komutlar orada
        $category->delete();
        return back()->withSuccess('Slider Başarı İle Silindi');

    }

    public function status(CategoryRequest $request)  //aktif pasif bölümü
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Category::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false, 'status'=>$update]);
    }
}
