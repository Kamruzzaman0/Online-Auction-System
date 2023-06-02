<!DOCTYPE html>
<html>
<head>
	<title>Invoice Form</title>
</head>
<body>
	<h1>Invoice</h1>
	<table>
        
 
		<tr>
			<td>Product Name:</td>
			<td>{{$data['name']}}</td>
		</tr>
		<tr>
			<td>Product Description:</td>
			<td>{{$data['description']}}</td>
		</tr>
		<tr>
			<td>Client Name:</td>
			<td>{{$data['invoiceName']}}</td>
		</tr>
		<tr>
			<td>Client Email:</td>
			<td>{{$data['email']}}</td>
		</tr>
		<tr>
			<td>Transaction Number:</td>
			<td>{{$data['transactionNumber']}}</td>
		</tr>
		<tr>
			<td>Transaction Amount:</td>
			<td>{{$data['transactionAmount']}}</td>
		</tr>
		<tr>
			<td>Street Address:</td>
			<td>{{$data['streetAddress']}}</td>

		</tr>
		<tr>
			<td>City:</td>
			<td>{{$data['city']}}</td>

		</tr>
		<tr>
			<td>Phone Number:</td>
			<td>{{$data['phoneNumber']}}</td>

		</tr>
		<tr>
			<td>Status:</td>
			<td>{{$data['status']}}</td>
		</tr>
	</table>
</body>
</html>
<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			line-height: 1.5;
		}
		h1 {
			font-size: 28px;
			margin-bottom: 20px;
		}
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			padding: 8px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
		}
	</style>
