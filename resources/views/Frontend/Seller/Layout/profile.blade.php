@extends('Frontend.Seller.master')
@section('content')


<div class="wrapper">

  <div class="profile-card">
    <div class="profile-header">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Altja_j%C3%B5gi_Lahemaal.jpg/1920px-Altja_j%C3%B5gi_Lahemaal.jpg" alt="">
    </div>
    <div class="profile-body">
      <div class="author-img">
        <img src="{{asset('/uploads/Profile/'.$user->image)}}" alt="">
      </div>
      <div class="name">{{$user->name}}</div>
      <div class="intro">
    <h4>Email: {{$user->email}}</h4>
    <h4>Phone: {{$user->phone}}</h4>
    <h4>Address: {{$user->address}}</h4>
      </div>
    </div>
  </div>

</div>
<style>

:root {
  --light: #f1f1f1;
  --white: #fff;
  --dark: #000;
}
body {

  background-color: var(--light);
}
img {
  width: 100%;
  height: auto;
}
.wrapper {
  width: 100%;
  height: 120vh;
}
.profile-card {
  width: 400px;
  height: auto;
  text-align: center;
  margin: 20px auto;
  box-shadow: 0px 0px 18px #ccc;
}
.profile-card .profile-header {
  height: 180px;
}

.profile-card .profile-body {
  background-color: var(--white);
  padding: 20px 40px 40px 40px;
}

.profile-card .profile-body .author-img {
  margin-top: -20px;
  margin-bottom: 20px;
}
.profile-card .profile-body .author-img img {
  width: 170px;
  height: 170px;
  border-radius: 50%;
  padding: 5px;
  background-color: var(--white);
}

.profile-card .profile-body .name {
  font-size: 20px;
  font-weight: 600;
  text-transform: uppercase;
}
.profile-card .profile-body .intro {
  font-size: 14px;
  font-weight: 400;
  line-height: 1.6;
  margin: 20px 0px 30px 0px;
}
.social-icon ul {
  list-style-type: none;
}
.social-icon ul li {
  display: inline-block;
}
.social-icon ul li a {
  margin-right: 5px;
  width: 35px;
  height: 35px;
  border: 1px solid #ddd;
  display: block;
  border-radius: 50%;
  transition: all 0.5s ease-out;
}
.social-icon ul {
  margin: 0;
  padding: 0;
}
.social-icon ul li a:hover {
  background-color: var(--dark);
  border: 1px solid var(--dark);
}
.social-icon ul li a i {
  line-height: 35px;
  color: #666;
}
.social-icon ul li a i:hover,
.social-icon ul li a:hover i {
  color: var(--white);
}

</style>


@endsection