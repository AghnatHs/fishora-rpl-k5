<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        $notifications = auth('customer')->user()->notifications;
        return view('customer.dashboard.index', compact('notifications'));
    }

    public function inbox()
    {
        $notifications = auth('customer')->user()->notifications;
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
        $transactions = auth('customer')->user()->transactions;
        return view('customer.dashboard.transactions', compact('transactions'));
    }
}
