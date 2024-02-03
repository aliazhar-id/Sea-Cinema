@extends('dashboard.layouts.main')

@php
  $postCount = 0;
  $totalClick = 0;
  $postRate = $totalClick ? min(100, floor(($totalClick / $postCount) * 0.0485 * 100)) : 0;
  $grade = '-';

  if ($postCount) {
      if ($postRate >= 80) {
          $grade = 'A';
      } elseif ($postRate >= 60) {
          $grade = 'B';
      } elseif ($postRate >= 40) {
          $grade = 'C';
      } elseif ($postRate >= 10) {
          $grade = 'D';
      } else {
          $grade = 'E';
      }
  }

@endphp

@section('content')
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800 text-center">Dashboard</h1>

  <div class="row col-9 mx-auto">
    <!-- Card -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Post</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $postCount }}</div>
            </div>
            <div class="col-auto">
              <i class="far fa-newspaper fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Total Click</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalClick }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-eye fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Post Rate (Click X Post)
              </div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $postRate }}%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $postRate }}%"
                      aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-chart-line fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                GRADE</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $grade }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-medal fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
