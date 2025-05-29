<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class CustomerDashboardController extends Controller
{
    
    public function dashboard()
    {
        $customer = auth('customer')->user();
        $notifications = $customer->notifications;

        $statusCounts = [
            'unpaid' => \App\Models\Transaction::where('customer_id', $customer->id)
                ->where('status', \App\Constants\Orders::TRANSACTION_STATUS_PENDING)
                ->count(),
            'packed' => \App\Models\Order::where('customer_id', $customer->id)
                ->where('status_delivery', \App\Constants\Orders::STATUS_DELIVERY_PACKED)
                ->count(),
            'shipped' => \App\Models\Order::where('customer_id', $customer->id)
                ->where('status_delivery', \App\Constants\Orders::STATUS_DELIVERY_SHIPPED)
                ->count(),
            'completed' => \App\Models\Order::where('customer_id', $customer->id)
                ->where('status_delivery', \App\Constants\Orders::STATUS_DELIVERY_DELIVERED)
                ->count(),
        ];

        $purchasedProducts = \App\Models\Product::whereHas('orderLines.order', function($q) use ($customer) {
            $q->where('customer_id', $customer->id)
              ->where('status_delivery', \App\Constants\Orders::STATUS_DELIVERY_DELIVERED);
        })->with('images')->get();

        return view('customer.dashboard.index', compact('notifications', 'statusCounts', 'purchasedProducts'));
    }

    public function inbox()
    {
        $customer = auth('customer')->user();
        $notifications = $customer->notifications;
        return view('customer.dashboard.inbox', compact('notifications'));
    }

    public function markAsReadNotification($id)
    {
        $notification = auth('customer')->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return back()->with('status', 'Notification marked as read.');
    }

    public function transactions()
    {
        $customer = auth('customer')->user();
        $transactions = $customer->transactions;
        $notifications = $customer->notifications;
        $activeTab = request('tab', 'unpaid');

        return view('customer.dashboard.transactions', compact('transactions', 'notifications', 'activeTab'));
    }
}
