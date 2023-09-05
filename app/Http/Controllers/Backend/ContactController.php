<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('backend.pages.contact.index',compact('contacts'));


    }

    public function edit($id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        return view('backend.pages.contact.edit', compact('contact'));

    }

    public function update(Request $request ,$id)
    {
        $update = $request->status;
//        $updatecheck = $update == "false" ? '0' : '1';
        Contact::where('id',$id)->update(['status'=> $update]);
        return back()->withSuccess('başarı ile değiştirildi');



    }

    public function destroy(string $id)
    {
        $contact = Contact::where('id', $id)->firstOrFail();
        dosyasil($contact->image); // helper.php de dinamik hale getirerek  silme işlemini yaptırıcak komutlar orada
        $contact->delete();
        return back()->withSuccess('Slider Başarı İle Silindi');


    }

    public function status(Request $request)  //aktif pasif bölümü
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Contact::where('id',$request->id)->update(['status'=>$updatecheck]);
        return response(['error'=>false, 'status'=>$update]);
    }

}
