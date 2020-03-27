@extends('admin.main')
@section('title','Dashboard | ')
@section('content')

<h2><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</h2>
<hr>
  <!-- Icon Cards-->
          <div class="row">
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                	<?php
                      $data = App\User::all();
                    ?>
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-users"></i>
                  </div>
                  <h3 class="mr-5" style="text-align: center;">User</h3>
                  <div class="mr-5" style="text-align: center;"><strong>{{$data->count()}}</strong></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.user')}}">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                <div class="card-body">
                	<?php
                      $data = App\Masakan::all();
                    ?>
                  <div class="card-body-icon">
                    <i class="fas fa-utensils"></i>
                  </div>
                  <h3 class="mr-5" style="text-align: center;">Menu</h3>
                  <div class="mr-5" style="text-align: center;"><strong>{{$data->count()}}</strong></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{ route('admin.masakan')}}">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                	<?php
                      $orders = App\Pemesanan::where('status_pemesanan', 'tunggu')->get();
                    ?>
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                  </div>
                  <h3 class="mr-5" style="text-align: center;">Order</h3>
                  <div class="mr-5" style="text-align: center;"><strong>{{$orders->count()}}</strong></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('admin.entripemesanan')}}">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                <div class="card-body">
                	<?php
                      $data = App\Transaksi::all();
                    ?>
                  <div class="card-body-icon">
                    <i class="fas fa-money-check-alt"></i>
                  </div>
                  <h3 class="mr-5" style="text-align: center;">Transaksi</h3>
                  <div class="mr-5" style="text-align: center;"><strong>{{$data->count()}}</strong></div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="{{route('cashier')}}">
                  <span class="float-left">View Details</span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <a href="{{route('laporan.owner')}}" class="btn btn-danger"><i class="fas fa-print"></i> Cetak Laporan PDF</a>

          


       
@endsection


