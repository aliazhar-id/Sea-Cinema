@extends('dashboard.layouts.main')

@section('custom-head')
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-auto">Create New Schedule</h1>
  </div>

  <div class="row">
    <div class="col-lg-10 order-lg-1 mx-auto">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">New Schedule</h6>
        </div>

        <div class="card-body">

            <form action="{{ route('dashboard.schedule.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="category" class="form-label">Movie<span class="small text-danger">*</span></label>
                    <select class="form-control" name="id_movie">
                      @foreach ($movies as $movie)
                        <option value="{{ $movie->id_movie }}">{{ $movie->title }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-lg-3">
                  <label for="datepicker" class="form-label">Time<span class="small text-danger">*</span></label>
                  <input class="w-full" id="datepicker" name="time" width="234"/>
                  <script>
                    $('#datepicker').datetimepicker({
                      uiLibrary: 'bootstrap4',
                      footer: true,
                      format: 'yyyy-mm-dd HH:MM'
                    });
                  </script>
                </div>

                <div class="col-lg-3">
                  <div class="form-group focused w-full">
                    <label class="form-control-label" for="title">Price</label>
                    <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
                      name="price" placeholder="ex: How to create blog with Laravel 10" value="{{ old('price') }}">

                    @error('price')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="pl-lg-4">
              <div class="row">
                <div class="col text-center">
                  <button type="submit" class="btn btn-primary">Create Schedule</button>
                </div>
              </div>
            </div>
          </form>

        </div>

      </div>

    </div>
  </div>
@endsection

@section('custom-script')
@endsection
