  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-header navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('customer.home') }}" class="nav-link">خانه</a>
      </li>
      @can('show-admin-panel')
      <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('admin.home') }}" class="nav-link">ورود به پنل ادمین</a>
      </li>
      @endcan
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item" data-widget="pushmenu">
        {{-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i --}}
          <a class="nav-link" href="#"><i
                class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
