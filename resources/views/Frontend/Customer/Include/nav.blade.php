
<nav class="navbar navbar-expand-lg navbar-light bg-light bg-secondary" >
    <div class="container px-4 px-lg-5" >
        <a class="navbar-brand" href="{{route('customer_dashboard')}}">Online Auction BD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('customer_dashboard')}}">Home</a></li>
                <li class="nav-item dropdown">
               
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Others</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('customer_biding_info',auth()->user()->id)}}">Biding Information</a></li>
                        <li><a class="dropdown-item" href="{{route('customer_payment',auth()->user()->id)}}">Payment Status</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
         <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
             <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" id="absolute" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  >My Account</a>
                 <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                     <li><a class="dropdown-item" href="{{route('customer_profile',auth()->user()->id)}}">Profile</a></li>
                     <li><a class="dropdown-item" href="{{route('customer_update_info')}}">Update Info</a></li>
                     <li><a class="dropdown-item" href="{{route('signout')}}">Logout</a></li>
                 </ul>
             </li>
         </ul>
</nav>



<style>
    .navbar.bg-secondary {
  background-color: grey;
}
    #absolute {
  
        float:right;
 
}

</style>