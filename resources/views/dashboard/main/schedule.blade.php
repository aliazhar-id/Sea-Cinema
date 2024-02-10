@extends('dashboard.layouts.main')

@section('custom-head')
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.css" rel="stylesheet">

  <style>
    table.dataTable thead>tr>th {
      padding-left: 30px !important;
      padding-right: initial !important;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting::before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after {
      left: 8px !important;
      right: auto !important;
    }
  </style>
@endsection

@section('content')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Scheduled Movie</h1>
  </div>

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

  <div class="col-lg-12">
    <a href="{{ route('dashboard.schedule.create') }}" class="btn btn-primary mb-3 mx-">New Schedule</a>
  </div>

  @if ($schedules->count())
    <div class="table-responsive col-lg-12 mt-4">
      <table class="table table-striped table-sm" id="dataTable">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Id Movie</th>
            <th scope="col">Title</th>
            <th scope="col">Date</th>
            <th scope="col">Start At</th>
            <th scope="col">Price</th>

            <th scope="col" data-orderable="false">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($schedules as $sch)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $sch->id_movie }}</td>
              <td>
                <a href="{{ route('main.movie.details', $sch->id_movie) }}" target="_blank">{{ $sch->movie->title }}</a>
              </td>
              <td>{{ $sch->date }}</td>
              <td>{{ $sch->start_at }}</td>
              <td>Rp{{ $sch->price }}</td>
              <td>
                <a href="{{ route('main.movie.details', $sch->id_movie) }}" target="_blank"
                  class="badge bg-primary text-white">
                  <span data-feather="eye"></span>
                </a>

                <button class="badge badge-warning border-0 text-white" data-toggle="modal"
                  data-target="#editScheduleModal" data-schedule="{{ $sch->id_schedule }}"
                  data-title="{{ $sch->movie->title }}"
                  data-datetime="{{ date('Y/m/d', strtotime($sch->date)) . ' ' . $sch->start_at }}"
                  data-price="{{ $sch->price }}">

                  <span data-feather="edit"></span>

                </button>

                <button class="badge bg-danger border-0 text-white" data-toggle="modal" data-target="#deleteMovieModal"
                  data-schedule="{{ $sch->id_schedule }}" data-movie="{{ $sch->id_movie }}"
                  data-title="{{ $sch->movie->title }}" data-date="{{ $sch->date }}"
                  data-start="{{ $sch->start_at }}" data-price="{{ $sch->price }}">

                  <span data-feather="x-circle"></span>

                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Modal Edit Schedule -->
    <div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editScheduleModalLabel">Movie Detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="{{ route('dashboard.schedule.update') }}" method="POST" autocomplete="off">
              @csrf
              <input type="hidden" id="id-schedule" name="id-schedule">

              <div class="row w-full" id="list-movie">
                <div class="col-lg-6">
                  <div class="form-group w-full">
                    <label for="datepicker" class="form-control-label">Time</label>
                    <input id="datepicker" class="form-control w-full @error('datetime') is-invalid @enderror"
                      name="datetime" placeholder="Pick date">

                    @error('datetime')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group focused w-full">
                    <label class="form-control-label" for="title">Price (Rp)</label>
                    <input type="number" id="price" class="form-control @error('price') is-invalid @enderror"
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
              <div class="pl-lg-4 mt-3">
                <div class="row">
                  <div class="col text-center">
                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                  </div>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <!-- Delete Movie Modal-->
    <div class="modal fade" id="deleteMovieModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete this schedule?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <span class="d-block">Id Movie: <span id="delete-id"></span></span>
            <span class="d-block">Title: <span id="delete-title"></span></span>
            <span class="d-block">Date: <span id="delete-date"></span></span>
            <span class="d-block">Start At: <span id="delete-start"></span></span>
            <span class="d-block mb-3">Price: <span id="delete-price"></span></span>

            <p>Select "DELETE" below if you are ready to delete this Schedule!.</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="{{ route('dashboard.schedule.destroy') }}" method="POST" id='deleteForm'>
              @csrf
              <input type="hidden" id="delete-id-schedule" name="id-schedule">
              <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i> DELETE
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @else
    <p class="text-center mt-5 h2">No movies schedule found :(</p>
  @endif
@endsection

@section('custom-script')
  <script src="https://cdn.datatables.net/v/bs4/dt-1.13.8/datatables.min.js"></script>
  <script>
    $('#dataTable').dataTable({
      info: false,
      searching: false,
      preDrawCallback: function(settings) {
        const api = new $.fn.dataTable.Api(settings);
        const pagination = $(this)
          .closest('.dataTables_wrapper')
          .find('.dataTables_paginate');

        const entriesCount = $(this)
          .closest('.dataTables_wrapper')
          .find('.dataTables_length');

        pagination.toggle(api.page.info().pages > 1);
        entriesCount.toggle(api.page.info().pages > 1);
      }
    });
  </script>

  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
  <script>
    $('#editScheduleModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const id_schedule = button.data('schedule');
      const title = button.data('title');
      const datetime = button.data('datetime');
      const price = button.data('price');

      $('#datepicker').datetimepicker({
        uiLibrary: 'bootstrap4',
        footer: true,
        modal: true,
        format: 'yyyy-mm-dd HH:MM',
        value: datetime,
      });

      $('#id-schedule').val(id_schedule);
      $('#price').val(price);
      $('#editScheduleModalLabel').html(title);
    })

    $('#deleteMovieModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const id_movie = button.data('movie');
      const title = button.data('title');
      const date = button.data('date');
      const start_at = button.data('start');
      const price = button.data('price');
      const id_schedule = button.data('schedule');

      $('#delete-id').html(id_movie);
      $('#delete-title').html(title);
      $('#delete-date').html(date);
      $('#delete-start').html(start_at);
      $('#delete-price').html('Rp' + price);

      $('#delete-id-schedule').val(id_schedule);
    })
  </script>
@endsection
