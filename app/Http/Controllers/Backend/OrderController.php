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

    public function editOrder ($id)
    {
        $order = Order::with('orderDetails')->where('id',$id)->first();
        // dd($order);
        return view ('backend.order.edit-order', compact('order')); 
    }

    public function updateOrder (Request $request, $id)
    {
       $order = Order::find($id);

       $order->c_name = $request->c_name;
       $order->c_phone = $request->c_phone;
       $order->address = $request->address;
       $order->area = $request->area;
       $order->courier_name = $request->courier_name;
       $order->price = $request->price;

       $order->save();
       toastr()->success('Order updated Successfully');
       return redirect()->back();

    }
}