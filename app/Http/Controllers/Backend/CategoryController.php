<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
        $categories = Category::where('category_up',null)->get();
        return view('backend.pages.category.edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $image   = $request->file('image');
            $dosyadi = $request->name;
            $yukleKlasor =  'image/category';
            $resimurl = resimyukle($image, $dosyadi, $yukleKlasor);

            Category::create([
                'name' => $request->name,
                'image' => $resimurl ?? null,

            ]);
            return back()->withSuccess('başarı ile değiştirildi');
        }
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
        $categories = Category::where('category_up', null)->get();
        return view('backend.pages.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status()
    {
        //
    }
}
