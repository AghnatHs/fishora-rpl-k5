<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        // Default to unpaid transactions
        return redirect()->route('customer.transactions.unpaid');
    }

    public function unpaid()
    {
        $transactions = Transaction::with('order.orderLines.product.seller')
            ->whereHas('order', function($query) {
                $query->where('status', 'unpaid');
            })
            ->where('customer_id', auth()->guard('customer')->id())
            ->get();
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'unpaid'
        ]);
    }

    public function packed()
    {
        $transactions = Transaction::with('order.orderLines.product.seller')
            ->whereHas('order', function($query) {
                $query->where('status', 'packed');
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
                $query->where('status', 'shipped');
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
                $query->where('status', 'completed');
            })
            ->where('customer_id', auth()->guard('customer')->id())
            ->get();
        
        return view('customer.dashboard.transactions', [
            'transactions' => $transactions,
            'activeTab' => 'completed'
        ]);
    }
}