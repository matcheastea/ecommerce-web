@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Products
                    <a href="{{ url('admin/products/') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
              
            @if(session('message'))
              <h5 class="alert alert-success mb-2">{{ session('message')}}</h5>
            @endif

            @if ($errors->any())
              <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
              </div>
                @endforeach
            @endif
              <form action="{{ url ('admin/products/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
      Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="false">
      Product Image</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
    <div class="mb-3">
      <label>Category</label>
      <select name="category_id" class="form-control">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{$category->id == $product->category_id ? 'selected':''}}>{{ $category->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label>Product Name</label>
      <input type="text" name="name" value="{{ $product->name }}" class="form-control"/>
    </div>
    <div class="mb-3">
      <label>Description</label>
      <textarea name="description" rows="4" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="mb-3">
      <label>Price</label>
      <input type="text" name="price" value="{{ $product->price}}" class="form-control"/>
    </div>
    <div class="mb-3">
      <label>Quantity</label>
      <input type="number" name="quantity" value="{{ $product->quantity}}" class="form-control"/>
    </div>
    <div class="mb-3">
      <label>Status</label>
      <input type="checkbox" name="status" value="{{ $product->status}}" style="width: 50px; height: 50px;"/>
    </div>
  </div>
  <div class="tab-pane fade" id="image-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
    <div class="mb-3">
      <label>Upload Product Images</label>
      <input type="file" name="image[]" multiple class="form-control"/>
    </div>
  </div>
  @if($product->productImages)
  <div class="row">
    @foreach($product->productImages as $image)
    <div class="col-md-2">
      <img src="{{ asset('$image->image')}}" style="width:  80px; height:80px;" class="me-4" alt="Img">
      <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="d-block">Remove</a>
      </div>
      @endforeach
  </div>
  @else
  <h5>No Image Added/h5>
  @endif
  <div>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
  </form>
</div>

@endsection