<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Constants;

class CustomerCheckoutController extends Controller
{
    public function index()
    {
        try {
           
            $customer = auth('customer')->user();
            
            $cartOrders = Order::where('customer_id', $customer->id)
                              ->cartStatus()
                              ->with('orderLines.product')
                              ->get();
            
            if ($cartOrders->isEmpty()) {
                return redirect()->route('customer.cart')->with('error', 'Keranjang Anda kosong');
            }
            
            $orderTotalPrice = 0;
            foreach ($cartOrders as $order) {
                foreach ($order->orderLines as $orderLine) {
                    $orderTotalPrice += $orderLine->product->price * $orderLine->quantity;
                }
            }
            
            return view('customer.checkout.index', compact('cartOrders', 'orderTotalPrice'));
            
        } catch (\Exception $e) {
            return redirect()->route('customer.cart')->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

    public function process(Request $request)
    {
        try {
            $customer = auth('customer')->user();
            
            $cartOrders = Order::where('customer_id', $customer->id)
                              ->cartStatus()
                              ->get();
            
            if ($cartOrders->isEmpty()) {
                return redirect()->route('customer.cart')->with('error', 'Keranjang Anda kosong');
            }
            
            foreach ($cartOrders as $order) {
                $order->status_payment = Constants\Orders::STATUS_PAYMENT_PENDING;
                $order->status_delivery = Constants\Orders::STATUS_DELIVERY_PENDING;
                $order->save();
            }
            
            return redirect()->route('customer.transactions')->with('success', 'Pesanan berhasil diproses!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
}