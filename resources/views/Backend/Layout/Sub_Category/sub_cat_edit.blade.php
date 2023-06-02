@extends('Backend.master')
@section('content')
<form action="{{route('admin_sub_category_update',$sub_category->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$sub_category->name}}">
        
    </div>
    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> Category Name</label>
                        <select name="cate_id"  class="form-control" id="exampleInputPassword1">
                            <option >Choose Category</option>
                            @foreach($categories as $category)
                            <option @if($sub_category->cate_id == $category->id)selected @endif value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" id="exampleInputPassword1" placeholder="Enter Address" value="{{$sub_category->description}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection