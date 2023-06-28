@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>بروز رسانی فایل های اطلاعیه ایمیلی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">فایل اطلاع رسانی </a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">فایل اطلاعیه ایمیلی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> بروز رسانی اطلاعیه ایمیلی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  بروزرسانی اطلاعیه ایمیلی
                </h5>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.email-file.index' , $emailfile->email->id) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.notify.email-file.update' , $emailfile->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                                <select name="status" id="" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status', $emailfile->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status', $emailfile->status) == 1) selected @endif>فعال</option>
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
                                    <option value="0" @if (old('private', $emailfile->private) == 0) selected @endif>غیر محرمانه (قابل دانلود برای عموم) </option>
                                    <option value="1" @if (old('private', $emailfile->private) == 1) selected @endif>محرمانه (غیر قابل دانلود برای عموم)</option> 
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