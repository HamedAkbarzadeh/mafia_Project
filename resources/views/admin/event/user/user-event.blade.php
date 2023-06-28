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

{{--  --}}
<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    کاربران شرکت کرده در این مسابقه
                </h5>
            </section>
            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.event.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>
            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربر</th>
                            <th>شماره موبایل</th>
                            <th>وضعیت پرداخت</th>
                            <th>کد ورود</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->mobile ?? 'هنوز شماره تلفنی ثبت نشده .' }}</td>
                            <td>
                                @php
                                    $pivot = $user->events()->wherePivot('event_id' , $event->id)->wherePivot('user_id' , $user->id)->first()->pivot;
                                @endphp
                               {{ $pivot->payment_status ? 'پرداخت شده' : 'پرداخت نشده' }}
                            </td>
                            <td>{{ $pivot->random_code }}</td>

                            <td class="width-16-rem text-left">
                                 @can('update-user-state-game')
                                @if ($pivot->payment_status == 0)
                                <a href="{{ route('admin.event.toggle-payment', [$event->id , $user->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-dollar-sign"></i> پرداخت شده</a>
                                @else
                                <a href="{{ route('admin.event.toggle-payment', [$event->id , $user->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-dollar-sign"></i> پرداخت نشده</a>
                                @endif
                                <a href="{{ route('admin.event.user.add-user-info', [$event->id , $user->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-info-circle"></i></a>
                             <form class="d-inline" action="{{ route('admin.event.user.destroy', [$event->id , $user->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete"><i class="fa fa-times"></i></button>
                            </form>
                            @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </section>
    </section>
</section>
  {{--  --}}
  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  افزودن کاربر به مسابقه
                </h5>
            </section>



            @can('update-user-state-game')
            <section>
                <form action="{{ route('admin.event.user.store' , $event->id) }}" id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="user_id">افزودن کاربر به مسابقه </label>
                                <select name="user_id" id="user_id" class="form-control form-control-sm">
                                    <option value="">کاربر مورد نظر خود را انتخاب کنید .</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name . ' ( ' . $user->email .' )'}}</option>
                                    @endforeach
                                </select>
                                @component('admin.components.error')
                                user_id
                                @endcomponent
                            </div>
                        </section>

                        <section class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>
            @endcan

        </section>
    </section>
</section>

@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>

@include('admin.partials.jalali-date')
@include('admin.partials.tags')
@include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
