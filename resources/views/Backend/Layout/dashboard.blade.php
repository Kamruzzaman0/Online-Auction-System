@extends('Backend.master')
@section('content')
@include('flash')
<div class='row dashboard-cards'>
    <div class='card col-md-4'>
        <div class='card-title'>
            <h2>
                Number of Category
            </h2>
            @foreach($categories as $key10 => $category)
            <div class='task-count'>
                {{$key10+1}}
            </div>
            @endforeach
        </div>

    </div>
    <div class='card col-md-4'>
        <div class='card-title'>
            <h2>
            Number of Sub Category
            </h2>
            @foreach($sub_categories as $key14 => $sub_category)
            <div class='task-count'>
                {{$key14+1}}
            </div>
            @endforeach
        </div>

    </div>
    <div class='card col-md-4'>
        <div class='card-title'>
            <h2>
            Number of Product
            </h2>
            @foreach($products as $key => $product)
            <div class='task-count'>
                {{$key+1}}
            </div>
            @endforeach
        </div>

    </div>
    <div class='card col-md-4'>
        <div class='card-title'>
            <h2>
                Number of seller
            </h2>
            @foreach($user_s as $key1 => $user1)
            <div class='task-count'>
                {{$key1+1}}
            </div>
            @endforeach
        </div>

    </div>
    <div class='card col-md-4'>
        <div class='card-title'>
            <h2>
                Number of Customer
            </h2>
            @foreach($user_c as $key12 => $user2)
            <div class='task-count'>
                {{$key12+1}}
            </div>
            @endforeach
        </div>

    </div>
    <div class='card col-md-4'>
        <div class='card-title'>
            <h2>
                Number of Payment
            </h2>
            @foreach($payments as $key13 => $payment)
            <div class='task-count'>
                {{$key13+1}}
            </div>
            @endforeach
        </div>

    </div>

</div>

<style>
    body{
        background-color:white;
    }
    .dashboard-cards .card {
        background: #ffffff;
        display: inline-block;
        perspective: 1000;
        z-index: 20;
        padding: 0 !important;
        margin: 5px 5px 10px 5px;
        position: relative;
        text-align: left;
        transition: all 0.3s 0s ease-in;
        z-index: 1;
        width: calc(33.33333333% - 10px);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dashboard-cards .card:hover {
        box-shadow: 0 15px 10px -10px rgba(31, 31, 31, 0.5);
        transition: all 0.3s ease;
    }

    .dashboard-cards .card .card-title {
        background: #ffffff;
        padding: 20px 15px;
        position: relative;
        z-index: 0;
    }

    .dashboard-cards .card .card-title h2 {
        font-size: 24px;
        letter-spacing: -0.05em;
        margin: 0;
        padding: 0;
    }

    .dashboard-cards .card .card-title h2 small {
        display: block;
        font-size: 14px;
        margin-top: 8px;
        letter-spacing: -0.025em;
    }

    .dashboard-cards .card .card-description {
        position: relative;
        font-size: 14px;
        border-top: 1px solid #ddd;
        padding: 10px 15px 0 15px;
    }

    .dashboard-cards .card .card-actions {
        box-shadow: 0 2px 0px 0 rgba(0, 0, 0, 0.075);
        padding: 10px;
        text-align: center;
    }

    .dashboard-cards .card .card-flap {
        background: #d9d9d9;
        position: absolute;
        width: 100%;
        transform-origin: top;
        transform: rotateX(-90deg);
    }

    .dashboard-cards .card .flap1 {
        transition: all 0.3s 0.3s ease-out;
        z-index: -1;
    }

    .dashboard-cards .card .flap2 {
        transition: all 0.3s 0s ease-out;
        z-index: -2;
    }

    .dashboard-cards.showing .card {
        cursor: pointer;
        opacity: 0.6;
        transform: scale(0.88);
    }

    .dashboard-cards .no-touch .dashboard-cards.showing .card:hover {
        opacity: 0.94;
        transform: scale(0.92);
    }

    .dashboard-cards .card.d-card-show {
        opacity: 1 !important;
        transform: scale(1) !important;
    }

    .dashboard-cards .card.d-card-show .card-flap {
        background: #ffffff;
        transform: rotateX(0deg);
    }

    .dashboard-cards .card.d-card-show .flap1 {
        transition: all 0.3s 0s ease-out;
    }

    .dashboard-cards .card.d-card-show .flap2 {
        transition: all 0.3s 0.2s ease-out;
    }

    .dashboard-cards .card .task-count {
        width: 40px;
        height: 40px;
        position: absolute;
        top: 22px;
        right: 10px;
        background: #ecf0f1;
        text-align: center;
        line-height: 40px;
        border-radius: 100%;
        color: #333333;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .dashboard-cards .task-list {
        padding: 0 !important;
    }

    .dashboard-cards .task-list li {
        padding: 10px 0;
        padding-left: 10px;
        margin: 3px 0;
        list-style-type: none;
        border-bottom: 1px solid #e9ebed;
        border-left: 3px solid #f36525;
        transition: all 0.2s ease;
    }

    .dashboard-cards .task-list li:hover {
        background: #ecf0f1;
        transition: all 0.2s ease;
    }

    .dashboard-cards .task-list li span {
        float: right;
        color: #f36525;
        margin-right: 5px;
    }

    .dashboard-cards.showing .card.d-card-show .task-count {
        color: #ffffff;
        background: #f36525;
        transition: all 0.2s ease;
    }

    .dashboard-cards .card-actions .btn {
        color: #333;
    }

    .dashboard-cards .card-actions .btn:hover {
        color: #f36525;
    }
</style>

@endsection