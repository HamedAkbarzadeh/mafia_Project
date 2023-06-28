@extends('admin.layouts.master')

@section('head-tag')
<title>ایجاد نقش کاربر ادمین</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش کاربران</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">کاربران ادمین</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> نقش کاربران ادمین</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    نقش کاربر ادمین
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.user.admin-user.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                @can('create-set-role')
                <form action="{{ route('admin.user.admin-user.role.store' , $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @endcan
                    <section class="row">
                        <section class="col-12">
                            <div class="form-group">
                                <label for="select_role">نقش ها</label>
                                <select class="form-control form-control-sm" name="role[]" id="select_role" multiple>
                                @forelse ($roles as $role)
                                <option value="{{ $role->id }}"
                                    @foreach ($user->roles()->get() as $user_role)
                                        @if($user_role->id == $role->id)
                                            selected
                                        @endif
                                    @endforeach
                                    >{{ $role->name }}</option>
                                @empty

                                @endforelse
                                </select>
                                @component('admin.components.error')
                                role
                                @endcomponent
                            </div>
                        </section>
                        @can('create-set-role')
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
    var select_role = $('#select_role');
    console.log(select_role);
    select_role.select2({
            placeholder : 'لطفا نقش های خود را وارد نمایید',
            multiple : true,
            tags : true ,         });
</script>
@endsection
