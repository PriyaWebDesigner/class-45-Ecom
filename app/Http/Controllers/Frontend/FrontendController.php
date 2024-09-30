<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
    public function productDetails()
    {
        return view ('frontend.product-details');
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
}




