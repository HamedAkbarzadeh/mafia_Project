@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>ایجاد اعلان</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش رویداد ها</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#"> اعلانات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد اعلان جدید </li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد اعلان جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.event.notification') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.event.notification.store') }}" id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="name">عنوان اعلان </label>
                                <input name="title" value="{{ old('title') }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                title
                                @endcomponent 
                            </div> 
                        </section>
                      
                        
                        <section class="col-12">
                            <div class="form-group">
                                <label for="price">توضیحات</label>
                                <textarea  name="body" type="text" class="form-control form-control-sm">{{ old('body') }}</textarea>
                                @component('admin.components.error')
                                body
                                @endcomponent 
                            </div> 
                        </section> 
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date">تاریخ شروع</label>
                                <input type="text" name="start_date" id="start_date" class="d-none form-control form-control-sm" value="{{ old('start_date')}}">
                                <input type="text" id="start_date_at" class="form-control form-control-sm" value="{{ old('start_date')}}">
                                @component('admin.components.error')
                                start_date
                                @endcomponent 
                            </div> 
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="end_date">تاریخ پایان</label>
                                <input type="text" name="end_date" id="end_date" class="d-none form-control form-control-sm" value="{{ old('end_date')}}">
                                <input type="text" id="end_date_at" class="form-control form-control-sm" value="{{ old('end_date')}}">
                                @component('admin.components.error')
                                end_date
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
    
@include('admin.partials.jalali-start-and-end-date') 
@include('admin.partials.jalali-date')
@endsection
