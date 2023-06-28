@extends('admin.layouts.master')

@section('head-tag')
<title>اعلانات</title>
@endsection

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش رویداد ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> اعلانات</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    مدیریت اعلانات
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                @can('create-notify')
                <a href="{{ route('admin.event.notification.create') }}" class="btn btn-info btn-sm">ایجاد اعلان جدید</a>
                @endcan
                <div class="max-width-16-rem">
                    <input type="text" class="form-control form-control-sm form-text" placeholder="جستجو">
                </div>
            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>توضیحات </th>
                            <th>تاریخ شروع</th>
                            <th>تاریخ پایان</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Str::limit($notification->title, 25, '...') }}</td>
                            <td>{!! Str::limit($notification->body, 50, '...') !!}</td>
                            <td>{{ jalaliDate($notification->start_date) }}</td>
                            <td>{{ jalaliDate($notification->end_date) }}</td>
                            <td>
                                <label>
                                    @can('update-notify')
                                    <input id="{{ $notification->id }}" onchange="changeStatus({{$notification->id}})" data-url="{{ route('admin.event.notification.status' , $notification->id) }}" type="checkbox" @if ($notification->status === 1)
                                    checked
                                    @endif>
                                    @endcan
                                    @if ($notification->status === 0)
                                    <sup class="badge badge-warning status_warning{{ $notification->id }}">غیر فعال</sup>
                                    @else
                                    <sup class="badge badge-warning d-none status_warning{{ $notification->id }}">غیر فعال</sup>
                                    @endif
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                @can('update-notify')
                                <a href="{{ route('admin.event.notification.edit', $notification->id) }}" title="ویرایش کردن" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                @endcan
                            @can('delete-notify')
                            <form class="d-inline" action="{{ route('admin.event.notification.destroy', $notification->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm delete" title="حذف"><i class="fa fa-times"></i> </button>
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

@endsection
@section('script')

    @component('admin.components.change-status')

        @slot('slot')
            اعلان
        @endslot

    @endcomponent
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection

