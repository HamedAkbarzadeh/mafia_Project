@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد سطح دسترسی کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> سطح دسترسی کاربران ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    سطح دسترسی کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                @can('create-set-permission')
                <form action="{{ route('admin.user.admin-user.permission.store' , $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                @endcan
                    <section class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="select_permission">سطح دسترسی ها</label>
                                <select class="form-control form-control-sm" name="permission[]" id="select_permission" multiple>
                                @forelse ($permissions as $permission)
                                <option value="{{ $permission->id }}"
                                    @foreach ($user->permissions()->get() as $user_permission)
                                        @if($user_permission->id == $permission->id)
                                            selected
                                        @endif
                                    @endforeach
                                    >{{ $permission->name }}</option>
                                @empty

                                @endforelse
                                </select>
                                @component('admin.components.error')
                                permission
                                @endcomponent
                            </div>
                        </section>
                        @can('create-set-permission')
                        <section class="col-12">
                            <button class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                        @endcan
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection
@section('script')
<script>
    var select_permission = $('#select_permission');
    select_permission.select2({
            placeholder : 'لطفا دسترسی های خود را وارد نمایید',
            multiple : true,
            tags : true ,
            });
</script>
@endsection
