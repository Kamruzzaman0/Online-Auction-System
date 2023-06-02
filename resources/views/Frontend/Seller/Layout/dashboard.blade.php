@extends('Frontend.Seller.master')
@section('content')
@include('flash')

<div class="main">
<h1 class="mx-5">Welcome to our seller panel</h1>
<hr>
<h2 class="mx-5">Name: {{Auth::user()->name}}</h2>
</div>

<style>

   .main {
  margin: 20px auto;
  max-width: 600px;
  text-align: center;
}

h1, h2 {
  font-family: Arial, sans-serif;
  font-weight: bold;
  margin: 0;
}

h1 {
  font-size: 32px;
  margin-bottom: 20px;
}

h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

hr {
  border: none;
  border-top: 2px solid #ccc;
  margin: 30px 0;
}

</style>
@endsection