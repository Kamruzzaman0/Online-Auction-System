@extends('Frontend.Customer.master')
@section('content')
@include('flash')
<form action="{{route('customer_updated_info')}}" method="post" enctype="multipart/form-data">
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
    <div class="mb-3">
    
    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Your New Password" >
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<style>
    form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.form-label {
  font-weight: bold;
}

.form-control {
  display: block;
  width: 100%;
  padding: 8px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid #ccc;
  margin-bottom: 10px;
}

.form-control:focus {
  outline: none;
  box-shadow: 0 0 5px #b3d4fc;
  border-color: #b3d4fc;
}

.btn {
  display: block;
  margin: 20px auto 0;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  border: none;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
}

.btn:hover {
  background-color: #0069d9;
}

</style>
@endsection