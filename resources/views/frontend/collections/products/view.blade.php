@extends('layouts.app')

@section('title', 'Details Product')


@section('content')

<link rel="stylesheet" href="{{ asset('asset/css/custom.css') }}">

<div>
    <livewire:frontend.product.view :category="$category" :product="$product"/>
</div>
@endsection