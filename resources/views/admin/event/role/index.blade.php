@extends('admin.layouts.master')

@section('head-tag')
<title>مسابقات</title>
@endsection

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">نقش های مافیا</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    مدیریت نقش های مافیا
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
               @can('create-mafia')
               <a href="{{ route('admin.event.role.create') }}" class="btn btn-info btn-sm">ایجاد نقش جدید</a>
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
                            <th>نام نقش</th>
                            <th>توضیحات نقش</th>
                            <th>ساید نقش</th>
                            <th>برای چه نوعی گیمی</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mafias as $mafia)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mafia->name }}</td>
                            <td>{!! Str::limit($mafia->description, 45, '...') !!}</td>
                            <td>
                                @if ($mafia->side == 0)
                                    شهروند
                                    @elseif ($mafia->side == 1)
                                    مافیا
                                    @elseif ($mafia->side == 2)
                                    مستقل
                                @endif
                            </td>
                            <td>{{ $mafia->game_type == 0 ? 'کلاسیک' : 'مدرن' }} نفر</td>
                            <td>
                                <label>
                                    @can('update-mafia')
                                    <input id="{{ $mafia->id }}" onchange="changeStatus({{$mafia->id}})" data-url="{{ route('admin.event.role.status' , $mafia->id) }}" type="checkbox" @if ($mafia->status === 1)
                                    checked
                                    @endif>
                                    @endcan
                                    @if ($mafia->status === 0)
                                    <sup class="badge badge-warning status_warning{{ $mafia->id }}">غیر فعال</sup>
                                    @else
                                    <sup class="badge badge-warning d-none status_warning{{ $mafia->id }}">غیر فعال</sup>
                                    @endif
                                </label>
                            </td>

                            <td class="width-16-rem text-left">
                                @can('update-mafia')
                                <a href="{{ route('admin.event.role.edit', $mafia->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> ویرایش</a>
                                @endcan
                           @can('delete-mafia')
                            <form class="d-inline" action="{{ route('admin.event.role.destroy', $mafia->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                    <button class="btn btn-danger btn-sm delete"><i class="fa fa-edit"></i> حذف</button>
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
            نقش
        @endslot

    @endcomponent
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection

