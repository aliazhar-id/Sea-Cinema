@extends('dashboard.layouts.main')

@section('content')
  @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @elseif(session('error'))
    <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  <form action="{{ route('admin.users.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf

    <div class="row">
      <div class="col-lg-4 order-lg-2">
        <div class="card shadow py-5">
          <div class="card-profile-image text-center position-relative">
            <div class="mb-3">Profile Image</div>
            <div class="rounded-circle overflow-hidden position-relative mx-auto shadow-lg" style="width: fit-content">
              <img width="180px" height="180px" id="profile-image-preview" src="/assets/guest.jpeg">
              <div class="profile-image-group position-absolute text-center pt-1">
                <input class="d-none" type="file" id="profile-image-input" name="image" />
                <label for="profile-image-input" style="width:100%">
                  <i class="fas fa-2x text-gray-300 fa-camera"></i>
                </label>
              </div>
            </div>
            @error('image')
              <p class="text-danger mt-2 mb-0">
                {{ $message }}
              </p>
            @enderror
          </div>
        </div>

      </div>

      <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">

          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create User</h6>
          </div>

          <div class="card-body">
            <h6 class="heading-small text-muted mb-4">User information</h6>

            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="username">
                      Username<span class="small text-danger">*</span>
                    </label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                      name="username" placeholder="Username" value="{{ old('username') }}">

                    @error('username')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group focused">
                    <label class="form-control-label" for="name">
                      Name<span class="small text-danger">*</span>
                    </label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                      name="name" placeholder="Name" value="{{ old('name') }}">

                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="email">
                      Email address<span class="small text-danger">*</span>
                    </label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                      name="email" placeholder="example@example.com" value="{{ old('email') }}">

                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="password">
                      Password<span class="small text-danger">*</span>
                    </label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                      name="password" placeholder="Password">

                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group focused">
                    <label class="form-control-label" for="confirm_password">
                      Confirm password<span class="small text-danger">*</span>
                    </label>
                    <input type="password" id="confirm_password"
                      class="form-control @error('password_confirmation') is-invalid @enderror"
                      name="password_confirmation" placeholder="Confirm password">
                    @error('password_confirmation')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="pl-lg-4">
              <div class="row">
                <div class="col text-center">
                  <button type="submit" class="btn btn-primary mt-3">Create User</button>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
  </form>
@endsection

@section('custom-script')
  <script>
    const profileImagePreview = document.querySelector('#profile-image-preview');
    const profileImageInput = document.querySelector('#profile-image-input');

    profileImageInput.addEventListener('change', () => {
      const oFReader = new FileReader();
      oFReader.readAsDataURL(profileImageInput.files[0]);

      oFReader.addEventListener('load', (e) => {
        profileImagePreview.src = e.target.result;
      })

    });
  </script>
@endsection
