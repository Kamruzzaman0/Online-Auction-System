@extends('Frontend.Seller.master')
@section('content')
@include('flash')

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
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $key => $payment)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$payment->name}}</td>
            <td>{{$payment->email}}</td>
            <td>
                <img src="{{asset('/uploads/Product/'.$payment->product->image)}}" />
            </td>
            <td>{{$payment->product->name}}</td>
            <td>{{$payment->transaction_number}}</td>
            <td>{{$payment->transaction_amount}}</td>
            <td>{{$payment->date}}</td>
            <td>{{$payment->street_address}}</td>
            <td>{{$payment->city}}</td>
            <td>{{$payment->phone_number}}</td>
            <td class="{{$payment->status == 2 ? 'pending' : 'confirm'}}">
                @if($payment->status == 2)
                Pending
                @elseif($payment->status == 1)
                Confirm
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<style>
    /* Style the table header */
    table thead th {
        background-color: #f7f7f7;
        font-weight: bold;
        text-align: left;
        padding: 10px;
    }

    /* Style the table cells */
    table tbody td {
        padding: 10px;
    }

    /* Style the alternating rows */
    table tbody tr:nth-child(even) {
        background-color: #f7f7f7;
    }

    /* Style the product image */
    table tbody img {
        max-height: 50px;
        max-width: 50px;
    }

    /* Style the status column */
    table tbody td:last-child {
        font-weight: bold;
        text-transform: uppercase;
        color: #ffffff;
        padding: 10px;
        border-radius: 5px;
    }

    table tbody td:last-child.pending {
        background-color: #f8a978;
    }

    table tbody td:last-child.confirm {
        background-color: #55b7a7;
    }

    /* Add some margin below the table */
    table {
        margin-bottom: 20px;
    }
</style>



@endsection