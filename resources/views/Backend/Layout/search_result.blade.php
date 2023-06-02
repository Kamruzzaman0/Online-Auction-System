@extends('Backend.master')
@section('content')
@include('flash')


<table class="table" style="border: 1px solid black;">

    @foreach($products as $key => $p)
        <tr>
          <td>{{$key+1}}</td>
           <td>@if($p->image == null)
                <img src="{{asset('/uploads/Product/dummy.webp')}}" height="50" width="50" />
                @else
                <img src="{{asset('/uploads/Product/'.$p->image)}}" height="50" width="50" />
                @endif
            </td>
            <td>{{$p->category->name}}</td>
            <td>{{$p->sub_category->name}}</td>
            <td>{{$p->name}}</td>
            <td>{{$p->description}}</td>
            <td>{{$p->year}}</td>
            <td>{{$p->mini_bid}}</td>
            <td>{{$p->bid_end}}</td>
            <td>{{$p->bid_time}}</td>
            <td><img src="{{asset('/uploads/Auth.image/'.$p->auth_image)}}" height="50" width="50" /></td>
            <td>
                <a class="btn btn" href="{{route('admin_product_edit', $p->id)}}" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                <button type="button" class="btn btn" data-bs-toggle="modal" data-bs-target="#delcatModal{{$p->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="delcatModal{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="delcatModal">Are you want to remove ?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <a type="button" class="btn btn-danger" href="{{route('admin_product_delete', $p->id)}}">Confirm</a>
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">NO</button>
                            </div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
    <tbody>
   
@endforeach

@endsection