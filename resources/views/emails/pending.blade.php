<!DOCTYPE html>
<html>
  <head>
    <title>Product Status</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <header>
      <h2 >Online Auction BD</h2>
    </header>
    <main>
      <div class="status-message">
        <h3>Your payment is on pending process. Please wait until admin confirms it.</h3>
        <p>Thank you for your purchase!</p>
      </div>
    </main>
    <div class="submit-container clearfix" style="text-align: center;margin-top: 2rem;" >          
        <p class="message">Want's Login? </p>
        <p><a href="{{route('user_login')}}">Back To Login</a></p>
        </div>
  </body>
</html>


<style>/* Styles for the body of the page */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

/* Styles for the header */
header {
  background-color:indianred;
  color: #fff;
  padding: 7px;
}

header h2 {
  margin: 0;
 
}

/* Styles for the status message */
.status-message {
  background-color: #f8d7da;
  border: 1px solid #f5c6cb;
  color: #721c24;
  margin: 150px auto;
  max-width: 500px;
  padding: 20px;
  text-align: center;
}

.status-message h3 {
  margin: 0;
}

.status-message p {
  font-size: 20px;
  margin-top: 20px;
}


</style>