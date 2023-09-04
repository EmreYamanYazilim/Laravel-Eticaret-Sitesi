<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about =  About::where('id',1)->first();
        return view('backend.pages.about.index' ,compact('about'));


    }
    public function update(Request $request, $id = 1)
    {
        $about =About::where('id',1)->first();

        if (!empty($about->image == null)) {
            $request->hasFile('image');
            $image = $request->file('image');
            $dosyaadi = $request->name;
            $yukle = 'image/about/';
            $urlYukle = resimyukle($image,$dosyaadi,$yukle);
        }else{
            $request->hasFile('image');
            $image = $request->file('image');
            unlink($about->image);
            $dosyaadi = $request->name;
            $yukle = 'image/about/';
            $urlYukle = resimyukle($image,$dosyaadi,$yukle);

        }
        // Null geldiği zamanda dosya yüklemiyor o yüzden alltaki iptal  olaki dosya silinirse resim yüklenmez
//        if ($request->hasFile('image')) {
//            $image = $request->file('image');
//            $dosyaadi = $request->name;
//            $yukle = 'image/about/';
//            $urlYukle = resimyukle($image,$dosyaadi,$yukle);
//            unlink($about->image);
//        }

        $about->updateOrCreate(
            ['id' => $id],  //  ilk array şart olarak gelecek istersek benzer işlemlerde e mailde tanıtabiliriz tek bölüm olucağı için idsi 1 olanı getiricek
            [
                'image'             => $urlYukle ?? null,
                'name'              => $request->name,
                'content'           => $request->content1,
                'text_1_icon'       => $request->text_1_icon,
                'text_1_title'      => $request->text_1_title,
                'text_1_content'    => $request->text_1_content,
                'text_2_icon'       => $request->text_2_icon,
                'text_2_title'      => $request->text_2_title,
                'text_2_content'    => $request->text_2_content,
                'text_3_icon'       => $request->text_3_icon,
                'text_3_title'      => $request->text_3_title,
                'text_3_content'    => $request->text_3_content,
            ]
        );
        return back()->withSuccess('başarı ile güncellendi');

    }



}
