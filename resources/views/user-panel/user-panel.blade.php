@extends('user-panel.layouts.master')

@section('head-tag')
<title>پنل کاربری</title>
@endsection

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">داشبورد </h1>
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

        <div class="row col-12 col-md-8 float-right">
             <!-- /.card -->

             <div class="card col-12">
              <div class="card-header">
                <h3 class="card-title">5 بازیکن برتر</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>
                        <span>آواتار</span>
                        <span class="mt-2 mr-4">نام</span>
                    </th>
                    <th class="float-left">(W/L)</th>
                  </tr>
                  @foreach ($vtPlayers as $vtPlayer)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td >
                        <span class="d-flex">
                            @if ($vtPlayer->profile_photo_path !=  null)
                        <img src="{{ asset($vtPlayer->profile_photo_path) }}" alt="" class="img-radius-custom">
                        @else
                        <i class="fa fa-user-circle-o img-radius-custom font-size-37px"></i>
                        @endif
                        <span class="mt-2 mr-3">{{ $vtPlayer->name }}</span>
                        </span>
                    </td>
                    <td class="float-left">{{ number_format((float)$vtPlayer->vt, 2, '.', '') }}</td>
                  </tr>
                  @endforeach

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <!-- /.row -->
        <div class="col-12 col-md-4 float-left">
            <div>
                {{-- <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">نوار پیشرفت</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">

                    <div class="progress">
                      <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                           aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                        <span class="sr-only">40% Complete (success)</span>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div> --}}
                <!-- /.card -->

              </div>
              {{-- Notification --}}
              <div>
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-bullhorn"></i>
                      اعلانات
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  @foreach ($notifications as $notification)
                  <div class="card-body">
                    <div class="callout callout-info">
                      <h5>{{ $notification->title }}</h5>
                      <p>{!! $notification->body !!}</p>
                    </div>
                  </div>
                  @endforeach

                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
        </div>
  </div>
  <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    @endsection
