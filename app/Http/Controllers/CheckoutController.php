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
    $user = Auth::user();
    $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('message', 'Cart is empty');
    }

    // Hitung total harga
    $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

    // Buat order baru
    $barcode = 'ORDER-' . strtoupper(uniqid());
    $order = Order::create([
        'user_id' => $user->id,
        'barcode' => $barcode,
        'total_price' => $total,
    ]);

    // Simpan item pesanan
    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $item->product_id,
            'quantity'   => $item->quantity,
            'price'      => $item->product->price,
        ]);
    }

    // Kosongkan keranjang
    Cart::where('user_id', $user->id)->delete();

    // Buat isi QR-nya
    $summary = $order->items->map(function ($item) {
        return "{$item->quantity}x {$item->product->name}";
    })->implode(", ");

    $qrContent = "Order: {$summary}\nTotal: Rp" . number_format($order->total_price, 0, ',', '.');

    $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($qrContent);

    return view('checkout.preview', [
        'order' => $order,
        'qrUrl' => $qrUrl
    ]);
}

}
