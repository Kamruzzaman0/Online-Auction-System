@extends('Frontend.Seller.master')
@section('content')
@include('flash')

<form action="{{route('seller_category_update',$category->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Category Name</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$category->name}}">
        
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" id="exampleInputPassword1" placeholder="Enter Address" value="{{$category->description}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection