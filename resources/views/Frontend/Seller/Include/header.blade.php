
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{route('seller_dashboard')}}">Online Auction BD</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <p class="form-control form-control-dark w-100 rounded-0 border-0" type="text" style="color:black"></p>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="{{route('seller_profile',auth()->user()->id)}}">My Profile</a>
    </div>
  </div>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="{{route('signout')}}">Sign out</a>
    </div>
  </div>
</header>
<style>
  .form-control-dark {
    color: #fff;
    background-color:rgba(var(--bs-dark-rgb),var(--bs-bg-opacity))!important;
    border-color: rgba(255, 255, 255, .1);
}
</style>