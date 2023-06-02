@extends('Frontend.Customer.master')
@section('content')
@include('flash')


<!-- Button trigger modal -->
<a href="#"> <button type="button" class="button1 ms-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></a>
Bid Details
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <th scope="col">Amount</th>
                            <th scope="col">Win Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bids as $key => $bid)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$bid->user->name}}</td>
                            <td>{{$bid->bid_a}} TK</td>
                            <td>@if($to>$end && $max == $bid->bid_a)
                                <p id="winner" class="text-success" value="#">Winner</p>
                                @elseif ($to>$end)
                                <p id="winner" class="text-danger" value="#"> Try Next Time</p>
                                @else
                                <p id="winner" class="text-danger" value="#"></p>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
<p1>
    <section class="section">

        <div class="container">
            <div class="row">
                <div class="col-md-5 mb-4 mb-md-0">

                    <div class="product-image-slider">

                        <div data-image="images/showcase/showcase-1.png">
                            @if($product->image == null)
                            <img class="img-fluid w-100" src="{{asset('/uploads/Product/dummy.webp')}}" alt="...." />
                            @else
                            <img class="img-fluid w-100" src="{{asset('/uploads/Product/'.$product->image)}}" />
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-lg-6 col-md-7 offset-lg-1">
                    <h1 class="mb-4">{{$product->name}}</h1>
                    <p><strong>Category: </strong>{{$product->category->name}}</p>
                    <p><strong>Sub-Category: </strong>{{$product->sub_category->name}}</p>
                    <p><strong>Year: </strong>{{$product->year}}</p>

                    @php
                    $today = \Carbon\Carbon::now();
                    //dd($today);
                    $startTime = \Carbon\Carbon::parse($today);
                    $finishTime = \Carbon\Carbon::parse($product->bid_end);
                    
                    $time =$product->bid_time;
                    list($hours, $minutes) = explode(':', $time);
                    $test = $finishTime->addHours($hours)->addMinutes($minutes);
                   
                    $diff = $test->diff($startTime);
                    if ($diff->days >= 1){
                    $total = $test->diffForHumans($startTime);
                    }
                    @endphp

                    @if($diff->days < 1) <button id="click_time" value="{{$product->id}}" class="d-none">Click Here</button>
                        @endif
                        @if ($diff->days >= 1)
                        <p><strong>Time Remaining: </strong><span>{{$total}}</span> </p>
                        @else
                        <p><strong>Time Remaining: </strong><span id="print_time"></span> </p>
                        @endif
                        <p><strong>Bid End: </strong>{{$product->bid_end}}</p>
                        <p class="price py-4"><strong>Amount Start: </strong>
                            {{$product->mini_bid}} TK
                        </p>
                        @if($to<=$end ) 

                            <form action="{{route('customer_bid',[auth()->user()->id,$product->id])}}" method="post">
                            @csrf
                            <input type="number" name="bid_a" class="mb-4" id="firstName" placeholder="Enter Your Bid Amount" />
                            <br>
                            <button class="button mb-5">Bid Now</button>
                            <div class="content">
                                </form>
                                @else
                                <h3 class="text-danger">Bid Has Finished, Try Next Time.</h3>
                                @endif

                            </div>
                </div>
            </div>
            <hr>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Details</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Authentication Certificate</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" style="margin: 20px;" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">{{$product->description}}</div>
                <div class="tab-pane fade" id="nav-profile" style="text-align: center;" role="tabpanel" aria-labelledby="nav-profile-tab"> <img src="{{asset('/uploads/Auth.image/'.$product->auth_image)}}" height="500" width="500" /></div>
            </div>
        </div>
        </div>
    </section>
</p1>

@section('js_code')
<script>
    $(document).ready(function() {
        // $('#click_time').click();

        setInterval(function(){
            $('#click_time').click();
        },1000);

        $(document).on('click', '#click_time', function(ev) {
            ev.preventDefault();
            let p_id = $(this).val();
            let url = "{{route('get_time',[':p_id'])}}";
            url = url.replace(':p_id', p_id);

            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    $('#print_time').text(data.total);
                }
            });
        });

    });


