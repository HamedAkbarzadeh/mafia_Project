<!DOCTYPE html>
<html lang="en">
<head>
    @include('customer.layouts.head-tag')
    @yield('head-tag')
</head>
<body class="hold-transition login-page">



    @yield('content')






    @include('customer.layouts.script')
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
