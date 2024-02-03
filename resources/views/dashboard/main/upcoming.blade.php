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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upcoming Movie</h1>

    <form action="" {{-- <form action="{{ route('posts.index') }}" --}}
      class="d-none d-sm-inline-block form-inline mr-auto ml-md-4 my-2 my-md-0 mw-100 navbar-search">
      @if (request('title'))
        <input type="hidden" name="title" value="{{ request('title') }}">
      @endif

      <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-white border-1 small"
          placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>

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
    <a href="{{ route('dashboard.upcoming.create') }}" class="btn btn-primary mb-3 mx-">Create new Upcoming</a>
  </div>

  @if ($movies->count())
    <div class="table-responsive col-lg-12 mt-4">
      <table class="table table-striped table-sm" id="dataTable">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Rating</th>
            <th scope="col" data-orderable="false">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($movies as $movie)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $movie->title }}</td>
              <td>{{ $movie->price }}</td>
              <td>{{ $movie->rating }}</td>
              <td>
                <a href="" class="badge bg-primary"><span {{-- <a href="{{ route('posts.show', $movie->slug) }}" class="badge bg-primary"><span --}} data-feather="eye"></span>
                </a>
                <a href="" class="badge bg-warning"><span {{-- <a href="{{ route('posts.edit', $movie->slug) }}" class="badge bg-warning"><span --}} data-feather="edit"></span>
                </a>
                <button class="badge bg-danger border-0 text-info" data-toggle="modal" data-target="#deleteMovieModal"
                  data-movie="{{ $movie->slug }}"><span data-feather="x-circle"></span></button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <!-- Delete Movie Modal-->
    <div class="modal fade" id="deleteMovieModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure want to delete</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "DELETE" below if you are ready to delete this Scheduled.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" id='deleteForm'>
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-danger">
                <i class="far fa-trash-alt"></i> DELETE
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @else
    <p class="text-center mt-5">No Movies Upcoming Found :(</p>
  @endif
@endsection

{{-- modal.find('form').attr('action', `{{ route('posts.destroy', '') }}/${movie}`); --}}
@section('custom-script')
  <script>
    $('#deleteMovieModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const movie = button.data('movie');
      const modal = $(this);

      modal.find('form').attr('action', `/${movie}`);
    })
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
  </script>
@endsection
