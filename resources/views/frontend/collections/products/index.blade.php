@extends('layouts.app')

@section('title', 'Products')


@section('content')

<link rel="stylesheet" href="{{ asset('asset/css/custom.css') }}">

 <div class="py-3 py-md-5 bg-light">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary back-btn">
                        <a href="{{ url('collections')}}"></a>Back
                    </button>
                    <h4 class="mb-4">Our Products</h4>
                </div>
                @forelse($products as $productItem)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">

                        @if($productItem->quantity > 0)
                            <label class="stock bg-success">In Stock</label>
                            @else
                            <label class="stock bg-danger">Out of Stock</label>
                        @endif

                        @if($productItem->productImages->count() > 0)
                            <a href="{{ url('collections/'.$productItem->category->id.'/'.$productItem->id)}}">
                                <img src="{{ asset($productItem->productImages[0]->image)}}" alt="{{ $productItem->name}}">
                            </a>
                        @endif
                        </div>
                        <div class="product-card-body">
                            <h5 class="product-name">
                               <a href="{{ url('collections/'.$productItem->category->id.'/'.$productItem->name)}}">
                                    {{ $productItem->name}} 
                               </a>
                            </h5>
                            <div>
                                <span class="price">{{ $productItem->price }}</span>
                            </div>
            
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="p-2">
                        <h4 class="text-danger">No Products Available for {{ $category->name }}</h4>
                    </div>
                </div>
                @endforelse

@endsection