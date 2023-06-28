@extends('admin.layouts.master')

@section('head-tag')
<title>مشتریان</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> مشتریان</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    مشتریان
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                @can('create-user')
                <a href="{{ route('admin.user.customer.create') }}" class="btn btn-info btn-sm">ایجاد مشتری جدید</a>
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
                            <th>نام و نام خانوادگی</th>
                            <th>کد ملی</th>
                            <th>شماره موبایل</th>
                            <th>ایمیل</th>
                            <th>فعال سازی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->national_code }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <label>
                                    <input id="{{ $user->id.'activation' }}" onchange="changeActive({{$user->id}})" data-url="{{ route('admin.user.customer.activation' , $user->id) }}" type="checkbox" @if ($user->activation === 1)
                                    checked
                                @endif>
                                @if ($user->activation === 0)
                                <sup class="badge badge-warning activation{{ $user->id }}">غیر فعال</sup>
                                @else
                                <sup class="badge badge-warning d-none activation{{ $user->id }}">غیر فعال</sup>
                                @endif
                                </label>
                            </td>
                            <td>
                                <label>
                                    @can('update-user')
                                    <input id="{{ $user->id }}" onchange="changeStatus({{$user->id}})" data-url="{{ route('admin.user.customer.status' , $user->id) }}" type="checkbox" @if ($user->status === 1)
                                    checked
                                    @endif>
                                    @endcan
                                @if ($user->status === 0)
                                <sup class="badge badge-warning status_warning{{ $user->id }}">غیر فعال</sup>
                                @else
                                <sup class="badge badge-warning d-none status_warning{{ $user->id }}">غیر فعال</sup>
                                @endif
                                </label>
                            </td>
                            <td class="width-22-rem text-left">
                                @can('update-user')
                                <a href="{{ route('admin.user.customer.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                @endcan
                                @can('delete-user')
                                <form action="{{ route('admin.user.customer.destroy', $user->id) }}" method="post" class="d-inline">
                                    <button class="btn btn-danger btn-sm delete" type="submit"><i class="fa fa-trash-alt"></i> حذف</button>
                                    @csrf
                                    @method('DELETE')
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
@component('admin.components.change-dynamic-status')

    @slot('title_function')
    changeActive
    @endslot
    @slot('element_name')
    activation
    @endslot
    @slot('error_msg')
     دو مرحله ای ادمین شما
    @endslot
@endcomponent

    @component('admin.components.change-status')

        @slot('slot')
           وضعیت ادمین
        @endslot

    @endcomponent
        @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
