@extends('dashboard.layouts.main')

@section('content')
  <div class="col-lg-8 order-lg-12 mx-auto">
    <div class="card shadow mb-2">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
      </div>

      <div class="card-body">
        <div class="card-profile-image mt-1 text-center position-relative">
          <div class="rounded-circle overflow-hidden position-relative mx-auto shadow-lg" style="width: fit-content">
            <img width="180px" height="180px" id="profile-image-preview"
              src="{{ $user->image ? asset('storage/' . $user->image) : '/assets/guest.jpeg' }}">
          </div>
        </div>

        <div class="p-2 mt-2">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-center">
                <h5 class="font-weight-bold">{{ $user->name }}</h5>
                <p class="mb-1">{{ '@' . $user->username }}</p>
                <p>{{ $user->email }}</p>
                <p>{{ ucfirst($user->role) }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Button -->
        <div class="col text-center mb-2">
          <a href="{{ route('dashboard.users.index') }}" class="btn btn-primary mt-3 ">Back</a>
        </div>
      </div>
    </div>
  </div>
@endsection
