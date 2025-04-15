<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        return view('seller.dashboard.index');
    }
}
