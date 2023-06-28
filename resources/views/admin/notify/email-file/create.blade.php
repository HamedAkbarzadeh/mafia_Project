@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>ایجاد اطلاعیه ایمیلی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه ایمیلی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد اطلاعیه ایمیلی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد اطلاعیه ایمیلی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.notify.email-file.store' , $email->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="row"> 
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="file">فایل </label>
                                <input type="file" name="file" id="file" class="form-control form-control-sm"  value="{{ old('file')}}">
                                @component('admin.components.error')
                                file
                                @endcomponent 
                            </div> 
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status') == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if (old('status') == 1) selected @endif>فعال</option> 
                                </select>
                                @component('admin.components.error')
                                status
                                @endcomponent 
                            </div> 
                        </section> 
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="private">وضعیت فایل</label>
                                <select name="private" id="private" class="form-control form-control-sm">
                                    <option value="0" @if (old('private') == 0) selected @endif>غیر محرمانه (قابل دانلود برای عموم) </option>
                                    <option value="1" @if (old('private') == 1) selected @endif>محرمانه (غیر قابل دانلود برای عموم)</option> 
                                </select>
                                @component('admin.components.error')
                                private
                                @endcomponent 
                            </div> 
                        </section> 
                        <section class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
@section('script') 
<script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('body');
</script>
@include('admin.partials.jalali-date')
@endsection