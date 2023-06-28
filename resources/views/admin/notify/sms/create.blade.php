@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>ایجاد اطلاعیه پیامکی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاعیه پیامکی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد اطلاعیه پیامکی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد اطلاعیه پیامکی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.sms.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.notify.sms.store') }}" method="post">
                    @csrf
                    <section class="row"> 
                        <section class="col-12">
                            <div class="form-group">
                                <label for="title">عنوان پیامک</label>
                                <input type="text" value="{{ old('title') }}" name="title" class="form-control form-control-sm">
                                @component('admin.components.error')
                                title
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
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="text" value="{{ old('published_at') }}" name="published_at" id="published_at" class="d-none form-control form-control-sm" value="{{ old('published_at')}}">
                                <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{ old('published_at')}}">
                                @component('admin.components.error')
                                published_at
                                @endcomponent 
                            </div> 
                        </section>
                        <section class="col-12">
                            <div class="form-group">
                                <label for="body">متن پیامک</label>
                                <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body') }}</textarea>
                                @component('admin.components.error')
                                body
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
@section('script') 
@include('admin.partials.jalali-date')
@endsection