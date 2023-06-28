@extends('user-panel.layouts.master')

@section('head-tag')
<title>ثبت نام در مسابقات</title>
@endsection

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>پروفایل</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                  <li class="breadcrumb-item"><a href="{{ route('user-panel.index') }}">خانه</a></li>
                  <li class="breadcrumb-item active">پروفایل کاربری</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <!-- /.col -->
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">فعالیت‌ها</a></li>
                      <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تنظیمات</a></li>
                      <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">ویرایش پسورد</a></li>
                    </ul>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    <div class="tab-content">
                      {{-- activity --}}
                      <div class="tab-pane active" id="activity">
                        <div class="d-flex flex-wrap">
                          <div class="col-12 col-sm-6 col-md-4">
                            <a href="{{ route('user-panel.profile-info' , 'type=all') }}" class="text-decoration-none text-dark activity-item">
                            <div class="info-box">
                              <span class="info-box-icon bg-info-gradient elevation-1">all</span>
                              <div class="info-box-content">
                                <span class="info-box-text">تعداد کل بازی</span>
                                <span class="info-box-number">
                                  {{ $allGame ?? 0 }}
                                </span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            </a>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                          <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-success-gradient elevation-1"><i class="fa fa-check-square-o"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">تعداد برد</span>
                                <span class="info-box-number">
                                  {{ $wins ?? 0 }}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                           <!-- /.col -->
                           <div class="col-12 col-sm-6 col-md-4">

                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-danger-gradient elevation-1"><i class="fa fa-minus-square-o"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">تعداد باخت</span>
                                <span class="info-box-number">{{ $failed ?? 0 }}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>

                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                           <!-- /.col -->
                           <div class="col-12 col-sm-6 col-md-4">
                            <a href="{{ route('user-panel.profile-info' , 'type=mafia') }}" class="text-decoration-none text-dark activity-item">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-dark-gradient elevation-1"><i class="fa fa-black-tie"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">تعداد مافیا بودن</span>
                                <span class="info-box-number">{{ $mafia ?? 0 }}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            </a>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                           <!-- /.col -->
                           <div class="col-12 col-sm-6 col-md-4">

                             <a href="{{ route('user-panel.profile-info' , 'type=citizen') }}" class="text-decoration-none text-dark activity-item">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-gray-light elevation-1"><i class="fa fa-users"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">تعداد شهروند بودن</span>
                                <span class="info-box-number">{{ $citizen ?? 0 }}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                             </a>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                           <!-- /.col -->
                           <div class="col-12 col-sm-6 col-md-4">

                            <a href="{{ route('user-panel.profile-info' , 'type=independent') }}" class="text-decoration-none text-dark activity-item">
                            <div class="info-box mb-3">
                              <span class="info-box-icon bg-dark-gray elevation-1"><i class="fa fa-user-secret"></i></span>

                              <div class="info-box-content">
                                <span class="info-box-text">تعداد مستقل بودن</span>
                                <span class="info-box-number">{{ $independent ?? 0 }}</span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            </a>
                            <!-- /.info-box -->
                          </div>
                          <!-- /.col -->
                        </div>
                      </div>
                      {{-- password --}}
                      <div class="tab-pane" id="password">
                        <form action="{{ route('user-panel.profile.update-password') }}" method="POST" class="form-horizontal d-flex flex-wrap">
                            @csrf
                            @method('PUT')
                          <section class="col-12">
                            <div class="form-group">
                                <label for="password" class="control-label important-label">پسورد کنونی خود را وارد نمایید </label>
                                <div class="">
                                  <input type="password" name="password" class="form-control" id="first-name" placeholder="پسورد کنونی ...">
                                </div>
                              </div>
                          </section>

                          <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="new-password" class="control-label important-label">پسورد جدید را وارد نمایید</label>

                                <div class="">
                                  <input type="password" name="new-password" class="form-control" id="mobile" placeholder="پسورد جدید ...">
                                </div>
                              </div>
                          </section>
                          <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="new-password-confirm" class="control-label important-label">پسورد جدید را دوباره وارد نمایید</label>

                                <div class="">
                                  <input type="password" name="new-password-confirm" class="form-control" id="mobile" placeholder=" پسورد جدید را دوباره وارد نمایید ...">
                                </div>
                              </div>
                          </section>
                          <section class="col-12">
                          <div class="form-group">
                            <div class="col-sm-offset-2">
                              <button type="submit" class="btn btn-success">تایید</button>
                            </div>
                          </div>
                          </section>
                        </form>
                      </div>
                      {{-- setting --}}
                      <div class="tab-pane" id="settings">
                        <form action="{{ route('user-panel.profile.update-profile') }}" method="POST" enctype="multipart/form-data" class="form-horizontal d-flex flex-wrap">
                          @csrf
                          @method('PUT')
                          <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label important-label">نام و نام خانوادگی</label>

                                <div class="">
                                  <input type="text" name="name" value="{{ $user->name ?? '' }}" class="form-control" id="first-name" placeholder="نام و نام خانوادگی ...">
                                  @component('admin.components.error')
                                  name
                                  @endcomponent
                                </div>
                              </div>
                          </section>

                          <section class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="mobile" class="col-sm-6 control-label important-label">شماره تلفن</label>

                                <div class="">
                                  <input type="text" name="mobile" class="form-control" value="0{{ $user->mobile ?? '' }}" id="mobile" placeholder="شماره تلفن ...">
                                  @component('admin.components.error')
                                   mobile
                                  @endcomponent
                                </div>
                              </div>
                          </section>
                          <section class="col-12 col-md-6">
                              <div class="form-group">
                                  <label for="profile_photo_path" class="col-sm-6 control-label opt-label-img">پروفایل</label>
                                <div class="">
                                  <input type="file" name="profile_photo_path" class="form-control" value="{{ $user->profile_photo_path ?? '' }}" id="profile_photo_path">
                                  @component('admin.components.error')
                                  profile_photo_path
                                  @endcomponent
                                </div>
                              </div>
                          </section>
                          <section class="col-12">
                            <div class="form-group col-12">
                                @for ($i = 1 ; $i <= 10; $i++)
                                <input type="radio" id="img-pro{{$i}}" class="radio-visibil" name="image_profile" value="images/user-panel-profile-defult/{{$i}}.png">
                                <label for="img-pro{{$i}}" class="control-label img-profile">
                                    <span><img src='{{ asset("images/user-panel-profile-defult/$i.png") }}' alt=""></span>
                                </label>
                                @endfor
                              </div>
                          </section>

                          <section class="col-12">
                          <div class="form-group">
                            <div class="col-sm-offset-2">
                              <button type="submit" class="btn btn-success">تایید</button>
                            </div>
                          </div>
                          </section>
                        </form>
                      </div>
                      <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.img-profile').click(function(){
            $('.img-profile').removeClass('img-profile-active');
            $(this).addClass('img-profile-active');
        });
        if($(window).width() < 510){
            $(".img-profile").addClass('col-5');
        }else{
            $(".img-profile").removeClass('col-5');
        }
    });
</script>
@endsection
