<!DOCTYPE html>
<html lang="en">
<head>
@include('customer.layouts.head-tag')
@yield('head-tag')
</head>
<body>
    @include('customer.layouts.header')

    @yield('content')

    @include('customer.layouts.footer')
    @include('customer.layouts.script')
</body>
</html>
