@extends('user-panel.layouts.master')

@section('head-tag')
<title>ثبت نام در مسابقات</title>
<style>
      .custom-item-event::after{
    border: 1px solid rgb(235, 233, 233);
    }
</style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">نقش های مافیا</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="{{ route('user-panel.index') }}">خانه</a></li>
                <li class="breadcrumb-item active">داشبورد </li>
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
              <a href="{{ route('user-panel.role.show-role' , 'type=1') }}" class="col-md-4 col-12">
                <span class="small-box custom-item-event back-mafia d-flex">
                  <div class="inner">
                    <div class="font-custom-2" class="">مافیا</div>
                    <div class="d-flex justify-content-between">
                    <div class="font-custom">تعداد نقش : {{ $countMafia }} نفره</div>
                    </div>
                    <div class="d-flex justify-content-between">
                      {{-- <span class="font-12">تاریخ : {{ jalaliDate($event->start_date) }}</span> --}}
                      {{-- <span class="font-12">هزینه ورود : <b>{{ priceFormat($event->price) }} تومان</b></span> --}}
                    </div>
                  </div>
                  <div class="icon-self">
                    <img src="{{ asset('user-assets/god (1).png') }}" alt="" class="image-cutomize">
                  </div>

                  <div class="more-info-event back-mafia-more-info d-flex">
                    <div class="arrow-left"></div>
                      اطلاعات بیشتر
                      <i class="fa fa-arrow-circle-left"></i>
                  </div>
                </span>
              </a>

              <a href="{{ route('user-panel.role.show-role' , 'type=0') }}" class="col-md-4 col-12">
                <span class="small-box custom-item-event back-citizen d-flex">
                  <div class="inner">
                    <div class="font-custom-2" class="">شهروند</div>
                    <div class="d-flex justify-content-between">
                    <div class="font-custom">تعداد نقش : {{ $countCitizen }} نفره</div>
                    </div>
                    <div class="d-flex justify-content-between">
                      {{-- <span class="font-12">تاریخ : {{ jalaliDate($event->start_date) }}</span> --}}
                      {{-- <span class="font-12">هزینه ورود : <b>{{ priceFormat($event->price) }} تومان</b></span> --}}
                    </div>
                  </div>
                  <div class="icon-self">
                    <img src="{{ asset('user-assets/god (1).png') }}" alt="" class="image-cutomize">
                  </div>

                  <div class="more-info-event back-citizen-more-info d-flex">
                    <div class="arrow-left"></div>
                      اطلاعات بیشتر
                      <i class="fa fa-arrow-circle-left"></i>
                  </div>
                </span>
              </a>

              <a href="{{ route('user-panel.role.show-role' , 'type=2') }}" class="col-md-4 col-12">
                <span class="small-box custom-item-event back-independent d-flex">
                  <div class="inner">
                    <div class="font-custom-2" class="">مستقل</div>
                    <div class="d-flex justify-content-between">
                    <div class="font-custom">تعداد نقش : {{ $countIndependent }} نفره</div>
                    </div>
                    <div class="d-flex justify-content-between">
                      {{-- <span class="font-12">تاریخ : {{ jalaliDate($event->start_date) }}</span> --}}
                      {{-- <span class="font-12">هزینه ورود : <b>{{ priceFormat($event->price) }} تومان</b></span> --}}
                    </div>
                  </div>
                  <div class="icon-self">
                    <img src="{{ asset('user-assets/god (1).png') }}" alt="" class="image-cutomize">
                  </div>

                  <div class="more-info-event back-independent-more-info d-flex">
                    <div class="arrow-left"></div>
                      اطلاعات بیشتر
                      <i class="fa fa-arrow-circle-left"></i>
                  </div>
                </span>
              </a>
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

