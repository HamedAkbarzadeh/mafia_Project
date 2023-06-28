@extends('admin.layouts.master')

@section('head-tag')
<title>بروز رسانی تنظیمات سایت</title>
@endsection

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش تنظیمات </a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">تنظیمات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">بروز رسانی تنظیمات </li>
    </ol>
  </nav>

  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  بروز رسانی تنظیمات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.setting.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.setting.update' , $setting->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <section class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="title">عنوان سایت</label>
                                <input type="text" value="{{ old('title', $setting->title) }}" name="title" class="form-control form-control-sm">
                                @component('admin.components.error')
                                title
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="form-group">
                                <label for="subject">عنوان اصلی سایت (جهت نمایش در صفحه اصلی)</label>
                                <textarea name="subject" id="subject" class="form-control form-control-sm" rows="6">{{ old('subject', $setting->subject) }}</textarea>
                                @component('admin.components.error')
                                subject
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12">
                            <div class="form-group">
                                <label for="body"> توضیحات سایت</label>
                                <textarea name="description" id="description" class="form-control form-control-sm" rows="6">{{ old('description', $setting->description) }}</textarea>
                                @component('admin.components.error')
                                body
                                @endcomponent
                            </div>
                        </section>
                        {{-- <section class="col-12">
                            <div class="form-group">
                                <label for="keywords">کلمات کلیدی سایت</label>
                                <input type="text" value="{{ old('keywords', $setting->keywords) }}" name="keywords" class="form-control form-control-sm">
                                @component('admin.components.error')
                                keywords
                                @endcomponent
                            </div>
                        </section> --}}
                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="whiteLogo">لوگو (سفید) (رنگ 1)</label>
                                <input type="file" class="form-control form-control-sm" name="whiteLogo" id="whiteLogo">
                                @component('admin.components.error')
                                whiteLogo
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="blackLogo">لوگو (مشکی) (رنگ 2)</label>
                                <input type="file" class="form-control form-control-sm" name="blackLogo" id="blackLogo">
                                @component('admin.components.error')
                                blackLogo
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="icon">آیکون</label>
                                <input type="file" class="form-control form-control-sm" name="icon" id="icon">
                                @component('admin.components.error')
                                icon
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="bannerImage">بنر اصلی(اولین بنر داخل صفحه اصلی)</label>
                                <input type="file" class="form-control form-control-sm" name="bannerImage" id="bannerImage">
                                @component('admin.components.error')
                                bannerImage
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6 my-2">
                            <div class="form-group">
                                <label for="ruleImage">بنر قوانین</label>
                                <input type="file" class="form-control form-control-sm" name="ruleImage" id="ruleImage">
                                @component('admin.components.error')
                                ruleImage
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
    CKEDITOR.replace('description');
    CKEDITOR.replace('subject');
</script>
@endsection
