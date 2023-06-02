@extends('Frontend.Seller.master')
@section('content')
@include('flash')
<form action="{{route('seller_product_update', $products->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Product Name</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$products->name}}">

    </div>
    <div class="mb-3">
        @if($products->image == null)
        <img src="{{asset('/uploads/Product/dummy.webp')}}" height="50" width="50" />
        @else
        <img src="{{asset('/uploads/Product/'.$products->image)}}" height="50" width="50" />
        @endif

        <input type="file" class="form-control" name="image" id="exampleInputPassword1" placeholder="Enter your Image" value="{{$products->image}}">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> Category Name</label>
        <select name="cate_id" class="form-control" id="exampleInputPassword1">
            <option>Choose Category</option>
            @foreach($categories as $category)
            <option @if($products->cate_id == $category->id)selected @endif value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
        <select name="sub_cate_id" class="form-control" id="exampleInputPassword1">
            <option>Choose Sub Category</option>
            @foreach($sub_categories as $sub_category)
            <option @if($products->sub_cate_id == $sub_category->id)selected @endif value="{{$sub_category->id}}">{{$sub_category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" id="exampleInputPassword1" placeholder="Enter Address" value="{{$products->description}}">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Year</label>
        <input type="date" class="form-control" name="year" id="exampleInputPassword1" placeholder="Enter Address" value="{{$products->year}}">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Bid Amount</label>
        <input type="number" class="form-control" name="mini_bid" id="exampleInputPassword1" placeholder="Enter Address" value="{{$products->mini_bid}}">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Bid End Date</label>
        <input type="date" class="form-control" name="bid_end" id="exampleInputPassword1" placeholder="Enter Address" value="{{$products->bid_end}}">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Bid End Time</label>
        <input type="time" class="form-control" name="bid_time" id="exampleInputPassword1" value="{{$products->bid_time}}">
    </div>
    <div class="mb-3">
        <img src="{{asset('/uploads/Auth.image/'.$products->auth_image)}}" height="50" width="50" />

        <input type="file" class="form-control" name="auth_image" id="exampleInputPassword1" placeholder="Enter your Image" value="{{$products->auth_image}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection