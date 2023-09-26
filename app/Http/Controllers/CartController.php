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

    public function add(Request $request) {

        $productID   = $request->product_id;
        $qty         = $request->qty ?? 1; // adet  belirtilmediyse  1 koy
        $size        = $request->size;

          $urun = Product::find($productID);

        if (!$urun) {
            return response()->json(['ürün Bulunamadı']);


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
        if ($request->ajax()) {
            return response()->json('Sepet güncellendi');
        }

         return back()->withSuccess('ürün başarı ile sepete yüklendi');

    }

    public function newqty(Request $request) {
        $productID= $request->product_id;
        $qty= $request->qty ?? 1;
        $itemtotal = 0;
        $urun = Product::find($productID);
        if(!$urun) {
            return response()->json('Ürün Bulanamadı!');
        }
        $cartItem = session('cart',[]);


        if(array_key_exists($productID,$cartItem)){
            $cartItem[$productID]['qty'] = $qty;
            if($qty == 0 || $qty < 0){
                unset($cartItem[$productID]);
            }


            if(session()->get('coupon_code') && session()->get('coupon_code') == 'tumurun') {
                $price = $urun->price / 2;
            }else {
                $price = $urun->price;
            }

            $kdvOraniitem = $urun->kdv ?? 0;
            $kdvtutaritem = ( $price * $qty) * ($kdvOraniitem / 100);
            $itemtotal =  $price * $qty + $kdvtutaritem;

        }

        session(['cart'=>$cartItem]);


        $this->sepetList();

        if($request->ajax()) {
            return response()->json(['itemTotal'=>$itemtotal, 'totalPrice'=>session()->get('total_price'), 'message'=>'Sepet Güncellendi']);
        }
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
