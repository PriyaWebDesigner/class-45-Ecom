<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index ()
    {
        return view ('frontend.index');
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
}




