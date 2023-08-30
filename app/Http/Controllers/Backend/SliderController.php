<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use ImageResize;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.pages.slider.index' , compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.slider.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        if ($request->hasFile('image')) {
            $resim      =       $request->file('image');
            $uzanti     = $resim->getClientOriginalExtension();
            $dosyaadi   =       time().'-'.Str::slug($request->name);
            $yukleklasor= 'image/slider/';

//          $resim->move(public_path('image/slider'), $dosyaadi);

            if ($uzanti == 'pdf' || $uzanti == 'svg' || $uzanti == 'webp' || $uzanti == 'jiff') {
                $resim->move(public_path($yukleklasor), $dosyaadi.'.'.$uzanti);
                $resimurl = $yukleklasor.$dosyaadi.'.'.$uzanti;
            }else{
                $resim = ImageResize::make($resim);
                $resim->encode('webp',75)->save($yukleklasor.$dosyaadi.'.webp');
                $resimurl = $dosyaadi.'.webp';

            }
        }


        Slider::create([
            'name'      =>  $request->name,
            'link'      =>  $request->link,
            'content'   =>  $request->content1,
            'status'    =>  $request->status,
            'image'     =>  $resimurl ?? null,
        ]);

        return back()->withSuccess(' başarı ile oluşturuldu');

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
        $slider = Slider::where('id', $id)->first();
        return view('backend.pages.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            $resim      =       $request->file('image');
            $uzanti     = $resim->getClientOriginalExtension();
            $dosyaadi   =       time().'-'.Str::slug($request->name);
            $yukleklasor= 'image/slider/';

//          $resim->move(public_path('image/slider'), $dosyaadi);

            if ($uzanti == 'pdf' || $uzanti == 'svg' || $uzanti == 'webp' || $uzanti == 'jiff') {
                $resim->move(public_path($yukleklasor), $dosyaadi.'.'.$uzanti);
                $resimurl = $yukleklasor.$dosyaadi.'.'.$uzanti;
            }else{
                $resim = ImageResize::make($resim);
                $resim->encode('webp',75)->save($yukleklasor.$dosyaadi.'.webp');
                $resimurl = $dosyaadi.'.webp';

            }
        }


        Slider::where('id',$id)->update([
            'name'      =>  $request->name,
            'link'      =>  $request->link,
            'content'   =>  $request->content,
            'status'    =>  $request->status,
            'image'     =>  $resimurl ?? null,
        ]);

        return back()->withSuccess(' başarı ile Güncellendi ');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
