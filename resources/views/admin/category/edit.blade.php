@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Category
                    <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <form action="{{url('admin/category'.$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                        @error('name')
                           <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                        @error('description')</textarea>
                           <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ asset('uploads/category/'.$category->image) }}" width="60px" height="60px">
                    @error('image')
                           <small class="text-danger">{{$message}}</small>
                        @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label>Status</label><br>
                    <input type="checkbox" name="status" {{ $category->status == '1' ? 'checked':''}}>
                    @error('status')
                           <small class="text-danger">{{$message}}</small>
                        @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <button type="btn btn-primary float-end">Update</button>
                </div> 
            </form>
        </div>
    </div>
</div>