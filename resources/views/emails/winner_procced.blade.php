<!DOCTYPE html>
<html>
<head>
	<title>Online Auction BD Payment Panel</title>
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<form class="form-group">
			<h2>Product Payment Details</h2>
			<div class="form-group">
				<label for="first_name">Winner Name</label>
				<p>{{$Bidder->name}}</p>
			</div>
			<div class="form-group">
				<label for="first_name">Winner Email</label>
				<p>{{$Bidder->email}}</p>
			</div>
			<div class="form-group">
				<label for="first_name">Product Image</label>
				<p><img src="{{asset('/uploads/Product/'.$product->image)}}"></p>
			</div>
			<div class="form-group">
				<label for="first_name">Product Name</label>
				<p>{{$product->name}}</p>
			</div>
			<div class="form-group">
				<label for="last_name">Description</label>
				<p>{{$product->description}}</p>
			</div>
			<div class="form-group">
				<label for="last_name">Year</label>
				<p>{{$product->year}}</p>
			</div>
			<div class="form-group">
				<label for="last_name">Bided Amount</label>
				<p>{{$max}} TK</p>
			</div>
			
			<div style="text-align: center;">
				<a class="btn btn-primary" type="submit" href="{{route('bider_mail_payment',[$Bidder->id,$product->id])}}">Proceed</a>
			</div>
		</form>
	</div>
</body>
</html>
<style>
		.container {
			border: 1px solid black;
			padding: 20px;
			margin-top: 50px;
			width: 50%;
			margin-left: auto;
			margin-right: auto;
			background-color: #f8f8f8;
			box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
			border-radius: 10px;
		}

		h2 {
			text-align: center;
			padding: 15px;
			border: 1px solid black;
			margin-top: 0;
			margin-bottom: 20px;
			background-color: #ffffff;
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
			border-radius: 5px;
		}

		label {
			font-weight: bold;
		}

		img {
			max-height: 100px;
			max-width: 100px;
		}

		.btn-primary {
			background-color: #007bff;
			border-color: #007bff;
		}

		.btn-primary:hover {
			background-color: #0069d9;
			border-color: #0062cc;
		}
	</style>
