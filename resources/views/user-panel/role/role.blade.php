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

            <div class="row">
                <div class="d-flex flex-wrap col-12">

                    @foreach ($roles as $role)
                    <span class="col-12 col-md-6">
                    <div class="small-box mafia-info-item @if($role->side == 0)
                        back-citizen
                        @elseif($role->side == 1)
                        back-mafia
                        @elseif($role->side == 2)
                        back-independent
                        @endif">
                        <div class="d-flex justify-content-between">
                            <h5 class="mt-2 mr-2">{{ $role->name }}</h5>
                            <p class="mt-2 ml-2">
                                @if ($role->side == 0)
                                <span class="badge badge-light">شهروند</span>
                                @elseif($role->side == 1)
                                <span class="badge badge-light">مافیا</span>
                                @elseif($role->side == 2)
                                <span class="badge badge-light">مستقل</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="font-size-14 font-weight-light">{!! $role->description !!}</p>
                        </div>
                    </div>
                    </span>
                    @endforeach

                </div>
            </div>

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

