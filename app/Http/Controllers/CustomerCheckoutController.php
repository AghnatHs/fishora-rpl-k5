<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Constants;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;

class CustomerCheckoutController extends Controller
{
    public function index(Request $request)
    {
        try {
            $customer = auth('customer')->user();
            
            // Jika request POST, proses checkout
            if ($request->isMethod('post')) {
                Log::info('Starting checkout process', ['customer_id' => $customer->id]);
                
                $cartOrders = Order::where('customer_id', $customer->id)
                                ->cartStatus()
                                ->with('orderLines.product')
                                ->get();
                
                if ($cartOrders->isEmpty()) {
                    Log::info('Cart is empty', ['customer_id' => $customer->id]);
                    return redirect()->route('customer.cart')->with('error', 'Keranjang Anda kosong');
                }
                
                Log::info('Found cart orders', [
                    'customer_id' => $customer->id,
                    'order_count' => $cartOrders->count(),
                    'order_ids' => $cartOrders->pluck('id')->toArray()
                ]);
                
                foreach ($cartOrders as $order) {
                    // Calculate total amount
                    $totalAmount = 0;
                    foreach ($order->orderLines as $orderLine) {
                        $totalAmount += $orderLine->product->price * $orderLine->quantity;
                    }

                    // Get first product name for transaction
                    $firstProduct = $order->orderLines->first()->product;

                    Log::info('Updating order status', [
                        'order_id' => $order->id,
                        'current_status_payment' => $order->status_payment,
                        'current_status_delivery' => $order->status_delivery
                    ]);

                    // Update order status
                    $order->status_payment = Constants\Orders::STATUS_PAYMENT_PENDING;
                    $order->status_delivery = Constants\Orders::STATUS_DELIVERY_PENDING;
                    $order->save();

                    Log::info('Order status updated', [
                        'order_id' => $order->id,
                        'new_status_payment' => $order->status_payment,
                        'new_status_delivery' => $order->status_delivery
                    ]);

                    try {
                        // Create transaction record
                        $transaction = Transaction::create([
                            'customer_id' => $customer->id,
                            'order_id' => $order->id,
                            'product_name' => $firstProduct->name,
                            'amount' => $totalAmount,
                            'status' => Constants\Orders::TRANSACTION_STATUS_PENDING
                        ]);
                        
                        Log::info('Creating transaction with data', [
                            'customer_id' => (string)$transaction->customer_id,
                            'order_id' => (string)$order->id,
                            'product_name' => $firstProduct->name,
                            'amount' => $totalAmount,
                            'status' => $transaction->status
                        ]);
                        
                        Log::info('Transaction saved successfully', ['transaction_id' => $transaction->id]);

                        // Reduce product stock
                        foreach ($order->orderLines as $orderLine) {
                            $product = $orderLine->product;
                            $product->stock -= $orderLine->quantity;
                            $product->save();
                            Log::info('Product stock reduced', [
                                'product_id' => $product->id,
                                'new_stock' => $product->stock
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('Error creating transaction', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString(),
                            'customer_id' => $customer->id,
                            'order_id' => $order->id
                        ]);
                        throw $e;
                    }
                }
                
                // Clear cart count from session after successful checkout
                session()->forget('cart_count');
                Log::info('Cart count cleared from session');
                
                // Redirect to unpaid transactions page
                Log::info('Redirecting to unpaid transactions page');
                return redirect()->route('customer.transactions.unpaid')
                               ->with('status', 'Checkout berhasil! Silahkan lakukan pembayaran.');
            }
            
            // Jika request GET, tampilkan halaman checkout
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
            Log::error('Error during checkout process', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }

    public function process(Request $request)
    {
      
        return redirect()->route('customer.transactions.unpaid')->with('status', 'Pesanan berhasil dibuat!');
    }
}