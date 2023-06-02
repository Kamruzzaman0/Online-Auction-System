<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('admin_dashboard')}}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_bider_list')}}">
              <span data-feather="file" class="align-text-bottom"></span>
              Bider List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_category_list')}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Category List
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_sub_category_list')}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Sub Category List
            </a>
          </li>
       
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_product')}}">
              <span data-feather="shopping-cart" class="align-text-bottom"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_customer')}}">
              <span data-feather="users" class="align-text-bottom"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_payment')}}">
              <span data-feather="bar-chart-2" class="align-text-bottom"></span>
              Payment
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('admin_userlist')}}">
              <span data-feather="users" class="align-text-bottom"></span>
              Sellers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('search_result')}}">
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
  width: 224px;
  background-color: #f8f9fa;
  padding-top: 40px;
  /* Add other styles as needed */
}
#sidebarMenu a.nav-link:hover {
  color: inherit;
}

    </style>
