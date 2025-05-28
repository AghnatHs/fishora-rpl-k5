<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class CustomerDashboardController extends Controller
{
    use Notifiable;

    public function dashboard()
    {
        $notifications = auth('customer')->user()->notifications;
        return view('customer.dashboard.index', compact('notifications'));
    }

    public function inbox()
    {
        $customer = auth('customer')->user();
        if (!$customer) {
            return redirect()->route('customer.login');
        }
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
