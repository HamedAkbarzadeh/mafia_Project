@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>ایجاد مسابقه</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش رویداد ها</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">مسابقات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد مسابقه</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد نقش مافیا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.event.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.event.role.store') }}" id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name">نام نقش</label>
                                <input name="name" value="{{ old('name') }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                name
                                @endcomponent 
                            </div> 
                        </section>
                      
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="side">ساید </label>
                                <select name="side" id="side" class="form-control form-control-sm">
                                    <option value="">ساید این نقش را انتخاب نمایید .</option> 
                                    <option value="0">شهروند</option>
                                    <option value="1">مافیا</option>
                                    <option value="2">مستقل</option>
                                </select>    
                                @component('admin.components.error')
                                side
                                @endcomponent 
                            </div> 
                        </section>
                        <section class="col-12">
                            <div class="form-group">
                                <label for="price">توضیحات</label>
                                <textarea  name="description" type="text" class="form-control form-control-sm">{{ old('description') }}</textarea>
                                @component('admin.components.error')
                                description
                                @endcomponent 
                            </div> 
                        </section> 
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="game_type">نقش برای چه سبک مافیای هست ؟ </label>
                                <select name="game_type" id="game_type" class="form-control form-control-sm">
                                    <option value="0">ساده</option>
                                    <option value="1">مدرن</option>
                                </select>    
                                @component('admin.components.error')
                                game_type
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
        CKEDITOR.replace('description');
    </script>

@include('admin.partials.jalali-date')
@include('admin.partials.tags')
@endsection
