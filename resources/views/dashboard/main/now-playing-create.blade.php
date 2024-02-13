@extends('dashboard.layouts.main')

@section('custom-head')
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-auto">Create New Now Playing</h1>
  </div>

  <div class="row">
    <div class="col-lg-10 order-lg-1 mx-auto">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">New Now Playing</h6>
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
                    <button class="btn bg-primary text-white" data-toggle="modal" data-target="#addNowPlayingModal"
                      data-movie="{{ $movie->id }}" data-title="{{ $movie->title }}">
                      Add Now Playing
                    </button>
                  </div>
                </div>
              @endforeach
            @elseif(!$status)
              <p class="text-center mt-5 mx-auto">No Movies Found :(</p>
            @endif

          </div>

          <!-- Modal Add Schedule -->
          <div class="modal fade" id="addNowPlayingModal" tabindex="-1" aria-labelledby="addNowPlayingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNowPlayingModalLabel">Movie Detail</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

                  <form action="{{ route('dashboard.nowplaying.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" id="id-movie" name="id-movie">

                    <div class="row w-full" id="list-movie">
                      <div class="col-lg-6">
                        <div class="form-group w-full">
                          <label for="datepicker" class="form-control-label">Time</label>
                          <input class="form-control w-full datepicker @error('price') is-invalid @enderror"
                            name="datetime[]" placeholder="Pick date">

                          @error('datetime')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group focused w-full">
                          <label class="form-control-label" for="title">Price</label>
                          <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
                            name="price[]" placeholder="Price" value="{{ old('price') }}">

                          @error('price')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="row d-flex justify-content-end pr-2">
                      <button id="btn-more" type="button" class="btn btn-primary">More</button>
                    </div>

                    <!-- Button -->
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col text-center">
                          <button type="submit" class="btn btn-primary">Create Now Playing</button>
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
  <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

  <script>
    const loadElementPicker = () => {
      $('.datepicker').each((i, el) => {

        console.log(el);

        $(el).datetimepicker({
          uiLibrary: 'bootstrap4',
          footer: true,
          modal: true,
          format: 'yyyy-mm-dd HH:MM'
        });
      })
    }

    loadElementPicker();

    $('#btn-more').on('click', () => {
      const inputElement = `
        <div class="col-lg-6">
          <div class="form-group w-full">
            <label for="datepicker" class="form-control-label">Time</label>
            <input class="form-control w-full datepicker @error('price') is-invalid @enderror"
              name="datetime[]" placeholder="Pick date">

            @error('datetime')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group focused w-full">
            <label class="form-control-label" for="title">Price</label>
            <input type="number" id="title" class="form-control @error('price') is-invalid @enderror"
              name="price[]" placeholder="Price" value="{{ old('price') }}">

            @error('price')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>`;

      $('#list-movie').append(inputElement);
      loadElementPicker();
    });

    $('#addNowPlayingModal').on('show.bs.modal', function(event) {
      const button = $(event.relatedTarget)
      const id = button.data('movie');
      const title = button.data('title');

      $('#id-movie').val(id);
      $('#addNowPlayingModalLabel').html(title);
    })
  </script>
@endsection
