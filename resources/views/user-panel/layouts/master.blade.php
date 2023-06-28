<!DOCTYPE html>
<html lang="en">
<head>
    @include('user-panel.layouts.head-tag')
    @yield('head-tag')

</head>
<body class="hold-transition sidebar-mini">

    <div class="wrapper">
      @include('user-panel.layouts.header')
      @include('user-panel.layouts.sidebar')
      @yield('content')
      @include('user-panel.layouts.footer')
    </div>
    <!-- ./wrapper -->
    @include('user-panel.layouts.script')
    @yield('script')
    <section class="toast-wrapper flex-row-reverse">
      @include('admin.alerts.toast.error')
      @include('admin.alerts.toast.success')
  </section>
  @include('admin.alerts.sweetalert.error')
  @include('admin.alerts.sweetalert.success')
  @include('admin.alerts.sweetalert.info')

</body>
</html>
