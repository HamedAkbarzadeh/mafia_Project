@extends('admin.layouts.master')

@section('head-tag')
<title>مسابقات</title>
@endsection

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش محتوی</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page">مسابقات</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    مدیریت مسابقات ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                @can('create-event')
                <a href="{{ route('admin.event.create') }}" class="btn btn-info btn-sm">ایجاد مسابقات جدید</a>
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
                            <th>نوع بازی </th>
                            <th>تعداد بازیکن ها</th>
                            <th>هزینه ورود</th>
                            <th>تاریخ</th>
                            <th>ساعت</th>
                            <th>وضعیت</th>
                            <th class="max-width-16-rem text-center"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($event->type_game == 0)
                                کلاسیک
                                  @elseif ($event->type_game == 1)
                                مدرن
                                  @elseif ($event->type_game == 2)
                                ورولف
                                  @endif</td>
                            <td>{{ $event->amount_of_players }} نفر</td>
                            <td>{{ $event->price }} تومان</td>
                            <td>{{ jalaliDate($event->start_date) }}</td>
                            <td>{{ jalaliDate($event->start_date , "H:i
                            ") }}</td>
                            <td>
                                <label>
                                   @can('update-event')
                                    <input id="{{ $event->id }}" onchange="changeStatus({{$event->id}})" data-url="{{ route('admin.event.status' , $event->id) }}" type="checkbox" @if ($event->status === 1)
                                    checked
                                    @endif>
                                    @endcan
                                    @if ($event->status === 0)
                                    <sup class="badge badge-warning status_warning{{ $event->id }}">غیر فعال</sup>
                                    @else
                                    <sup class="badge badge-warning d-none status_warning{{ $event->id }}">غیر فعال</sup>
                                    @endif
                                </label>
                            </td>

                            <td class="width-16-rem text-left">
                                @if (auth()->user()->can('update-event') || auth()->user()->can('update-state-game'))
                                <a href="{{ route('admin.event.edit', $event->id) }}" title="ویرایش کردن" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                @endif

                                @can('read-state-game')
                                <a href="{{ route('admin.event.show', $event->id) }}" title="نمایش اطلاعات بیشتر" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> </a>
                                @endcan
                                @can('read-user-state-game')
                                <a href="{{ route('admin.event.user', $event->id) }}" title="لیست بازیکنان" class="btn btn-info btn-sm"><i class="fa fa-user-alt"></i></a>
                                @endcan

                                @can('delete-event')
                                <form class="d-inline" action="{{ route('admin.event.destroy', $event->id) }}" method="post">
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
            مسابقه
        @endslot

    @endcomponent
    @include('admin.alerts.sweetalert.delete-confirm' , ['className' => 'delete'])
@endsection

