@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد دسترسی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش دسترسی</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">دسترسی ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد دسترسی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد دسترسی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.permission.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.user.permission.store') }}" method="POST">
                    @csrf
                    <section class="row">

                        <section class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="name">عنوان دسترسی</label>
                                <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control form-control-sm">
                                @component('admin.components.error')
                                name
                                @endcomponent 
                            </div>
                        </section>
                        <section class="col-12 col-md-5">
                            <div class="form-group">
                                <label for="description">توضیح دسترسی</label>
                                <input type="text" name="description" value="{{ old('description') }}" id="description" class="form-control form-control-sm">
                                @component('admin.components.error')
                                description
                                @endcomponent 
                            </div>
                        </section>

                        <section class="col-12 col-md-2 mt-md-2">
                            <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                        </section> 
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
