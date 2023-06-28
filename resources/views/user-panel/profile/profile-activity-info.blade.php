@extends('user-panel.layouts.master')

@section('head-tag')
<title>ثبت نام در مسابقات</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">پروفایل</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{ route('user-panel.index') }}">خانه</a></li>
                <li class="breadcrumb-item">پروفایل </li>
                <li class="breadcrumb-item active">فعالیت ها </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="custom-parent-event d-flex flex-wrap col-12">
              <!-- small box -->
              @foreach ($events as $event)
              <a href="{{ route('user-panel.register-competition' , $event->id) }}" class="col-md-4 col-12">
                <span class="small-box custom-item-event
                @if($event->type_game == 1)
                back-mafia-modern
                @elseif($event->type_game == 0)
                back-mafia-classic
                @endif
                d-flex">
                  <div class="inner">
                    <div class="font-custom-2" class="">مافیای
                      @if ($event->type_game == 0)
                      کلاسیک
                        @elseif ($event->type_game == 1)
                      مدرن
                        @elseif ($event->type_game == 2)
                      ورولف
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                    <div class="font-custom">تعداد : {{ $event->amount_of_players }} نفره</div>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span class="font-12">تاریخ : {{ jalaliDate($event->start_date) }}</span>
                      {{-- <span class="font-12">هزینه ورود : <b>{{ priceFormat($event->price) }} تومان</b></span> --}}
                    </div>
                  </div>
                  <div class="icon-self">
                    <img src="{{ asset('user-assets/god (1).png') }}" alt="" class="image-cutomize">
                  </div>
                  @if (!empty($event->users()->where('user_id' , auth()->user()->id)->first()))
                  <span class="custom-badge badge"><i class="fa fa-check"></i></span>
                  @endif
                  <div class="more-info-event
                  @if ($event->type_game == 1)
                  back-mafia-modern-more-info
                  @elseif($event->type_game == 0)
                  back-mafia-classic-more-info
                  @endif
                  d-flex">
                    <div class="arrow-left"></div>
                      اطلاعات بیشتر
                      <i class="fa fa-arrow-circle-left"></i>
                  </div>
                </span>
              </a>
                @endforeach
              </div>
          </div>
          <!-- /.row -->
          <!-- Main row -->

          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
@endsection

