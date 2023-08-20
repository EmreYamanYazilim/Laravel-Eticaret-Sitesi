<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContentFromRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;


class AjaxController extends Controller
{
    public function contactsave(ContentFromRequest $request)
    {
//        1. ekleme yöntemi
//        $data = $request->all();
//        $data['ip'] = request()->ip();
//
//
//        $Sonkaydedilen = Contact::create($data);
//        return $Sonkaydedilen;

//        2. ekleme yöntemi

        $newdata = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => request()->ip(),
        ];

        Contact::create($newdata);
        return back()->with(['message'=> 'mesajınız başarı ile gönderildi !!']);

//        2. yöntem
//        return back()->withsuccess('Mesajınız başarı ile gönderilmiştir !!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
