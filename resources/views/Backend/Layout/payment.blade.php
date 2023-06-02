@extends('Backend.master')
@section('content')
@include('flash')
<hr>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Serial</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Product Image</th>
            <th scope="col">Product Name</th>
            <th scope="col">Transaction Number</th>
            <th scope="col">Transaction Amount</th>
            <th scope="col">Date</th>
            <th scope="col">Street Address</th>
            <th scope="col">City</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Seller Name</th>
            <th scope="col">Status</th>

        </tr>
        @foreach($payments as $key => $payment)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$payment->name}}</td>
            <td>{{$payment->email}}</td>
            <td>
            <img src="{{asset('/uploads/Product/'.$payment->product->image)}}" height="50" width="50" />
            </td>
            <td>{{$payment->product->name}}</td>
            <td>{{$payment->transaction_number}}</td>
            <td>{{$payment->transaction_amount}} TK</td>
            <td>{{$payment->date}}</td>
            <td>{{$payment->street_address}}</td>
            <td>{{$payment->city}}</td>
            <td>{{$payment->phone_number}}</td>
            <td>

                @if($payment->seller_id == null)
                Null
                @else
                {{$payment->seller->name}}
                @endif
            </td>
            <td data-status="{{ $payment->status == 1 ? 'confirmed' : 'pending' }}">
                @if($payment->status == 2)
                <form action="{{route('admin_payment_status',$payment->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select name="status" class="form-control" id="exampleInputPassword1" style="height: auto;width:auto;">
                            <option>Pending</option>
                            <option value="1">Confirm</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


                @elseif($payment->status == 1)
                <form action="{{route('admin_payment_status',$payment->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <select name="status" class="form-control" id="exampleInputPassword1" style="height: auto;width:auto;">
                            <option>Confirm</option>
                            <option value="2">Pending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @endif
            </td>

            @endforeach
    </thead>

    </tbody>
</table>
<style>
    
    /* Set background color for pending status */
td[data-status="pending"] {
  background-color: yellow; 
}

/* Set background color for confirmed status */
td[data-status="confirmed"] {
  background-color: #90ee90; 
}

    select[name="status"] option[value="2"] {
  background-color: yellow;
}

select[name="status"] option[value="1"] {
  background-color: #90ee90; 
}

</style>
@endsection