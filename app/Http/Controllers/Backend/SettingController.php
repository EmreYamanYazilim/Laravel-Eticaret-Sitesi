<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::get();
        return view('backend.pages.setting.index', compact('settings'));

    }


    public function store(Request $request)
    {
        SiteSetting::firstOrCreate(
            [
                'name'      => $request->name
            ],
            [
                'name'      => $request->name,
                'data'      => $request->data,
                'set_type'  => $request->set_type,
            ]);

        return back()->withSuccess('Başarı ile Kaydedildi');
    }

    public function create()
    {

        return view('backend.pages.setting.edit');
    }

    public function edit($id)
    {
        $setting = SiteSetting::where('id', $id)->first();
        return view('backend.pages.setting.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = SiteSetting::where('id', $id)->first();

        if ($request->hasFile('data')) {
            dosyasil($setting->data);

            $image          = $request->file('data');
            $dosyaadi       = $request->name;
            $yukleklasor    = 'image/setting/';
            $resimurl       = resimyukle($image, $dosyaadi, $yukleklasor);

        }

        $setting->update([
            'name'      => $request->name,
            'data'      => $resimurl ?? $request->data,
            'set_type'  => $request->set_type,

        ]);
        return back()->withSuccess('Başarı ile Güncellendi');
    }



}
