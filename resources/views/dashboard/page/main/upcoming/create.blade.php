@extends('dashboard.layouts.main')

@section('custom-head')
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
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-auto">Upcoming</h1>
  </div>

  <div class="row">
    <div class="col-lg-10 order-lg-1 mx-auto">

      <div class="card shadow mb-4">

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">New Upcoming</h6>
        </div>

        <div class="card-body">

          <div class="col">

            <form action="{{ route('dashboard.upcoming.create') }}" method="GET" autocomplete="off">
              <div class="pl-lg-4">

                <div class="col-lg-8 mx-auto">
                  <div class="form-group focused">
                    <label class="form-control-label" for="search">Search movie<span
                        class="small text-danger">*</span></label>
                    <input type="text" id="search" class="form-control" name="search"
                      placeholder="Movie title. . ." value="{{ request('search') }}" required>
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
                <div class="table-responsive col-lg-12 mt-4">
                  <table class="table table-striped table-sm" id="dataTable">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Id Movie</th>
                        <th scope="col">Title</th>
                        <th scope="col">Year</th>
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
                          <td>{{ date('Y', strtotime($movie->release_date)) }}</td>
                          <td>{{ $movie->popularity * 10 }}</td>
                          <td>
                            <button class="badge bg-primary border-0 text-white" data-toggle="modal"
                              data-target="#showDetailModal" data-poster="{{ $movie->poster_path }}">

                              <span data-feather="eye"></span>

                            </button>

                            <button class="badge bg-success border-0 text-white" data-toggle="modal"
                              data-target="#addUpcomingModal" data-movie="{{ $movie->id }}"
                              data-title="{{ $movie->title }}">

                              <span data-feather="plus"></span>

                            </button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @elseif(Request::get('search'))
                <p class="text-center mt-5 mx-auto">No movies found with title: {{ Request::get('search') }} :(</p>
              @endif

            </div>

            <!-- Modal Show Movie Detail -->
            <div class="modal fade" id="showDetailModal" tabindex="-1" aria-labelledby="showDetailModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="showDetailModalLabel">Movie Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body text-center">
                    <img id="poster" class="img-fluid" width="300" alt="Movie Poster">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal Add Movie Upcoming -->
            <div class="modal fade" id="addUpcomingModal" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure want to add Upcoming?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span class="d-block">Id Movie: <span id="add-id"></span></span>
                    <span class="d-block mb-3">Title: <span id="add-title"></span></span>

                    <p>Select "ADD" below if you are ready to add this movie to upcoming.</p>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id='deleteForm' action="{{ route('dashboard.upcoming.store') }}">
                      @csrf
                      <input type="hidden" id="id-movie" name="id-movie">
                      <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> ADD
                      </button>
                    </form>
                  </div>
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
    $('#showDetailModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const poster_path = button.data('poster');
      const modal = $(this);

      $('#poster').attr('src', "{{ $imageBaseURL . '/original' }}" + poster_path)
    });

    $('#addUpcomingModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const id_movie = button.data('movie');
      const title = button.data('title');

      $('#add-id').html(id_movie);
      $('#add-title').html(title);

      $('#id-movie').val(id_movie);
    });
  </script>

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

    $('#myModal').on('hidden.bs.modal', function(event) {
      // do something...
    })
  </script>
@endsection
