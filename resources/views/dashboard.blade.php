@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
  
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Large box on top -->
          <div class="row justify-content-center"> 
            <div class="col-12">
              <div class="small-box bg-primary p-4">
                <div class="inner">
                  <h3>Dashboard</h3>
                  <p>Aplikasi Manajemen Kelas</p>
             
                </div>
                <div class="icon">
                  <i class="ion ion-ios-analytics"></i>
                </div>
              </div>
            </div>
          </div>

          <!-- Two small boxes below -->
          <div class="row justify-content-center">
            <div class="col-md-4">
              <!-- Small box 1 -->
              <div class="small-box bg-danger p-4">
                <div class="inner">
                  <h3>jumlah Siswa</h3>
                  <h3>{{$studentCount}}</h3>
                  
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>

                </div>
                <a href="{{route('students.index')}}" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>

              </div>
            </div>
            
            <div class="col-md-4">
              <!-- Small box 2 -->
              <div class="small-box bg-warning p-4">
                <div class="inner">
                  <h3>Jumlah Absensi</h3>
                  <h3>{{$attendanceCount}}</h3>                  
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('attendance.index')}}" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-md-4">
                <!-- Small box 2 -->
                <div class="small-box bg-success p-4">
                  <div class="inner">
                    <h3>Jumlah Uang Kas</h3>
                    <h3>Rp. {{$classCashFundCount}}</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{route('classCashFund.index')}}" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
          </div>

        </div>
    </section>
@endsection
