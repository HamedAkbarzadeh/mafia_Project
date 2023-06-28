<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-user-panel-name">
      <img src="{{ asset($logoURL) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">پنل کاربری</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar bg-sidebar" style="direction: ltr">
      <div style="direction: rtl">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            @if (auth()->user()->profile_photo_path != null)
            <img src="{{ asset(auth()->user()->profile_photo_path) }}" class="img-circle elevation-2" alt="User Image">
            @else
            <i class="fa fa-user-circle color-white font-size-30px"></i>
            @endif
          </div>
          <div class="info">
            <a href="{{ route('user-panel.profile') }}" class="d-block">{{ auth()->user()->name }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
              <li class="nav-item">
                 <a href="{{ route('admin.home') }}" class="nav-link active">
                 <i class="nav-icon fa fa-cogs"></i><p>ورود به پنل ادمین</p></a>
              </li>
              <li class="nav-item">
               <a href="{{ route('customer.home') }}" class="nav-link">
                 <i class="nav-icon fa fa-home"></i><p>خانه</p></a>
              </li>
              <li class="nav-item">
               <a href="{{ route('user-panel.index') }}" class="nav-link">
                 <i class="nav-icon fa fa-th"></i><p>داشبورد</p></a>
              </li>
            <li class="nav-item">
              <a href="{{ route('user-panel.competition') }}" class="nav-link">
                <i class="fa fa-user-plus"></i>
                <p>
                  ثبت نام در مسابقات
                  <!-- <span class="right badge badge-danger">جدید</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('user-panel.role.index') }}" class="nav-link">
                <i class="fa fa-bars"></i>
                <p>
                   نقش های مافیا
                  <!-- <span class="right badge badge-danger">جدید</span> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('user-panel.profile') }}" class="nav-link">
                <i class="fa fa-gear"></i>
                <p>
                  پروفایل کاربری
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('auth.customer.logout') }}" class="nav-link">
                <i class="fa fa-user-circle"></i>
                <p>
                  خروج
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
