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
      <li class="breadcrumb-item font-size-12 active" aria-current="page"> ویرایش مسابقه</li>
    </ol>
  </nav>


  <section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                  ویرایش مسابقه
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('admin.event.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>
                <form action="{{ route('admin.event.update' , $event->id) }}" id="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <section class="row">
                        @can('update-event')
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">نوع مافیا</label>
                                <select name="type_game" id="type_game" class="form-control form-control-sm">
                                    <option value="">نوع مافیا را انتخاب نمایید . </option>
                                    <option value="0" @if (old('type_game' , $event->type_game) == 0) selected @endif>کلاسیک</option>
                                    <option value="1" @if (old('type_game' , $event->type_game) == 1) selected @endif>مدرن</option>
                                    <option value="2" @if (old('type_game' , $event->type_game) == 2) selected @endif>ور ولف</option>
                                </select>
                                @component('admin.components.error')
                                status
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="price">هزینه ورود (تومان)</label>
                                <input name="price" value="{{ old('price' , $event->price) }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                price
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="pay_citizen_win">جایزه برنده (شهروند) (تومان)</label>
                                <input name="pay_citizen_win" value="{{ old('pay_citizen_win' , $event->pay_citizen_win) }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                pay_citizen_win
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="pay_mafia_win">جایزه برنده (مافیا) (تومان)</label>
                                <input name="pay_mafia_win" value="{{ old('pay_mafia_win' , $event->pay_mafia_win) }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                pay_mafia_win
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="pay_independent_win">جایزه برنده (مستقل) (تومان)</label>
                                <input name="pay_independent_win" value="{{ old('pay_independent_win' , $event->pay_independent_win) }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                pay_independent_win
                                @endcomponent
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="start_date">تاریخ مسابقه</label>
                                <input type="text" name="start_date" id="published_at" class="d-none form-control form-control-sm" value="{{ old('start_date' ,$event->start_date)}}">
                                <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{ old('start_date' , $event->start_date)}}">
                                @component('admin.components.error')
                                start_date
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="amount_of_players">تعداد نفرات</label>
                                <select name="amount_of_players" id="amount_of_players" class="form-control form-control-sm">
                                    <option value="">تعداد نفرات را انتخاب کنید</option>
                                    @for ($i = 8 ; $i < 31 ; $i++)
                                    <option value="{{ $i }}" @if (old('amount_of_players' , $event->amount_of_players) == $i) selected @endif>نفره {{ $i }}</option>
                                    @endfor
                                </select>
                                @component('admin.components.error')
                                amount_of_players
                                @endcomponent
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="god_names">نام گاد</label>
                                <input name="god_names" value="{{ old('god_names' , $event->god_names) }}" type="text" class="form-control form-control-sm">
                                @component('admin.components.error')
                                god_names
                                @endcomponent
                            </div>
                        </section>

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status" class="form-control form-control-sm">
                                    <option value="0" @if (old('status', $event->status) == 0) selected @endif>غیر فعال</option>
                                    <option value="1" @if (old('status', $event->status) == 1) selected @endif>فعال</option>
                                </select>
                                @component('admin.components.error')
                                status
                                @endcomponent
                            </div>
                        </section>
                        @endcan
                        @can('update-state-game')

                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="game_status">وضعیت اتمام بازی</label>
                                <select name="game_status" id="game_status" class="form-control form-control-sm" value="{{ old('game_status')}}">
                                    <option value="0" @if (old('game_status' , $event->game_status) == 0) selected @endif>تمام نشده</option>
                                    <option value="1" @if (old('game_status', $event->game_status) == 1) selected @endif>تمام شده</option>
                                </select>
                                @component('admin.components.error')
                                game_status
                                @endcomponent
                            </div>
                        </section>
                        <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="complation_status"> تکمیل ظرفیت</label>
                                <select name="complation_status" id="complation_status" class="form-control form-control-sm" value="{{ old('complation_status')}}">
                                    <option value="0" @if (old('complation_status' , $event->complation_status) == 0) selected @endif> تکمیل نشده</option>
                                    <option value="1" @if (old('complation_status' , $event->complation_status) == 1) selected @endif>تکیمل شده</option>
                                </select>
                                @component('admin.components.error')
                                complation_status
                                @endcomponent
                            </div>
                        </section>

                        <section class="col-12 col-md-6 @if ($event->game_status == 0)
                            d-none
                        @endif" id="side_win">
                            <div class="form-group">
                                <label for="side_win">ساید برنده شده</label>
                                <select name="side_win" class="form-control form-control-sm" value="{{ old('side_win')}}">
                                    <option value="0" @if (old('side_win' , $event->side_win) == 0) selected @endif>شهروند</option>
                                    <option value="1" @if (old('side_win' , $event->side_win) == 1) selected @endif>مافیا</option>
                                    <option value="2" @if (old('side_win' , $event->side_win) == 2) selected @endif>مستقل</option>
                                </select>
                                @component('admin.components.error')
                                side_win
                                @endcomponent
                            </div>
                        </section>
                        @endcan

                        @can('update-event')
                        <section class="col-12">
                            <label for="mafia_role">نقش های ساید مافیا</label>
                            <select class="form-control form-control-sm" name="mafiaRole[]" id="mafia_role" multiple>
                            @forelse ($mafias as $mafia)
                            <option value="{{ $mafia->id }}"
                                @foreach ($selectedMafias as $selectedMafia)
                                @if (old('mafiaRole' , $selectedMafia->id) == $mafia->id) selected @endif
                                @endforeach
                                 >

                                 {{ $mafia->name }}
                                </option>
                            @empty

                            @endforelse
                            </select>
                            @component('admin.components.error')
                            mafiaRole
                            @endcomponent
                        </section>
                        <section class="col-12">
                            <label for="citizen_role">نقش های ساید شهروند</label>
                            <select class="form-control form-control-sm" name="citizenRole[]" id="citizen_role" multiple>
                            @forelse ($citizens as $citizen)
                            <option value="{{ $citizen->id }}"
                                @foreach ($selectedCitizens as $selectedCitizen)
                                @if (old('citizenRole' , $selectedCitizen->id) == $citizen->id) selected @endif
                                @endforeach
                                >

                                {{ $citizen->name }}</option>
                            @empty

                            @endforelse
                            </select>
                            @component('admin.components.error')
                            citizenRole
                            @endcomponent
                        </section>
                        <section class="col-12">
                            <label for="independent_role">نقش های ساید مستقل</label>
                            <select class="form-control form-control-sm" name="independentRole[]" id="independent_role" multiple>
                            @forelse ($independents as $independent)
                            <option value="{{ $independent->id }}"
                                @foreach ($selectedIndependents as $selectedIndependent)
                                @if (old('independentRole' , $selectedIndependent->id) == $independent->id) selected @endif
                                @endforeach
                                >

                                {{ $independent->name }}</option>
                            @empty

                            @endforelse
                            </select>
                            @component('admin.components.error')
                            independentRole
                            @endcomponent
                        </section>
                        <section class="col-12 col-md-6 mt-4">
                            <div class="form-group">
                                <label for="vip_game">آیا این بازی (vip) است ؟ </label>
                                <br>
                                <input name="vip_game" value="1" type="checkbox"  @if (old('vip_game' , $event->vip_game) == 1) checked @endif>
                                @component('admin.components.error')
                                vip_game
                                @endcomponent
                            </div>
                        </section>
                        @endcan

                        <section class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">ثبت</button>
                        </section>
                    </section>
                </form>
            </section>

        </section>
    </section>
</section>

@endsection

@section('script')

    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('body');
        CKEDITOR.replace('summary');
    </script>
<script>
    var mafia_role = $('#mafia_role');
    var citizen_role = $('#citizen_role');
    var independent_role = $('#independent_role');

            mafia_role.select2({
            placeholder : 'لطفا نقش های ساید مافیا را وارد نمایید .',
            multiple : true,
            tags : true ,
            });
            citizen_role.select2({
            placeholder : 'لطفا نقش های ساید شهروند را وارد نمایید .',
            multiple : true,
            tags : true ,
            });
            independent_role.select2({
            placeholder : 'لطفا نقش های ساید مستقل را وارد نمایید .',
            multiple : true,
            tags : true ,
            });
</script>
<script>
    $(document).ready(function () {
        $('#game_status').change(function(){
            var game_status_val = $(this).val();
            if(game_status_val == 1){
                $('#side_win').removeClass('d-none');
            }else{
                $('#side_win').addClass('d-none');
            }
        });
    });
</script>
@include('admin.partials.jalali-date')
@include('admin.partials.tags')
@endsection
