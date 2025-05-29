<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{

    public function dashboard()
    {
        $customer = auth('customer')->user();
        $notifications = $customer->notifications;

        $statusCounts = [
            'unpaid' => Transaction::where('customer_id', $customer->id)
                ->where('status', Constants\Orders::TRANSACTION_STATUS_PENDING)
                ->count(),
            'packed' => Order::where('customer_id', $customer->id)
                ->where('status_delivery', Constants\Orders::STATUS_DELIVERY_PACKED)
                ->count(),
            'shipped' => Order::where('customer_id', $customer->id)
                ->where('status_delivery', Constants\Orders::STATUS_DELIVERY_SHIPPED)
                ->count(),
            'completed' => Order::where('customer_id', $customer->id)
                ->where('status_delivery', Constants\Orders::STATUS_DELIVERY_DELIVERED)
                ->count(),
        ];

        $purchasedProducts = Product::whereHas('orderLines.order', function ($q) use ($customer) {
            $q->where('customer_id', $customer->id)
                ->where('status_delivery', Constants\Orders::STATUS_DELIVERY_DELIVERED);
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
