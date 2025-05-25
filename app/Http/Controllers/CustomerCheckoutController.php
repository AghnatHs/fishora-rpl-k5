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
            // Ambil data customer yang sedang login
            $customer = auth('customer')->user();
            
            // Gunakan scopeCartStatus untuk mendapatkan cart orders
            $cartOrders = Order::where('customer_id', $customer->id)
                              ->cartStatus()
                              ->with('orderLines.product')
                              ->get();
            
            // Jika cart kosong, redirect ke halaman cart
            if ($cartOrders->isEmpty()) {
                return redirect()->route('customer.cart')->with('error', 'Keranjang Anda kosong');
            }
            
            // Hitung total harga
            $orderTotalPrice = 0;
            foreach ($cartOrders as $order) {
                foreach ($order->orderLines as $orderLine) {
                    $orderTotalPrice += $orderLine->product->price * $orderLine->quantity;
                }
            }
            
            return view('customer.checkout.index', compact('cartOrders', 'orderTotalPrice'));
            
        } catch (\Exception $e) {
            \Log::error('Error in checkout: ' . $e->getMessage());
            return redirect()->route('customer.cart')->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

    public function process(Request $request)
    {
        try {
            // PERBAIKAN: Definisikan $cartOrders terlebih dahulu sebelum menggunakannya
            $customer = auth('customer')->user();
            
            // Gunakan scopeCartStatus yang sudah didefinisikan di model Order
            $cartOrders = Order::where('customer_id', $customer->id)
                              ->cartStatus()
                              ->get();
            
            if ($cartOrders->isEmpty()) {
                return redirect()->route('customer.cart')->with('error', 'Keranjang Anda kosong');
            }
            
            // Proses checkout - Ubah status order dari cart menjadi pending
            foreach ($cartOrders as $order) {
                // Gunakan kolom yang benar (status_payment dan status_delivery, bukan status)
                $order->status_payment = Constants\Orders::STATUS_PAYMENT_PENDING;
                $order->status_delivery = Constants\Orders::STATUS_DELIVERY_PENDING;
                $order->save();
            }
            
            return redirect()->route('customer.transactions')->with('success', 'Pesanan berhasil diproses!');
            
        } catch (\Exception $e) {
            \Log::error('Error in checkout process: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
}