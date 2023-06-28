@extends('admin.layouts.master')

@section('head-tag')
<title>بروز رسانی کاربر </title>
@endsection
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران </a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> بروز رسانی کاربر </li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    بروز رسانی کاربر
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.customer.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.customer.update' ,$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <section class="row">
                        <section class="col-12 col-md-6">

                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" name="name" id="name" value="{{ old('name' , $user->name) }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                name
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="mobile">موبایل</label>
                                <input type="text" name="mobile" id="mobile" value="{{ old('mobile' , '0'.$user->mobile) }}" class="form-control form-control-sm">
                                @component('admin.components.error')
                                mobile
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
                            <section class="row">
                                <section class="col-md-6">
                                        <label class="form-check-label mx-2">
                                            <img src="{{ asset($user->profile_photo_path) }}" class="w-100" alt="">
                                        </label>
                                </section>
                            </section>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="activation">وضعیت فعالسازی کاربر</label>
                                <select name="activation" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('activation', $user->activation) == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if (old('activation', $user->activation) == 1) selected @endif>فعال</option>
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
