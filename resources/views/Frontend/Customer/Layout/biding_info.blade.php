@extends('Frontend.Customer.master')
@section('content')
@include('flash')
<table class="table " style="border: 1px solid black; padding:10px; margin:10px;" >
  <thead>
    <tr>
      <th scope="col">Serial</th>
      <th scope="col">Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Description</th>
      <th scope="col">Details</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $key => $product)

    <tr>
      <th scope="row mx-2" style="padding: 50px;" >{{$key+1}}</th>
      <td>@if($product->image == null)
        <img src="{{asset('/uploads/Product/dummy.webp')}}" height="50" width="50" />
        @else
        <img src="{{asset('/uploads/Product/'.$product->image)}}" height="50" width="50" />
        @endif
      </td>
      <td>{{$product->name}}</td>
      <td>{{$product->description}}</td>
      <td>
        <button type="button" class="button1 ms-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$product->id}}">
          Bid Details
        </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Bid Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Serial</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Win Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @foreach($bidss as $key1 => $bid)
                    @if($product->id == $bid->item_id )
                    <tr>
                      @php
                      $to = \Carbon\Carbon::now();
                      $finishTime =\Carbon\Carbon::parse($product->bid_end);
                      $time =$product->bid_time;
                      @list($hours, $minutes) = explode(':', $time);
                      $end = $finishTime->addHours($hours)->addMinutes($minutes);
                      $max = App\Models\Bid::where('item_id', $product->id)->max('bid_a');
                      @endphp
                      <th scope="row">{{$key1+1}}</th>
                      <td>{{$bid->user->name}}</td>
                      <td>{{$bid->user->email}}</td>
                      <td>{{$bid->bid_a}} TK</td>
                      <td>
                        @if($to>$end && $max == $bid->bid_a)
                        <p id="winner" class="text-success" value="#">Winner</p>
                        @elseif ($to>$end)
                        <p id="winner" class="text-danger" value="#"> Try Next Time</p>
                        @else
                        <p id="winner" class="text-danger" value="#"></p>
                        @endif
                      </td>
                    </tr>
                    @endif
                    @endforeach

                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<style>
  .table {
  border: 1px solid black;
  border-collapse: collapse;
  width: 100%;
  font-size: 16px;
  margin: 20px 0;
}

.table th,
.table td {
  border: 1px solid black;
  padding: 10px;
  text-align: left;
}

.table th {
  background-color: lightgray;
}

.table td img {
  display: block;
  margin: 0 auto;
}

.button1 {
  background-color: cadetblue;
  border-radius: 10px;
  border: 9px;
  height: 40px;
  width: 100px;
  margin-top: 20px;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

.button1:hover {
  background-color: silver;
  transition: 0.7s;
}
</style>
@endsection