@extends('dashboard.layouts.main')

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
                Upcomings
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $upcomings->count() }}</div>
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
                Movie Scheduled
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $schedules->count() }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-eye fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Card -->
    <div class="col-xl-12 col-md-12 mb-8">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                Users
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
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
