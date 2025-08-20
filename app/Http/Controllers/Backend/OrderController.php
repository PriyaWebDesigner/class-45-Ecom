<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function showAllOrders()
    {
        $orders = Order::with('orderDetails')->get();
        // dd($orders);
        return view('backend.order.all-orders', compact('orders'));
    }

    public function updateStatus($order_id, $status_type)
    {
        $order = Order::find($order_id);
        $order->status = $status_type;


        //Courier API Integration...
        if ($status_type == 'delivered') {
            if ($order->courier_name == 'steadfast') {

                $endPoint = "https://portal.packzy.com/api/v1/create_order";

                //Auth Parameter...
                $apiKey = "hcxcwi09kxxtbrt7sbkkgypg1hrzc2sk";
                $secretKey = "jfq0xnr0hmc3stowv1na0wso";
                $contentType = "application/json";

                //Body Parameter...
                $invoiceNumber = $order->invoiceId;
                $customerName = $order->c_name;
                $customerPhone = $order->c_phone;
                $customerAddress = $order->address;
                $price = $order->price;

                //The Header...
                $header = [
                    'Api-Key' => $apiKey,
                    'Secret-Key' => $secretKey,
                    'Content-Type' => $contentType,
                ];

                //The Payloads
                $payload = [
                    'invoice' => $invoiceNumber,
                    'recipient_name' => $customerName,
                    'recipient_phone' => $customerPhone,
                    'recipient_address' => $customerAddress,
                    'cod_amount' => $price,
                ];

                $response = Http::withHeaders($header)->post($endPoint, $payload);
                $responsedata = $response->json();
                // dd($responsedata);
            } elseif ($order->courier_name == 'redx') {
                //Courier API
            } elseif ($order->courier_name == 'others') {
                //Courier API
            } else {
                toastr()->error('Courier not selected');
                return redirect()->back();
            }
            // End Courier API Integration...
        }

        $order->save();
        toastr()->success('Satus updated Successfully');
        return redirect()->back();
    }

    public function statusWiseOrder($status_type)
    {
        $orders = Order::with('orderDetails')->where('status', $status_type)->get();
        return view('backend.order.all-orders', compact('orders'));
    }

    public function editOrder($id)
    {
        $order = Order::with('orderDetails')->where('id', $id)->first();
        // dd($order);
        return view('backend.order.edit-order', compact('order'));
    }

    public function updateOrder(Request $request, $id)
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

    public function sellReport(Request $request)
    {

        if (isset($request->form) && isset($request->to)) {
            $orders = Order::whereDate('created_at', '>=', $request->form)->whereDate('created_at', '>=', $request->to)->where('status', 'delivered')->with('orderDetails')->get();
        } 
        else {
            $orders = Order::whereYear('created_at', now()->year)->whereMonth('created_at', now()->month)->where('status', 'delivered')->with('orderDetails')->get();
        }

        $totalOrder = $orders->count();
        $totalSell = $orders->sum('price');

        $totalBuyingCost = 0;
        $totalCharge = 0;

        foreach ($orders as $order) 
        {
            $totalCharge += $order->area;  // Sum all courier/delivery charges


            foreach ($order->orderDetails as $details) 
            {
                $buyingPrice = $details->product->buying_price ?? 0; // fallback to 0 of noy found
                $qty = $details->qty ?? 0;

                $totalBuyingCost += ($buyingPrice * $qty);
            }
        }

        // Now calculate profit...
        $profitAmount = $totalSell - $totalBuyingCost - $totalCharge;


        return view('backend.order.report',compact('orders','totalOrder','totalSell','totalCharge','profitAmount'));
    }
}
