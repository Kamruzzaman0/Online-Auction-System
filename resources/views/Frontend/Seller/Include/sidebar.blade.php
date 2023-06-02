<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('seller_dashboard')}}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('seller_bider_list',auth()->user()->id)}}">
              <span data-feather="file" class="align-text-bottom"></span>
              Bider List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('seller_category',auth()->user()->id)}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Category List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('seller_sub_category',auth()->user()->id)}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Sub Category List
            </a>
          </li>
       
          <li class="nav-item">
            <a class="nav-link" href="{{route('seller_product',auth()->user()->id)}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Products
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('seller_payment',auth()->user()->id)}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Payment
            </a>
          </li>
        </ul>

      </div>
    </nav>
<style>
  #sidebarMenu {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 228px;
  background-color: #f8f9fa;
  padding-top: 40px;
  /* Add other styles as needed */
}
#sidebarMenu a.nav-link:hover {
  color: inherit;
}


</style>