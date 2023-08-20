<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function index()
    {
         $cartItem       = session('cart',[]);
        $totalPrice      = 0;

        foreach ($cartItem as $cart) {
            $totalPrice += $cart['price'] * $cart['qty'] ;
        }



        return view('frontend.pages.cart',compact('cartItem','totalPrice'));

    }

    public function add(Request $request)
    {


        $productID   = $request->product_id;
        $qty         = $request->qty ?? 1; // adet  belirtilmediyse  1 koy
        $size        = $request->size;

          $urun = Product::find($productID);

        if (!$urun) {
            return back()->withError('ürün Bulunamadı');

        }

        $cartItem    = session('cart',[]);

         if (array_key_exists($productID, $cartItem)) {
            $cartItem[$productID]['qty'] += $qty;
        } else {
               $cartItem[$productID] =
                   [
                'image' => $urun->image,
                'name'  => $urun->name,
                'price' => $urun->price,
                'qty'   =>  $qty,
                'size'  =>  $size,
                   ];
        }
         session(['cart' => $cartItem]);
         return back()->withSuccess('ürün başarı ile sepete yüklendi');

    }

    public function remove(Request $request)
    {
        $productID  =   $request->product_id;
        $cartItem   =   session('cart',[]);

        if (array_key_exists($productID,$cartItem)){
            unset($cartItem[$productID]);
        }
        session(['cart'=>$cartItem]);
        return back()->withSuccess('ürün başarı ile silindir');

    }


}
