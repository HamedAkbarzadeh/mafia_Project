@extends('admin.layouts.master')

@section('head-tag')
<title>کاربران ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> کاربران ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                کاربران ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                @can('create-admin')
                <a href="{{ route('admin.user.admin-user.create') }}" class="btn btn-info btn-sm">ایجاد ادمین جدید</a>
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
                            <th>ایمیل</th>
                            <th>شماره موبایل</th>
                            <th>نام </th>
                            <th>فعال سازی</th>
                            <th>وضعیت</th>
                            <th>نقش</th>
                            <th>سطوح دسترسی</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $key => $admin)
                        <tr>
                            <th>{{ $key += 1 }}</th>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->mobile }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>
                                <label>
                                    <input id="{{ $admin->id.'activation' }}" onchange="changeActive({{$admin->id}})" data-url="{{ route('admin.user.admin-user.activation' , $admin->id) }}" type="checkbox" @if ($admin->activation === 1)
                                    checked
                                @endif>
                                @if ($admin->activation === 0)
                                <sup class="badge badge-warning activation{{ $admin->id }}">غیر فعال</sup>
                                @else
                                <sup class="badge badge-warning d-none activation{{ $admin->id }}">غیر فعال</sup>
                                @endif
                                </label>
                            </td>
                            <td>
                                <label>
                                @can('update-admin')
                                <input id="{{ $admin->id }}" onchange="changeStatus({{$admin->id}})" data-url="{{ route('admin.user.admin-user.status' , $admin->id) }}" type="checkbox" @if ($admin->status === 1)
                                checked
                                @endif>
                                @endcan
                                @if ($admin->status === 0)
                                <sup class="badge badge-warning status_warning{{ $admin->id }}">غیر فعال</sup>
                                @else
                                <sup class="badge badge-warning d-none status_warning{{ $admin->id }}">غیر فعال</sup>
                                @endif
                                </label>
                            </td>
                            <td>
                                @forelse ($admin->roles()->get() as $role)
                                    <div>{{$role->name}}</div>
                                @empty
                                    <div class="text-danger">هیچ نقشی ندارد این کاربر .</div>
                                @endforelse
                            </td>
                            <td>
                                @forelse ($admin->permissions()->get() as $permission)
                                    <div>{{$permission->name}}</div>
                                @empty
                                    <div class="text-danger">هیچ سطوج دسترسی ندارد این کاربر </div>
                                @endforelse
                            </td>
                            <td class="width-22-rem text-left">
                                @can('read-set-permission')
                                <a href="{{ route('admin.user.admin-user.permission', $admin->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> سطوح دسترسی</a>
                                @endcan
                                @can('read-set-role')
                                <a href="{{ route('admin.user.admin-user.role', $admin->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> نقش</a>
                                @endcan
                                @can('update-admin')
                                <a href="{{ route('admin.user.admin-user.edit', $admin->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                @endcan
                                @can('delete-admin')
                                <form action="{{ route('admin.user.admin-user.destroy', $admin->id) }}" method="post" class="d-inline">
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
