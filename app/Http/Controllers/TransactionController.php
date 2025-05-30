<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Constants;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function index()
    {
        // Default to unpaid transactions
        return redirect()->route('customer.transactions.unpaid');
    }

    public function unpaid()
    {
        $customer = auth('customer')->user();
        
        Log::info('Fetching unpaid transactions for customer', ['customer_id' => $customer->id]);
        
        // Get transactions from database
        $transactions = Transaction::where('customer_id', $customer->id)
                          ->where('status', Constants\Orders::TRANSACTION_STATUS_PENDING)
                          ->with(['order.orderLines.product'])
                          ->get();
        
        Log::info('Unpaid transactions query result', [
            'count' => $transactions->count(),
            'transactions' => $transactions->toArray()
        ]);
        
        // Get processed orders from session if they exist
        $processedOrders = session('processed_orders', []);
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'processed_orders' => $processedOrders,
            'activeTab' => 'unpaid'
        ]);
    }

    public function packed()
    {
        $transactions = Transaction::with('order.orderLines.product.seller')
            ->whereHas('order', function($query) {
                $query->where('status_delivery', Constants\Orders::STATUS_DELIVERY_PACKED);
            })
            ->where('customer_id', auth()->guard('customer')->id())
            ->get();
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'packed'
        ]);
    }

    public function shipped()
    {
        $transactions = Transaction::with('order.orderLines.product.seller')
            ->whereHas('order', function($query) {
                $query->where('status_delivery', Constants\Orders::STATUS_DELIVERY_SHIPPED);
            })
            ->where('customer_id', auth()->guard('customer')->id())
            ->get();
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'shipped'
        ]);
    }

    public function completed()
    {
        $transactions = Transaction::with('order.orderLines.product.seller')
            ->whereHas('order', function($query) {
                $query->where('status_delivery', Constants\Orders::STATUS_DELIVERY_DELIVERED);
            })
            ->where('customer_id', auth()->guard('customer')->id())
            ->get();
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'completed'
        ]);
    }

    public function pay($id)
    {
        $transaction = \App\Models\Transaction::with('order')->findOrFail($id);
        $order = $transaction->order;
        $order->status_delivery = \App\Constants\Orders::STATUS_DELIVERY_PACKED;
        $order->save();
        $transaction->status = \App\Constants\Orders::TRANSACTION_STATUS_PAID;
        $transaction->save();
        return redirect()->route('customer.transactions.packed')->with('status', 'Pesanan sedang dikemas.');
    }
}