<!DOCTYPE html>
<html>

<head>
    <title>Payment Form</title>
</head>

<body>
    <form action="{{route('bider_payment',[$product->id,$user->id])}}" method="post">
        @csrf
        <fieldset>
            <legend>Payment Information</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="{{$user->name}}"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="{{$user->email}}"><br>

            <label for="transaction-number" style="text-align: center;">QR Bar Code</label>
            <img class="center" style="display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%; height:150px; width:150px;
  border: 2px solid black;
  font-weight: bold;
  padding: 10px;" src="{{ asset('/uploads/payment/bkash.jpg') }}" /><br>

            <label for="transaction-number">Transaction Number:</label>
            <input type="text" id="transaction-number" name="transaction_number" required><br>

            <label for="transaction-amount">Transaction Amount:</label>
            <input type="text" id="transaction-amount" name="transaction_amount"  required value="{{$max}}"><br>

            @php
            $today = \Carbon\Carbon::now();
            $formattedDate = $today->format('Y-m-d');
            @endphp
            <label for="date">Date:</label>
            <input type="date" id="text" name="date" required value="{{$formattedDate}}"><br>

            <label for="street-address">Street Address:</label>
            <input type="text" id="street-address" name="street_address" required><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required required value="{{$user->address}}"><br>

            <label for="phone-number">Phone Number:</label>
            <input type="tel" id="phone-number" name="phone_number" required value="{{$user->phone}}"><br>

            <input type="submit" value="Submit Payment">
            <input type="reset"  value="Cancel">
        </fieldset>
    </form>
</body>

</html>
<style>
    /* Apply global styles to the page */
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    /* Style the form container */
    form {
        max-width: 500px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.2);
    }

    /* Style the form fields */
    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    /* Style the submit and reset buttons */
    input[type="submit"],
    input[type="reset"] {
        background-color: #4CAF50;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
        background-color: #3e8e41;
    }

    /* Style the legend element */
    legend {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Style the form fields for smaller screens */
    @media screen and (max-width: 500px) {

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"] {
            width: 100%;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 100%;
        }
    }
</style>