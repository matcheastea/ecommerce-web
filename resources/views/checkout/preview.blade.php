@extends('layouts.app') {{-- atau layout lain yang kamu pakai --}}

@section('content')
<div class="container mt-5">
    <h3>Checkout Preview</h3>
    <hr>

    <div class="card">
        <div class="card-body">
            <h5>Rincian Pesanan:</h5>
            <ul>
                @foreach($cartItems as $item)
                    <li>{{ $item->quantity }}x {{ $item->product->name }} = Rp {{ $item->product->price * $item->quantity }}</li>
                @endforeach
            </ul>

            <h5 class="mt-3">Total: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></h5>

            <div class="mt-4 text-center">
                <h5>Scan QR Code</h5>
                <img src="{{ $qrUrl }}" alt="QR Code" class="border rounded p-2">
                <p class="text-danger mt-2">Show this QR to canteen staff</p>
            </div>
        </div>
    </div>
</div>
@endsection
