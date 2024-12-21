<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showAllOrders ()
    {
        $orders = Order::with('orderDetails')->get();
        // dd($orders);
        return view ('backend.order.all-orders',compact('orders'));
    }

    public function updateStatus ($order_id, $status_type)
    {
        $order = Order::find($order_id);
        $order->status = $status_type;

        $order->save();
        toastr()->success('Satus updated Successfully');
        return redirect()->back();
    }
    
    public function statusWiseOrder ($status_type)
    {
        $orders = Order::with('orderDetails')->where('status',$status_type)->get();
        return view ('backend.order.all-orders',compact('orders'));
    }
}