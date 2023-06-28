@extends('admin.layouts.master')

@section('head-tag')
<title>اطلاعیه پیامکی</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">اطلاع رسانی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> اطلاعیه پیامکی</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                   اطلاعیه پیامکی
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
               @can('create-SMS')
               <a href="{{ route('admin.notify.sms.create') }}" class="btn btn-info btn-sm">ایجاد اطلاعیه پیامکی</a>
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
                            <th>عنوان اطلاعیه</th>
                            <th>متن اطلاعیه</th>
                            <th>تاریخ ارسال	</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sms as $key => $simple_sms)
                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $simple_sms->title }}</td>
                            <td>{{ Str::limit($simple_sms->body , 8) }}</td>
                            <td>{{ jalaliDate($simple_sms->published_at , 'H:i:s Y/m/d') }}</td>
                            <td>
                                <label>
                                    @can('update-SMS')
                                    <input id="{{ $simple_sms->id }}" onchange="changeStatus({{$simple_sms->id}})" data-url="{{ route('admin.notify.sms.status' , $simple_sms->id) }}" type="checkbox" @if ($simple_sms->status === 1)
                                    checked
                                    @endif>
                                    @endcan
                                @if ($simple_sms->status === 0)
                                <sup class="badge badge-warning status_warning{{ $simple_sms->id }}">غیر فعال</sup>
                                @else
                                <sup class="badge badge-warning d-none status_warning{{ $simple_sms->id }}">غیر فعال</sup>
                                @endif
                                </label>
                            </td>
                            <td class="width-16-rem text-left">
                                @can('update-SMS')
                                <a href="{{ route('admin.notify.sms.edit',$simple_sms->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                @endcan
                                @can('delete-SMS')
                                <form class="d-inline" action=" {{ route('admin.notify.sms.destroy', $simple_sms->id ) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
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
         پیامک
        @endslot
    @endcomponent
        @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
