<x-mail::message>
<h2 style="color:black; text-align:center">You have won this bid Successfully, please go through the payment process.</h2>

<p style="color: brown; text-align:center">Winner Information</p>
<p>Winner Name: <span>{{$order_info['Bidder_name']}}</span></p>
<p>Winner Email: <span>{{$order_info['Bidder_email']}}</span></p>
<p>Product Name: <span>{{$order_info['Product_name']}}</span></p>
<p>Amount: <span>{{$order_info['Product_amount']}} TK</span></p>


<x-mail::button :url="'http://127.0.0.1:8000/customer/mail/procced/'.$id">
Payment
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
