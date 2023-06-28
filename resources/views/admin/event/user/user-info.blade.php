@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>افزودن اطلاعات کاربری</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش رویداد ها</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">مسابقات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> افزودن اطلاعات کاربری </li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  افزودن اطلاعات کاربری
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.event.user' , [$event->id , $user->id]) }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.event.user.add-user-store' , [$event->id , $user->id]) }}" method="POST">
                    @csrf
                    <section class="row">
                      <section class="col-12 col-md-6">
                        <div class="form-group">
                            <label>آیا این شخص در بازی برنده شد ؟ </label>
                            <div class="d-flex">
                             <span class="ml-5"><label for="result_win">بله</label> <input type="radio" name="result_game" value="1" class="form-check-label" id="result_win" @if ($win_status == 1) checked @endif></span>
                             <span><label for="result_failed">خیر</label> <input type="radio" name="result_game" value="0" class="form-check-label" id="result_failed" @if ($win_status == 0) checked @endif></span>
                            </div>
                            @component('admin.components.error')
                            result_game
                            @endcomponent 
                        </div> 
                    </section> 
                    <section class="col-12 col-md-6">
                      <div class="form-group">
                          <label>ساید این شخص در بازی چه بود ؟</label>
                          <div class="d-flex">
                              <span class="ml-5"><label for="citizen_role">شهروند</label> <input type="radio" name="side" value="0" class="form-check-label" id="citizen_role"  @if ($mafia_side == 0) checked @endif></span>
                           <span class="ml-5"><label for="mafia_role">مافیا</label> <input type="radio" name="side" value="1" class="form-check-label" id="mafia_role" @if ($mafia_side == 1) checked @endif></span>
                           <span><label for="independent_role">مستقل</label> <input type="radio" name="side" value="2" class="form-check-label" id="independent_role" @if ($mafia_side == 2) checked @endif></span>
                          </div>
                          @component('admin.components.error')
                          side
                          @endcomponent 
                      </div> 
                  </section> 
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="user_role">نقش این شخص در بازی</label>
                                <select name="user_role" id="user_role" class="form-control form-control-sm">
                                    <option value="">نقش این شخص را انتخاب نمایید</option>
                                    @foreach ($event->mafias()->get() as $mafia)
                                      <option value="{{ $mafia->id }}" @if ($mafia->id == $mafia_id) selected @endif>{{ $mafia->name }}</option>
                                    @endforeach
                                  </select>
                                @component('admin.components.error')
                                user_role
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
@endsection
