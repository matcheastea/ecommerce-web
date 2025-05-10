@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<!-- link -->
<link rel="stylesheet" href="{{asset('asset/css/custom.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">


<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{ asset('asset/img/bayar.png')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
        <h5>Mudah & Cepat</h5>
        <p>Tunjukan QR Code untuk pembelian tanpa antre di kantin sekolah</p>
    </div>
</div>
<div class="carousel-item">
    <img src="{{asset('asset/img/animasigedung.png')}}" class="d-block w-100" alt="...">
    <div class="carousel-caption d-none d-md-block">
        <h5>Lingkungan Kantin Bersih</h5>
        <p>Beli makanan lebih nyaman di lingkungan kantin yang praktis dan bersih</p>
    </div>
    </div>
    <div class="carousel-item">
        <img src="{{asset('asset/img/makan.png')}}" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Jajanan Tasty!</h5>
        <p>Berbagai pilihan jajanan yang enak dan murah</p>
      </div>
    </div>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
</div>

@endsection