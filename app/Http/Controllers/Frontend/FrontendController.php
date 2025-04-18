<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\ReturnRequest;
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
        $banners = Banner::get();
        return view ('frontend.index', compact('hotProducts','newProducts','regularProducts','discountProducts','banners'));
    }
    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->with('color','size', 'galleryImage','review')->first();
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
    public function returnProcess ()
    {
        return view ('frontend.return-process');
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
        $cartProduct = Cart::where('product_id', $id)->where('ip_address', $request->ip())->first();
        // dd($cartProduct);
        $product = Product::find($id);

        if($cartProduct == null){
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
            toastr()->success('Successfully added to cart');
            return redirect()->back();
        }

        if($cartProduct != null){
            
            $cartProduct->qty = $cartProduct->qty+1;
        }

        $cartProduct->save();
        toastr()->success('Successfully added to cart');
        return redirect()->back();
    }

    public function addToCartDelete ($id)
    {
         $cart = Cart::find($id);
         $cart->delete();
         toastr()->success('Successfully deleted from cart');
         return redirect()->back();
    }

    public function addToCartDetails (Request $request, $id)
    {
        $cartProduct = Cart::where('product_id', $id)->where('ip_address', $request->ip())->first();
        // dd($cartProduct);
        $product = Product::find($id);

        if($cartProduct == null){
            $cart = new Cart();
        
            $cart->ip_address = $request->ip();
            $cart->product_id = $product->id;
            $cart->qty = $request->qty;
            $cart->color = $request->color;
            $cart->size = $request->size;
            
            if($product->discount_price != null){
                $cart->price = $product->discount_price;
            }
    
            if($product->discount_price == null){
                $cart->price = $product->regular_price;
            }
            $cart->save();

            if($request->action == 'addToCart'){
                toastr()->success('Successfully added to cart');
                return redirect()->back();
            }

            else if($request->action == 'buyNow'){
                toastr()->success('Successfully added to cart');
                return redirect('/checkout');
            }
        }

        if($cartProduct != null){
            
            $cartProduct->qty = $cartProduct->qty+$request->qty;
        }
        $cartProduct->save();

        if($request->action == 'addToCart'){
            toastr()->success('Successfully added to cart');
            return redirect()->back();
        }

        else if($request->action == 'buyNow'){
            toastr()->success('Successfully added to cart');
            return redirect('/checkout');
        }
    }

    public function confirmOrder (Request $request)
    {
        $order = new Order();

        $previousOrder = Order::orderBy('id', 'desc')->first();
        if($previousOrder == null){
            $generatedInvoiceId = "xyz-1";
            $order->invoiceId = $generatedInvoiceId;
        }
        else{
            $generatedInvoiceId = "xyz-".$previousOrder->id+1;
            $order->invoiceId = $generatedInvoiceId;  //"xyz-" 10+1
        }
        $order->c_name = $request->c_name;
        $order->c_phone = $request->c_phone;
        $order->address = $request->address;
        $order->area = $request->area;
        $order->price = $request->inputGrandTotal;

        $cartProducts = Cart::where('ip_address', $request->ip())->get();
        // dd($cartProducts);
        if($cartProducts->isNotEmpty()){
            $order->save();
            foreach($cartProducts as $cart){
                $orderDetails = new OrderDetails();

                $orderDetails->order_id = $order->id;
                $orderDetails->product_id = $cart->product_id;
                $orderDetails->size = $cart->size;
                $orderDetails->color = $cart->color;
                $orderDetails->qty = $cart->qty;
                $orderDetails->price = $cart->price;

                $orderDetails->save();
                $cart->delete();

            }
        }
        else{
            toastr()->warning('No product in your cart');
            return redirect('/');
        }

        toastr()->success('Order has been placed successfully');
        return redirect('thank-you/'.$generatedInvoiceId);
    }

    public function thankYouPage ($invoiceId)
    {
        return view ('frontend.thank-you', compact('invoiceId'));
    }


    //Category Products..
    public function categoryProducts ($slug, $id)
    {
        $products = Product::where('cat_id',$id)->get();
        // dd($products);
        $productsCount = $products->count();
        // dd($productsCount);
        return view ('frontend.category-products',compact('products','productsCount'));
    }

    //Shop Products
    public function shopProducts (Request $request)
    {
        if(isset($request->categoryId)){
            $products = Product::orderBy('id','desc')->where('cat_id',$request->categoryId)->get();
        }

        elseif(isset($request->subCategoryId)){
            $products = Product::orderBy('id','desc')->where('sub_cat_id',$request->subCategoryId)->get();

        }

        else{
            $products = Product::orderBy('id','desc')->get();
        }
        
        $productsCount = $products->count();
        return view ('frontend.shop', compact('products','productsCount'));
    }

    //Policy Pages

    public function privacyPolicy ()
    {
        
        return view ('frontend.privacy-policy');
    }

    public function termsCondition ()
    {
        return view ('frontend.terms-condition');
    }

    public function refundPolicy ()
    {
        return view ('frontend.refund-policy');
    }

    public function paymentPolicy ()
    {
        return view ('frontend.payment-policy');
    }

    public function aboutUs ()
    {
        return view ('frontend.about-us');
    }

    public function typeProducts ($type)
    {
        $products = Product::where('product_type',$type)->get();
        // dd($products);
        $productCount = $products->count();
        return view ('frontend.type-products',compact('type', 'products','productCount'));
    }

    public function showReturnForm ()
    {
        return view ('frontend.return-product');
    }

    public function storeReturnRequest (Request $request)
    {
        $returnRequest = new ReturnRequest();

        $returnRequest->c_name = $request->c_name;
        $returnRequest->c_phone = $request->c_phone;
        $returnRequest->address = $request->address;
        $returnRequest->order_id = $request->order_id;
        $returnRequest->issue = $request->issue;

        if(isset($request->image)){
            $imageName = rand().'-return-'.'.'.$request->image->extension();  //678900-productupdate-.jpg
            $request->image->move('backend/images/return/',$imageName);
            
            $returnRequest->image = $imageName;
        }

        $returnRequest->save();
        toastr()->success('Request has been sent successfully');
        return redirect()->back();
    }

    public function showContactForm ()
    {
        return view ('frontend.contact-form');
    }

    public function storeContact (Request $request)
    {
        $contactMessage = new ContactMessage();

        $contactMessage->name = $request->name;
        $contactMessage->phone = $request->phone;
        $contactMessage->email = $request->email;
        $contactMessage->subject = $request->subject;
        $contactMessage->message = $request->message;

        $contactMessage->save();
        toastr()->success('Message has been sent successfully');
        return redirect()->back();
    }

    //Search Products
    public function searchProducts (Request $request)
    {
        $products = Product::where('name', 'LIKE','%'.$request->search.'%')->get();
        // dd($products);
        $productsCount = $products->count();
        return view ('frontend.search-products',compact('products','productsCount'));
    }
}




