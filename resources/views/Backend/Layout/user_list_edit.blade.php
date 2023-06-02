@extends('Backend.master')
@section('content')
@include('flash')
<form action="{{route('admin_userlist_update',$user->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Name" value="{{$user->name}}">
        
    </div>
    <div class="mb-3">
    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <label for="exampleInputEmail1" class="form-label">Email </label>
        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email" value="{{$user->email}}">
    </div>
    <div class="mb-3">
    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <label for="exampleInputPassword1" class="form-label">Phone</label>
        <input type="tel" class="form-control" name="phone" id="exampleInputPassword1" placeholder="Enter your phone number" value="{{$user->phone}}">
    </div>
    <div class="mb-3">
    @if($user->image == null)
          <img src="{{asset('/uploads/Profile/dummy.webp')}}" height="50" width="50"/>
        @else
          <img src="{{asset('/uploads/Profile/'.$user->image)}}" height="50" width="50"/>
        @endif

        <input type="file" class="form-control" name="image" id="exampleInputPassword1" placeholder="Enter your Image" value="{{$user->image}}">
    </div>
    <div class="mb-3">
    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <label for="exampleInputPassword1" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" id="exampleInputPassword1" placeholder="Enter Address" value="{{$user->address}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection