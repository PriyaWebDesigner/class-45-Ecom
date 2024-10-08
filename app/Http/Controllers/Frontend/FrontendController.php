<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index ()
    {
        $hotProducts = Product::where('product_type','hot')->get();
        // dd($hotProducts);
        $newProducts = Product::where('product_type','new')->get();
        $regularProducts = Product::where('product_type','regular')->get();
        $discountProducts = Product::where('product_type','discount')->get();
        return view ('frontend.index', compact('hotProducts','newProducts','regularProducts','discountProducts'));
    }
    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->with('color','size', 'galleryImage')->first();
        // dd($product);
        return view ('frontend.product-details',compact('product'));
    }
    public function viewCart ()
    {
        return view ('frontend.view-cart');
    }
    public function checkout ()
    {
        return view ('frontend.checkout');
    }
    public function shop ()
    {
        return view ('frontend.shop');
    }
    public function returnProcess ()
    {
        return view ('frontend.return-process');
    }
    public function privacyPolicy ()
    {
        return view ('frontend.privacy-policy');
    }
    public function category ()
    {
        return view ('frontend.category');
    }
    public function subCategory ()
    {
        return view ('frontend.sub-category');
    }
    public function viewAll ()
    {
        return view ('frontend.view-all');
    }
    public function thankYou ()
    {
        return view ('frontend.thank-you');
    }
    public function addToCart (Request $request, $id)
    {
        $product = Product::find($id);
        $cart = new Cart();
        $cart->ip_address = $request->ip();
        $cart->product_id = $product->id;
        $cart->qty = 1;
        if($product->discount_price != null){
            $cart->price = $product->discount_price;
        }

        if($product->discount_price == null){
            $cart->price = $product->regular_price;
        }

        $cart->save();
        return redirect()->back();
    }
}




