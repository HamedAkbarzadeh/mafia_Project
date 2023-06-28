@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد نقش</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">نقش ها</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد نقش</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ایجاد نقش
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.role.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>

                @can('create-set-permission')
                <form action="{{ route('admin.user.role.permission-update' , $role->id) }}" method="post">
                    @csrf
                    @method('put')
                @endcan
                    <section class="row">
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label>عنوان نقش</label>
                                <input type="text" disabled value="{{ $role->name }}" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label>توضیح نقش</label>
                                <input type="text" disabled value="{{ $role->description }}" class="form-control form-control-sm">
                            </div>
                        </section>
                        <section class="col-12">
                            <section class="row border-top mt-3 py-3">
                                @foreach ($permissions as $key => $permission)
                                <section class="col-md-3">
                                    <div class="form-check">
                                        <input class="input" type="checkbox" class="form-check-input" name="{{ 'permission[]' }}" value="{{ $permission->id }}" id="{{ $permission->id }}" @if (in_array($permission->id , $havePermissions)) checked  @endif  />
                                        <label for="{{ $permission->id }}" class="form-check-label mr-3 mt-1">{{ $permission->name }}</label>
                                        @component('admin.components.error')
                                        permission.{{$key}}
                                        @endcomponent
                                    </div>
                                </section>
                                @endforeach
                            </section>
                        </section>

                @can('create-set-permission')
                        <section class="col-12 col-md-2 mt-md-2">
                            <button class="btn btn-primary btn-sm mt-md-4">ثبت</button>
                        </section>
                    </section>
                </form>
                @endcan
            </section>

        </section>
    </section>
</section>

@endsection
