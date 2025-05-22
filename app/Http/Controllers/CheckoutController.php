<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
     public function preview()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('message', 'Cart is empty');
        }

        $summary = $cartItems->map(function ($item) {
            return "{$item->quantity}x {$item->product->name}";
        })->implode(", ");

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        $qrContent = "Pesanan: {$summary}\nTotal: Rp " . number_format($total, 0, ',', '.');

        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($qrContent);

        return view('checkout.preview', compact('cartItems', 'total', 'qrUrl'));
    }

}
