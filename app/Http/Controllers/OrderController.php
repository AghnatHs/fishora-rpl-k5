<?php

namespace App\Http\Controllers;

use App\Constants;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function indexOnlyCart(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $cartOrders = Order::with('orderLines.product')
            ->where('customer_id', $customer->id)
            ->where('status_delivery', \App\Constants\Orders::STATUS_DELIVERY_CART)
            ->where('status_payment', \App\Constants\Orders::STATUS_PAYMENT_CART)
            ->orderByDesc('created_at')
            ->get();

        return dd($cartOrders);
    }


    public function storeOrUpdate(Request $request, Product $product)
    {
        $customer = Auth::guard('customer')->user();

        $order = Order::firstOrCreate(
            [
                'customer_id' => $customer->id,
                'status_delivery' => Constants\Orders::STATUS_DELIVERY_CART,
                'status_payment' => Constants\Orders::STATUS_PAYMENT_CART
            ],
            []
        );

        $orderLine = $order->orderLines()->where('product_id', $product->id)->first();
        $orderLineQuantity = $orderLine->quantity;
        $quantityAfterAdded = $orderLineQuantity + 1;

        if ($quantityAfterAdded > $product->stock) {
            return back()->with('error', "Stock not enough for {$product->name}");
        }

        if ($orderLine) {
            $orderLine->update([
                'quantity' => $orderLine->quantity + 1
            ]);
        } else {
            $order->orderLines()->create([
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', "{$product->name} succesfully added to cart");
    }

    public function destroyProduct(Request $request, Order $order, Product $product)
    {
        $customer = Auth::guard('customer')->user();

        if ($order->customer_id !== $customer->id) {
            abort(403, 'Unauthorized action.');
        }

        $orderLine = $order->orderLines()->where('product_id', $product->id)->first();

        if (! $orderLine) {
            return back()->with('error', "{$product->name} is not in your cart.");
        }

        if ($orderLine->quantity > 1) {
            $orderLine->update([
                'quantity' => $orderLine->quantity - 1
            ]);
        } else {
            $orderLine->delete();
        }

        if ($order->orderLines()->count() === 0) {
            $order->delete();
        }

        return back()->with('success', "1 {$product->name} removed from your cart.");
    }
}
