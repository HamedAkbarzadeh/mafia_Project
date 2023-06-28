@extends('user-panel.layouts.master')

@section('head-tag')
    <title>ثبت نام در مافیا</title>
@endsection

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ثبت نام نهایی در بازی</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="{{ route('user-panel.index') }}">خانه</a></li>
              <li class="breadcrumb-item active">ثبت نام نهایی</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @if ($event->complation_status == 0 && empty($hasGame) && $event->game_status == 0)
          <form action="{{ route('user-panel.register-competition-submit' , $event->id) }}" method="POST">
            @csrf
            @endif
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fa fa-info"></i> نکته :</h5>
              پس از ثبت نام در بازی حضور شما در بازی اجباری است و درصورت شرکت نکردن تا 1 هفته نمیتوانید شرکت نمایید.
            </div>


               <!-- Main content -->
               <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12 mb-3">
                    <h4 class="d-flex flex-column flex-md-row justify-content-md-between">
                      <span class="mb-3">
                        <i class="fa fa-globe"></i> بازی {{ $event->type_game == 0 ? 'کلاسیک' : 'مدرن' }} مافیا
                        @if ($event->vip_game == 1)
                        <span class="successSpan"><b class="text-success">Vip<i class="fa fa-check-circle-o"></i></b></span>
                      @endif
                      </span>
                      <small>
                        <span>تاریخ بازی : {{ jalaliDate($event->start_date) }}</span><br>
                      </small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                  <span class="border-bottom d-flex flex-wrap">
                  <div class="col-sm-4 invoice-col mb-1">
                      نوع  : مافیای  <b>
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
                      هزینه ورود به بازی : <b>{{ priceFormat($event->price) == 0 ? 'رایگان' : priceFormat($event->price). ' تومان' }}</b>
                  </div>
                  <div class="col-sm-4 invoice-col mb-1">
                      جایزه برنده (مافیا) : <b>{{ priceFormat($event->pay_mafia_win) == 0 ? 'بدون جایزه' : priceFormat($event->pay_mafia_win). ' تومان' }}</b>
                  </div>
                  <div class="col-sm-4 invoice-col mb-1">
                      جایزه برنده (شهروند) : <b>{{ priceFormat($event->pay_citizen_win) == 0 ? 'بدون جایزه' : priceFormat($event->pay_citizen_win). ' تومان' }}</b>
                  </div>
                 <div class="col-sm-4 invoice-col mb-1">
                    جایزه برنده (مستقل) : <b>{{ priceFormat($event->pay_independent_win) == 0 ? 'بدون جایزه' : priceFormat($event->pay_independent_win). ' تومان' }}</b>
                  </div>
                  <div class="col-sm-4 invoice-col mb-1">
                    نام گاد : <b>{{ $event->god_names ?? 'نامشخص' }}  </b>
                  </div>
                  <div class="col-sm-4 invoice-col mb-1">
                    تعداد نفرات : <b>{{ $event->amount_of_players }} نفر </b>
                  </div>
                </span>


                @if ($event->game_status == 1)
                <div class="col-sm-12 invoice-col mb-1 mt-2 d-flex flex-column align-items-start">
                   <span class="text-info infoSpan text-center m-2"><h5>اتمام بازی</h5></span>
                   @if ($winStatus == 1)
                   <span class="text-success successSpan text-center mb-2"><h5>شما بازی رو بردید</h5></span>
                     @elseif($winStatus == 0)
                   <span class="text-danger dangerSpan text-center m-2"><h5>شما بازی رو باختید</h5></span>
                   @endif
                </div>
                <div class="col-sm-4 invoice-col mb-1">
                  تیم برنده :
                    @if ($event->side_win == 0)
                    <a href="{{ route('user-panel.role.show-role' , 'type=0') }}"><span class="roleMafiaSpan">شهروند</span></a>
                      @elseif ($event->side_win == 1)
                      <a href="{{ route('user-panel.role.show-role' , 'type=1') }}"><span class="roleMafiaSpan">مافیا</span></a>
                      @elseif($event->side_win == 2)
                      <a href="{{ route('user-panel.role.show-role' , 'type=2') }}"><span class="roleMafiaSpan">مستقل</span></a>
                      @else
                      نامعلوم
                      @endif
                </div>
                <div class="col-sm-4 invoice-col mb-1">
                  ساید شما در بازی :
                    @if ($userRoleInfo != null)

                    @if ($userRoleInfo->side == 0)
                    <a href="{{ route('user-panel.role.show-role' , 'type=0') }}"><span class="roleMafiaSpan">شهروند</span></a>
                    @elseif ($userRoleInfo->side == 1)
                    <a href="{{ route('user-panel.role.show-role' , 'type=1') }}"><span class="roleMafiaSpan">مافیا</span></a>
                    @elseif($userRoleInfo->side == 2)
                    <a href="{{ route('user-panel.role.show-role' , 'type=2') }}"><span class="roleMafiaSpan">مستقل</span></a>
                    @else
                    نامعلوم
                    @endif
                    @endif
                </div>
                <div class="col-sm-4 invoice-col mb-1">
                  نقش شما در بازی : <span class="roleMafiaSpan">{{ $userRoleInfo->name ?? 'نامعلوم' }}</span></b>
                </div>
                @endif

                  @if ($mafiaTeams->first() !== null)
                  <div class="col-12 invoice-col mt-3 mb-2">
                      نقش های موجود در ساید <b>مافیا</b> :
                        @foreach ($mafiaTeams as $mafiaTeam)
                          <a href="{{ route('user-panel.role.show-role' , 'type=1') }}"><span class="roleMafiaSpan">{{ $mafiaTeam->name }}</span></a>
                        @endforeach

                  </div>
                  @endif

                  @if ($citizenTeams->first() !== null)
                  <div class="col-12 invoice-col mb-2">
                      نقش های موجود در ساید <b>شهروند</b> :
                        @foreach ($citizenTeams as $citizenTeam)
                        <a href="{{ route('user-panel.role.show-role' , 'type=0') }}"><span class="roleMafiaSpan">{{ $citizenTeam->name }}</span></a>
                        @endforeach

                  </div>
                  @endif

                  @if ($independentTeams->first() !== null)
                  <div class="col-12 invoice-col mb-3">
                    نقش های موجود در ساید <b>مستقل</b> :
                      @foreach ($independentTeams as $independentTeam)
                      <a href="{{ route('user-panel.role.show-role' , 'type=2') }}"><span class="roleMafiaSpan">{{ $independentTeam->name }}</span></a>
                        @endforeach

                  </div>
                  @endif
                  <div class="invoice-col mb-3">
                    <select class="form-control form-control-sm" name="payment_type">
                      <option value="3">پرداخت حضوری</option>
                    </select>
                  </div>
                  @if ($event->game_status != 0 || $event->complation_status != 0 || !$hasGame)
                  <div class="col-12 invoice-col mb-3 d-flex align-items-center">
                        <label class="text-info" for="ruleConfirm">تایید تمام <a href="{{ route('customer.home') }}">قوانین</a> بازی </label>
                        <input type="checkbox" name="ruleConfirm" id="ruleConfirm" class="mr-2">
                  </div>
                </div>
                @endif
                <!-- /.row -->
                @if ($event->game_status == 0)

                @if ($event->complation_status == 0 || $hasGame)

                @if (empty($hasGame))
                  <div class="row no-print d-flex">
                      <button id="register-btn" disabled class="btn btn-dark">ثبت نام</button>
                  </div>
                @else
                  <div class="row no-print d-flex">
                    <a href="{{ route('user-panel.leave-game' , $event->id) }}" class="btn btn-default">انصراف از شرکت</a>
                  </div>
                @endif

                @else
                  <div class="row no-print d-flex">
                    <button disabled class="btn btn-danger">تکمیل ظرفیت</button>
                  </div>
                @endif

                @else
                <div class="row no-print d-flex">
                  <button disabled class="btn btn-outline-info">بازی به پایان رسید </button>
                </div>
                @endif

              </div>
              <!-- /.invoice -->
          </div><!-- /.col -->
          @if ($event->complation_status == 0 && empty($hasGame) && $event->game_status == 0)
          </form>
          @endif
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @section('script')
  <script>
    $(document).ready(function () {
        $("#register-btn").attr("disabled","disabled");
        $("#ruleConfirm").click(function (e) {
            if($(this).is(':checked')){
                $("#register-btn").removeAttr("disabled")
            }else{
                $("#register-btn").attr("disabled","disabled");
            }

        });
    });
  </script>
  @endsection
