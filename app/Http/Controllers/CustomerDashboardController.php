<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard.index');
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
}
