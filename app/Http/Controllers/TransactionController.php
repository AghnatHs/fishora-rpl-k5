<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Constants\Orders;
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
        $customerId = auth()->guard('customer')->id();
        Log::info('Fetching unpaid transactions for customer', ['customer_id' => $customerId]);

        $transactions = Transaction::with('order.orderLines.product.seller')
            ->where('status', Orders::TRANSACTION_STATUS_PENDING)
            ->where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->get();

        Log::info('Unpaid transactions query result', [
            'count' => $transactions->count(),
            'transactions' => $transactions->toArray()
        ]);
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'unpaid'
        ]);
    }

    public function packed()
    {
        $transactions = Transaction::with('order.orderLines.product.seller')
            ->whereHas('order', function($query) {
                $query->where('status_delivery', Orders::STATUS_DELIVERY_PACKED);
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
                $query->where('status_delivery', Orders::STATUS_DELIVERY_SHIPPED);
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
                $query->where('status_delivery', Orders::STATUS_DELIVERY_DELIVERED);
            })
            ->where('customer_id', auth()->guard('customer')->id())
            ->get();
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'completed'
        ]);
    }
}