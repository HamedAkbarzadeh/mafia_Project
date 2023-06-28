@extends('customer.layouts.master-simple')

@section('head-tag')

<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('user-assets/css/adminlte.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

 <!-- bootstrap rtl -->
 <link rel="stylesheet" href="{{ asset('user-assets/css/bootstrap-rtl.min.css') }}">
 <!-- template rtl version -->
 <link rel="stylesheet" href="{{ asset('user-assets/css/custom-style.css') }}">
@endsection

@section('content')

<div class="register-box">
  <div class="register-logo">
      <b>ثبت نام در سایت</b>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">ثبت نام کاربر جدید</p>

      <form action="../../index.html" method="post">
        <div class="input-group mb-3">
          <input type="text" name="first_name" class="form-control" placeholder="نام">
          <div class="input-group-append">
            <span class="fa fa-user input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="last_name" class="form-control" placeholder="نام خانوادگی">
          <div class="input-group-append">
            <span class="fa fa-user input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="ایمیل یا موبایل">
          <div class="input-group-append">
            <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="رمز عبور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password-check" class="form-control" placeholder="تکرار رمز عبور">
          <div class="input-group-append">
            <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
                {{-- <input type="checkbox"> با <a href="#">شرایط</a> موافق هستم --}}
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">ثبت نام</button>
          </div>
          <!-- /.col -->
        </div>
      </form> 

      <a href="{{ route('auth.org.login-form') }}" class="text-center">من قبلا ثبت نام کرده ام</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
  

@endsection