</script>
@endsection
<style>
    /**
 * WEBSITE: https://themefisher.com
 * TWITTER: https://twitter.com/themefisher
 * FACEBOOK: https://www.facebook.com/themefisher
 * GITHUB: https://github.com/themefisher/
 */

    /*--
    Common Css
--*/

    .winner {
        border-radius: 5px;
    }

    html {
        overflow-x: hidden;
    }

    body {
        font-size: 14px;
        font-weight: 300;
        line-height: 25px;
        color: #3b4045;
        font-family: "Josefin Sans", sans-serif;
        -webkit-font-smoothing: antialiased;
    }

    .button1 {
        background-color: lightseagreen;
        border-radius: 8px;
        border: 9px;
        height: 40px;
        width: 100px;
        margin-top: 20px;
    }

    .button1:hover {
        background-color: silver;
        transition: 0.7s;
    }

    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #fff;
        z-index: 999999;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 300;
        margin: 0px;
    }

    h1,
    .h1 {
        font-size: 44px;
        line-height: 56px;
    }

    h2,
    .h2 {
        font-size: 30px;
        line-height: 35px;
    }

    h3,
    .h3 {
        font-size: 23px;
        line-height: 25px;
    }

    h4,
    .h4 {
        font-size: 20px;
        line-height: 24px;
        font-weight: 400;
    }

    p {
        font-size: 18px;
        line-height: 25px;
    }

    ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    a {
        transition: all 0.2s ease-in-out 0s;
    }

    .mt-100 {
        margin-top: 100px;
    }

    .bg-1 {
        background-image: url(../images/call-to-action.jpg);
    }

    .bg-orange {
        background: #f9a743;
    }

    .bg-opacity {
        position: relative;
    }

    .bg-opacity:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
    }

    a:focus,
    .btn:focus,
    .btn:active:focus {
        box-shadow: none;
        outline: 0 none;
    }

    a,
    a:active,
    a:focus,
    a:active {
        text-decoration: none;
    }

    .section {
        padding: 100px 0;
    }

    .font-size-60 {
        font-size: 60px;
        line-height: 1.2;
    }

    @media (max-width: 575px) {
        .font-size-60 {
            font-size: 40px;
        }
    }

    .button {
        background-color: #f9a743;
        border-radius: 5px;
        border: 5px;
        height: 40px;
        width: 100px;
    }

    .button:hover {
        background-color: chocolate;
        transition: 0.7s;
    }

    .mb-10 {
        margin-bottom: 10px;
    }

    .mb-40 {
        margin-bottom: 40px;
    }

    .slick-slide {
        outline: 0;
    }

    /*--
    custom heading
--*/
    .text-center {
        text-align: center;
    }

    .heading {
        text-align: center;
        color: #777777;
        padding-bottom: 70px;
    }

    .heading h2 {
        color: #3c3c3c;
        padding-bottom: 15px;
        text-transform: capitalize;
        font-weight: 700;
        font-size: 40px;
        line-height: 40px;
    }

    .heading p {
        font-size: 17px;
        line-height: 24px;
        font-weight: 300;
    }

    .subheading {
        color: #3c3c3c;
        padding-bottom: 15px;
        text-transform: capitalize;
        font-weight: 500;
        font-size: 32px;
        line-height: 45px;
    }

    .btn {
        border-radius: 0;
        text-decoration: none !important;
    }

    .btn-main {
        color: #fff;
        border-radius: 30px;
        font-size: 18px;
        padding: 15px 40px;
        display: inline-block;
        background-color: #f9a743;
        box-shadow: 0 15px 40px rgba(249, 167, 68, 0.5);
        background-image: linear-gradient(bottom, rgba(255, 239, 206, 0) 0%, rgba(255, 239, 206, 0.25) 100%);
    }

    .btn-main:hover,
    .btn-main:focus {
        background-color: #f9a743;
        color: #fff;
    }

    .btn-main-sm {
        padding: 12px 35px;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: bold;
    }



    .lang-list {
        border: 0;
        margin: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .navigation .dropdown-menu {
        padding: 0px;
        border: 0;
        border-radius: 0px;
        background-color: #f5f5f5;
    }

    @media (max-width: 991px) {
        .navigation .dropdown-menu {
            text-align: center;
            float: left !important;
            width: 100%;
            margin: 0;
        }
    }

    .navigation .dropdown-menu li:first-child {
        margin-top: 5px;
    }

    .navigation .dropdown-menu li:last-child {
        margin-bottom: 5px;
    }

    .navigation .dropdown-toggle::after {
        display: none;
    }

    .navigation .dropdown-toggle>i {
        font-size: 14px;
    }

    .navigation .dropleft .dropdown-menu,
    .navigation .dropright .dropdown-menu {
        margin: 0;
    }

    .navigation .dropleft .dropdown-toggle::before,
    .navigation .dropright .dropdown-toggle::after {
        font-weight: bold;
        font-family: "themefisher-font";
        border: 0;
        font-size: 10px;
        vertical-align: 1px;
        display: inline-block;
    }

    .navigation .dropleft .dropdown-toggle::before {
        margin-right: 5px;
        content: "\f124";
    }

    .navigation .dropright .dropdown-toggle::after {
        margin-left: 5px;
        content: "\f125";
    }

    .navigation .dropdown-item {
        color: #444;
        padding: 0.6rem 1rem 0.35rem;
        font-weight: 600;
        font-size: 15px;
    }

    .navigation .dropdown-submenu.active>.dropdown-toggle,
    .navigation .dropdown-submenu:hover>.dropdown-item,
    .navigation .dropdown-item.active,
    .navigation .dropdown-item:hover {
        background: #f9a743;
        color: white;
    }

    @media (min-width: 992px) {
        .navigation .dropdown-menu {
            transition: all 0.2s ease-in, visibility 0s linear 0.2s, transform 0.2s linear;
            display: block;
            visibility: hidden;
            opacity: 0;
            min-width: 200px;
            margin-top: 8px;
        }

        .navigation .dropdown-menu li:first-child {
            margin-top: 10px;
        }

        .navigation .dropdown-menu li:last-child {
            margin-bottom: 10px;
        }

        .navigation .dropleft .dropdown-menu,
        .navigation .dropright .dropdown-menu {
            margin-top: -9px;
        }

        .navigation .dropdown:hover>.dropdown-menu {
            visibility: visible;
            transition: all 0.45s ease 0s;
            opacity: 1;
        }
    }

    .navbar-collapse.show {
        overflow-y: auto;
        overflow-x: hidden;
        max-height: calc(100vh - 80px);
    }

    .navbar-toggler:focus {
        outline: 0;
    }


    @media (max-width: 991px) {
        .cart {
            position: absolute;
            top: 23px;
            right: 90px;
        }
    }

   
    /*--
    Feature-list start
--*/
    .feature-list .btn-main {
        margin-top: 15px;
    }

    /*--
  Gallery start
--*/
    .gallery {
        padding-bottom: 100px;
    }

    .gallery .owl-item {
        overflow: hidden;
        position: relative;
    }

    .gallery .block {
        padding: 20px;
        position: relative;
    }

    .gallery .block:hover .gallery-overlay {
        transform: scale(1);
        opacity: 1;
        border-radius: 0;
    }

    .gallery .gallery-overlay {
        position: absolute;
        bottom: 15px;
        left: 15px;
        right: 15px;
        top: 15px;
        background: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        color: inherit;
        transform: scale(0.7);
        transition: 0.3s ease-in-out;
        z-index: 2;
        opacity: 0;
        border-radius: 50%;
    }

    .gallery .gallery-overlay .gallery-popup {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #f9a743;
        padding: 5px 10px;
        border-radius: 40px;
        width: 50px;
        height: 50px;
    }

    .gallery .gallery-overlay .gallery-popup i {
        color: #fff;
        font-size: 30px;
        line-height: 40px;
        display: inline-block;
    }

    /*--
    service start
--*/
    .testimonials .testimonial-block {
        padding: 0 10px;
    }

    .testimonials .testimonial-block i {
        font-size: 40px;
        display: inline-block;
        margin-bottom: 20px;
        color: #f9a743;
    }

    .testimonials .testimonial-block p {
        font-family: "Droid Serif", serif;
        font-size: 14px;
        color: #777;
    }

    .testimonials .testimonial-block .author-details {
        margin-top: 30px;
    }

    .testimonials .testimonial-block .author-details img {
        border-radius: 50%;
        width: 50px;
    }

    .testimonials .testimonial-block .author-details h4 {
        font-weight: 700;
        font-size: 20px;
        margin-top: 10px;
    }

    /*--
    call-to-action start
--*/
    .call-to-action {
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .input-group {
        margin-top: 30px;
        position: relative;
    }

    .input-group .btn-submit {
        padding: 10.5px 40px !important;
        position: absolute;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        top: 0;
        right: 0;
    }

    .input-group input {
        height: 50px;
        border-radius: 40px;
        border: none;
        padding-left: 15px;
        box-shadow: none;
        display: table-cell;
    }

    .footer-menu a {
        font-size: 14;
        font-weight: 700;
        color: #444;
        padding: 10px;
    }

    footer {
        text-align: center;
        background: #f4f4f4;
        padding: 50px 0px;
    }

    footer .footer-logo {
        color: #555;
        display: block;
    }

    footer p.copyright-text {
        font-weight: 300;
        font-size: 12px;
        color: #888;
        letter-spacing: 3px;
        margin-top: 15px;
    }

    footer p.copyright-text a {
        color: #282828;
    }

    footer p.copyright-text a:hover {
        text-decoration: none;
    }

    p.price {
        font-size: 30px;
        font-family: "Droid Serif", serif;
    }

    s.price {
        color: red;
        font-size: 25px;
        font-family: "Droid Serif", serif;
    }

    .product-info {
        text-align: center;
    }

    .product-info .price {
        font-size: 100%;
    }

    .contact-list li,
    .contact-list a {
        color: #282828;
        font-size: 18px;
    }

    .form-control {
        border: 1px solid #dadada;
        border-radius: 35px;
        height: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .form-control:focus {
        border-color: #f9a743;
        box-shadow: none;
    }

    .form-control::-moz-placeholder {
        font-size: 80%;
    }

    .form-control::placeholder {
        font-size: 80%;
    }

    textarea.form-control {
        height: 150px;
        padding-top: 15px;
    }

    .sticky-image {
        position: -webkit-sticky;
        position: sticky;
        top: 100px;
        z-index: 1;
    }

    /* product sinngle page */
    .product-image-slider {
        position: -webkit-sticky;
        position: sticky;
        top: 80px;
    }

    .product-image-slider .slick-list {
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .product-image-slider .slick-dots {
        margin-top: 10px;
        padding-left: 0;
        display: flex;
    }

    .product-image-slider .slick-dots li {
        list-style-type: none;
        margin: 10px;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
    }

    .product-image-slider .slick-dots li:first-child {
        margin-left: 0;
    }

    .product-image-slider .slick-dots li:last-child {
        margin-right: 0;
    }

    .product-image-slider .slick-dots li img {
        max-height: 80px;
        height: auto;
        max-width: 100%;
    }

    /* content style */
    .content * {
        margin-bottom: 20px;
    }

    .content a {
        text-decoration: underline;
    }

    .content h1,
    .content h2,
    .content h3,
    .content h4,
    .content h5,
    .content h6 {
        margin-bottom: 10px;
    }

    .content ol,
    .content ul {
        padding-left: 10px;
    }

    .content table {
        text-align: left;
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
    }

    .content table th,
    .content table td {
        padding: 0.75rem;
        vertical-align: top;
        border: 1px solid #dee2e6;
    }

    .content table thead {
        background: #d5d5d5;
    }

    .content table tbody {
        background: #dadada;
    }

    .content table tbody td {
        text-align: left !important;
    }

    .content blockquote {
        border-left: 1px solid #f9a743;
        padding: 20px;
    }

    .content blockquote p {
        margin-bottom: 0;
        font-style: italic;
        font-size: 22px;
        font-weight: 500;
    }

    .content pre {
        padding: 10px 20px;
        background: #dadada;
    }

    .link-title {
        color: inherit;
        text-decoration: none !important;
    }

    .link-title:hover {
        color: #f9a743;
    }

    .mb-4 {
        font-family: 'Times New Roman', Times, serif;
    }

    /*# sourceMappingURL=style.css.map */
</style>




@endsection