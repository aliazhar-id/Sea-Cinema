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

          <form action="" method="GET" autocomplete="off">
            <div class="pl-lg-4">

              <div class="col-lg-8 mx-auto">
                <div class="form-group focused">
                  <label class="form-control-label" for="search">Search movie<span
                      class="small text-danger">*</span></label>
                  <input type="text" id="search" class="form-control" name="search" placeholder="Movie title. . ."
                    value="{{ request('search') }}" required>
                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="pl-lg-4">
              <div class="row">
                <div class="col text-center">
                  <button type="submit" class="btn btn-primary">Search</button>
                </div>
              </div>
            </div>
          </form>

          <div class="pl-lg-4 mt-3 row">
            @if ($movies)
              @foreach ($movies as $movie)
                @php
                  $posterImagePath = isset($movie->poster_path) ? "{$imageBaseURL}/original{$movie->poster_path}" : 'https://source.unsplash.com/film/200x200';
                @endphp

                <div class="card m-1" style="width: 18rem;">
                  <img class="card-img-top" src="{{ $posterImagePath }}" height="200" width="200"
                    alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">{{ $movie->title }}</h5>
                    <p class="card-text text-truncate">{{ isset($movie->tagline) ? $movie->tagline : $movie->overview }}
                    </p>
                    <button class="btn bg-primary text-white" data-toggle="modal" data-target="#addScheduleModal"
                      data-movie="{{ $movie->id }}" data-title="{{ $movie->title }}">
                      Add Schedule
                    </button>
                  </div>
                </div>
              @endforeach




              {{-- <div class="table-responsive col-lg-12 mt-4">
                <table class="table table-striped table-sm" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Id</th>
                      <th scope="col">Title</th>
                      <th scope="col">Popularity</th>
                      <th scope="col" data-orderable="false">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($movies as $movie)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $movie->id }}</td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->popularity * 10 }}</td>
                        <td>
                          <button class="badge bg-primary border-0 text-white" data-toggle="modal"
                            data-target="#showDetailModal" data-movie="{{ $movie->id }}"><span
                              data-feather="eye"></span></button>
                          <button class="badge bg-success border-0 text-white" data-toggle="modal"
                            data-target="#addUpcomingModal" data-movie="{{ $movie->id }}"><span
                              data-feather="plus"></span></button>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div> --}}
            @elseif(!$status)
              <p class="text-center mt-5 mx-auto">No Movies Found :(</p>
            @endif

          </div>

          <!-- Modal -->
          <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addScheduleModalLabel">Movie Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <form action="{{ route('dashboard.schedule.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" id="id-movie" name="id-movie">

                    <div class="row w-full">
                      <div class="col-lg-6">
                        <label for="datepicker" class="form-label">Time</label>
                        <input class="w-full" id="datepicker" name="time" width="234" placeholder="Pick date" />
                        <script>
                          $('#datepicker').datetimepicker({
                            uiLibrary: 'bootstrap4',
                            footer: true,
                            modal: true,
                            format: 'yyyy-mm-dd HH:MM'
                          });
                        </script>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group focused w-full">
                          <label class="form-control-label" for="title">Price</label>
                          <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Price" value="{{ old('price') }}">

                          @error('price')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row w-full">
                      <div class="col-lg-6">
                        <label for="datepicker" class="form-label">Time</label>
                        <input class="w-full" id="datepicker" name="time" width="234" placeholder="Pick date" />
                        <script>
                          $('#datepicker').datetimepicker({
                            uiLibrary: 'bootstrap4',
                            footer: true,
                            modal: true,
                            format: 'yyyy-mm-dd HH:MM'
                          });
                        </script>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group focused w-full">
                          <label class="form-control-label" for="title">Price</label>
                          <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Price" value="{{ old('price') }}">

                          @error('price')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row w-full">
                      <div class="col-lg-6">
                        <label for="datepicker" class="form-label">Time</label>
                        <input class="w-full" id="datepicker" name="time" width="234" placeholder="Pick date" />
                        <script>
                          $('#datepicker').datetimepicker({
                            uiLibrary: 'bootstrap4',
                            footer: true,
                            modal: true,
                            format: 'yyyy-mm-dd HH:MM'
                          });
                        </script>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group focused w-full">
                          <label class="form-control-label" for="title">Price</label>
                          <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Price" value="{{ old('price') }}">

                          @error('price')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row w-full">
                      <div class="col-lg-6">
                        <label for="datepicker" class="form-label">Time</label>
                        <input class="w-full" id="datepicker" name="time" width="234" placeholder="Pick date" />
                        <script>
                          $('#datepicker').datetimepicker({
                            uiLibrary: 'bootstrap4',
                            footer: true,
                            modal: true,
                            format: 'yyyy-mm-dd HH:MM'
                          });
                        </script>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group focused w-full">
                          <label class="form-control-label" for="title">Price</label>
                          <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Price" value="{{ old('price') }}">

                          @error('price')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
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

        </div>

      </div>

    </div>
  </div>
@endsection

@section('custom-script')
  <script>
    $('#addScheduleModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const id = button.data('movie');
      const title = button.data('title');
      // const modal = $(this);

      $('#id-movie').val(id);
      $('#addScheduleModalLabel').html(title);
    })
  </script>
@endsection
