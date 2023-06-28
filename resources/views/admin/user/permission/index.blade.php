@extends('admin.layouts.master')

@section('head-tag')
<title>دسترسی ها</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> دسترسی ها</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    دسترسی ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                @can('create-permission')
                <a href="{{ route('admin.user.permission.create') }}" class="btn btn-info btn-sm">ایجاد دسترسی جدید</a>
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
                            <th>نام دسترسی	</th>
                            <th>نام نقش</th>
                            <th>توضیحات دسترسی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @if(empty($permission->roles()->get()->toArray()))
                                    <span class="text-danger">برای این دسترسی هیچ نقشی وجود ندارد .</span>
                                @else
                                @foreach ($permission->roles()->get() as $role)
                                {{ $role->name }}<br>
                                @endforeach
                                @endif
                            </td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <label>
                                @can('update-permission')
                                    <input id="{{ $permission->id }}" onchange="changeStatus({{$permission->id}})" data-url="{{ route('admin.user.permission.status' , $permission->id) }}" type="checkbox" @if ($permission->status === 1)
                                    checked
                                @endif>
                                @endcan
                                @if ($permission->status === 0)
                                <sup class="badge badge-warning status_warning{{ $permission->id }}">غیر فعال</sup>
                                @else
                                <sup class="badge badge-warning d-none status_warning{{ $permission->id }}">غیر فعال</sup>
                                @endif
                                </label>
                            </td>
                            <td class="width-22-rem text-left">
                                @can('update-permission')
                                <a href="{{ route('admin.user.permission.edit', $permission->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                @endcan
                                @can('delete-permission')
                                <form action="{{ route('admin.user.permission.destroy', $permission->id) }}" method="POST" class="d-inline">
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
            دسترسی
        @endslot
    @endcomponent
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection
