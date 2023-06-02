@extends('Interface.master')
@section('content')
@include('flash')
<header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Bid Now In Your Style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With This Online Bid WEBSITE</p>
            </div>
        </div>
    </header>
<section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        @if($product->image == null)
                        <img class="card-img-top" src="{{asset('/uploads/Product/dummy.webp')}}" alt="...."/>
                        @else
                        <img class="card-img-top" src="{{asset('/uploads/Product/'.$product->image)}}" />
                        @endif
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                {{$product->name}}
                                <h5 class="fw-bolder">{{$product->category->name}}</h5>
                               Bid Start: {{$product->mini_bid}} TK

                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{route('user_interface_details',$product->id)}}">View details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>
    @endsection