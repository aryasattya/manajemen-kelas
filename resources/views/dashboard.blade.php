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
                  <h3>jumlah transaksi</h3>
                  <p>Satya Arya</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div>
            
            <div class="col-md-4">
              <!-- Small box 2 -->
              <div class="small-box bg-warning p-4">
                <div class="inner">
                  <h3>Jumlah Transaksi</h3>
                  <p></p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-md-4">
                <!-- Small box 2 -->
                <div class="small-box bg-success p-4">
                  <div class="inner">
                    <h3>Jumlah Transaksi</h3>
                    <p></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="" class="small-box-footer">Details <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
          </div>

        </div>
    </section>
@endsection
