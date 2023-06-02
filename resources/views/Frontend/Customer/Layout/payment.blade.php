@extends('Frontend.Customer.master')
@section('content')
@include('flash')

<table class="table" style="padding:10px; margin:10px;">
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
            <th scope="col">Invoice</th>
            <th scope="col">Status</th>

        </tr>
        @foreach($payments as $key => $payment)
        <tr>
            <th scope="row">{{$key+1}}</th>
            <td>{{$payment->name}}</td>
            <td>{{$payment->email}}</td>
            <td>
                <img src="{{asset('/uploads/Product/'.$payment->product->image)}}" height="100" width="100" />
            </td>
            <td>{{$payment->product->name}}</td>
            <td>{{$payment->transaction_number}}</td>
            <td>{{$payment->transaction_amount}} TK</td>
            <td>{{$payment->date}}</td>
            <td>{{$payment->street_address}}</td>
            <td>{{$payment->city}}</td>
            <td>{{$payment->phone_number}}</td>
            <td><a href="{{ route('download', $payment->id) }}">Download Invoice</a></td>
            <td class="{{ $payment->status == 1 ? 'confirm' : 'pending' }}">
                @if($payment->status == 2)
                Pending
                @elseif($payment->status == 1)
                Confirm
                @endif
            </td>

        </tr>
            @endforeach
    </thead>

    </tbody>
</table>

<style>
   /* Style for the table */
.table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  font-size: 0.9rem;
  background-color: #fff;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: middle;
  text-align: center;
  border: 1px solid #dee2e6;
}

/* Style for the status column */
.table td:last-child {
  font-weight: bold;
}

/* Style for the "Confirm" status */
.table .confirm {
  background-color: #d4edda;
  color: #155724;
}

/* Style for the "Pending" status */
.table .pending {
  background-color: #f8d7da;
  color: #721c24;
}

</style>


@endsection