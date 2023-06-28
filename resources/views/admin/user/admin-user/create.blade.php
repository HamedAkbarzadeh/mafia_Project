@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد کاربر ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.admin-user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6">

                            <div class="form-group">
                                <label for="name">نام و نام خانوادگی</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                name
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                email
                                @endcomponent
                            </div>
                        </section>
                     <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="mobile"> شماره موبایل</label>
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                mobile
                                @endcomponent
                            </div>
                        </section>
                     <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="password">کلمه عبور</label>
                                <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                password
                                @endcomponent
                            </div>
                        </section>
                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">تکرار کلمه عبور</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                password_confirmation
                                @endcomponent
                            </div>
                        </section>
                    <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="profile_photo_path">تصویر</label>
                                <input type="file" name="profile_photo_path" id="profile_photo_path" value="{{ old('profile_photo_path') }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                profile_photo_path
                                @endcomponent
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="activation">وضعیت فعالسازی دو مرحله ای ادمین</label>
                                <select name="activation" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('activation') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if (old('activation') == 1) selected @endif>فعال</option>
                                </select>
                                @component('admin.components.error')
                                activation
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
