@extends('layouts.app') {{-- atau layout lain yang kamu pakai --}}

@section('content')
<div class="container mt-5">
    <h3>Checkout Preview</h3>
    <hr>

    <div class="card">
        <div class="card-body">
            <h5>Rincian Pesanan</h5>
<ul>
    @foreach ($order->items as $item)
        <li>{{ $item->product->name }} x {{ $item->quantity }} = Rp {{ $item->price * $item->quantity }}</li>
    @endforeach
</ul>

<h5>Total: Rp {{ $order->total_price }}</h5>

<img src="https://api.qrserver.com/v1/create-qr-code/?data={{ urlencode($order->barcode) }}&size=200x200" alt="QR Code">
<p class="mt-2">{{ $order->barcode }}</p>

@endsection
