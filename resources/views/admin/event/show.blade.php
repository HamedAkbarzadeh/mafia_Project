@extends('admin.layouts.master')

@section('head-tag')
<link rel="stylesheet" href="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.css') }}">
<title>ایجاد مسابقه</title>
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item font-size-12"> <a href="#">خانه</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">بخش رویداد ها</a></li>
      <li class="breadcrumb-item font-size-12"> <a href="#">مسابقات</a></li>
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ایجاد مسابقه</li>
    </ol>
  </nav>

  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {{-- <div class="callout callout-info">
            <h5><i class="fa fa-info"></i> نکته :</h5>
            پس از ثبت نام در بازی حضور شما در بازی اجباری است و درصورت شرکت نکردن تا 2 هفته نمیتوانید شرکت نمایید.
          </div> --}}


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fa fa-globe"></i> بازی
                  @if ($event->type_game == 0)
                  کلاسیک
                    @elseif ($event->type_game == 1)
                  مدرن
                    @elseif ($event->type_game == 2)
                  ورولف
                    @endif
                  مافیا
                  <small class="float-left">تاریخ بازی : {{ jalaliDate($event->start_date) }}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <span class="border-bottom d-flex flex-wrap">
              <div class="col-sm-4 invoice-col mb-1">
                  نوع  : مافیای <b>
                    @if ($event->type_game == 0)
                    کلاسیک
                      @elseif ($event->type_game == 1)
                    مدرن
                      @elseif ($event->type_game == 2)
                    ورولف
                      @endif
                  </b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                ساعت شروع بازی : <b>{{ jalaliDate($event->start_date , 'H:i') }}</b>
            </div>
              <div class="col-sm-4 invoice-col mb-1">
                  تعداد نفرات  : <b>({{ $countMafia ?? '0' }} مافیا و {{ $countCitizen ?? '0'}} شهروند و {{ $countIndependents ?? '0'}} مستقل)</b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                  هزینه ورود به بازی : <b>{{ priceFormat($event->price) }} تومان</b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                  جایزه برنده (مافیا) : <b>{{ priceFormat($event->pay_mafia_win) }} تومان </b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                  جایزه برنده (شهروند) : <b>{{ priceFormat($event->pay_citizen_win) }} تومان </b>
              </div>
             <div class="col-sm-4 invoice-col mb-1">
                جایزه برنده (مستقل) : <b>{{ priceFormat($event->pay_independent_win) }}  </b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                نام گاد : <b>{{ $event->god_names ?? 'نامشخص' }}  </b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                آیا این بازی Vip است ؟  : <b>{{ $event->vip_game == 0 ? 'خیر' : 'بله'; }}  </b>
              </div>
              <div class="col-sm-4 invoice-col mb-1">
                آیا ظرفیت تکمیل شده است ؟ : <b>{{ $event->complation_status == 0 ? 'خیر' : 'بله'; }}  </b>
              </div>
            </span>

            @if ($event->complation_status == 1)
            <div class="col-sm-12 invoice-col mb-1 mt-2">
               <span class="text-danger font-size-18">اتمام بازی</span>
            </div>
            <div class="col-sm-4 invoice-col mb-1">
              تیم برنده :
               <b>
                @if ($event->side_win == 0)
                  شهروند
                  @elseif ($event->side_win == 1)
                  مافیا
                  @elseif($event->side_win == 2)
                  مستقل
                  @endif
               </b>
            </div>
            @endif

              @if ($mafiaTeams->first() !== null)
              <div class="col-12 invoice-col mt-3 mb-2">
                  نقش های موجود در ساید <b>مافیا</b> : (
                    @foreach ($mafiaTeams as $mafiaTeam)
                      {{ $mafiaTeam->name }} ,
                    @endforeach
                  )
              </div>
              @endif

              @if ($citizenTeams->first() !== null)
              <div class="col-12 invoice-col mb-3">
                  نقش های موجود در ساید <b>شهروند</b> : (
                    @foreach ($citizenTeams as $citizenTeam)
                    {{ $citizenTeam->name }} ,
                    @endforeach
                  )
              </div>
              @endif

              @if ($independentTeams->first() !== null)
              <div class="col-12 invoice-col mb-3">
                نقش های موجود در ساید <b>مستقل</b> : (
                  @foreach ($independentTeams as $independentTeam)
                    {{ $independentTeam->name }} ,
                    @endforeach
                )
              </div>
              @endif

            </div>
            <!-- /.row -->



            <!-- this row will not appear when printing -->

          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </section>
    </section>
        </section>
@endsection

@section('script')
@include('admin.partials.jalali-date')
@include('admin.partials.tags')
@endsection
