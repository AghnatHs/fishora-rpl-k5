<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman checkout
        return view('customer.checkout.index');
    }
}