@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">

<title>بروز رسانی ایمیل</title>
@endsection

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">ایمیل</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">بروز رسانی ایمیل </li>
    </ol>
  </nav>

  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  بروز رسانی ایمیل
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.notify.email.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.notify.email.update' , $email->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <section class="row"> 
                        <section class="col-12">
                            <div class="form-group">
                                <label for="subject">عنوان پیامک</label>
                                <input type="text" value="{{ old('subject', $email->subject) }}" name="subject" class="form-control form-control-sm">
                                @component('admin.components.error')
                                subject
                                @endcomponent 
                            </div>
                        </section> 
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="" class="form-control form-control-sm" id="status">
                                    <option value="0" @if(old('status', $email->status) == 0) selected @endif>غیرفعال</option>
                                    <option value="1" @if(old('status', $email->status) == 1) selected @endif>فعال</option>
                                </select>
                                @component('admin.components.error')
                                status
                                @endcomponent 
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="">تاریخ انتشار</label>
                                <input type="text" value="{{ old('published_at', $email->published_at) }}" name="published_at" id="published_at" class="d-none form-control form-control-sm" value="{{ old('published_at')}}">
                                <input type="text" value="{{ old('published_at', $email->published_at) }}" id="published_at_view" class="form-control form-control-sm" value="{{ old('published_at')}}">
                                @component('admin.components.error')
                                published_at
                                @endcomponent 
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="form-group">
                                <label for="body">متن پیامک</label>
                                <textarea name="body" id="body" class="form-control form-control-sm" rows="6">{{ old('body', $email->body) }}</textarea>
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

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@include('admin.partials.jalali-date')
@include('admin.partials.tags')

@endsection
