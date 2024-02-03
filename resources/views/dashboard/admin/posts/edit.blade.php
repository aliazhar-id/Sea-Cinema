@extends('dashboard.layouts.main')

@section('content')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 mx-auto">Edit Post</h1>
  </div>

  <div class="row">
    <div class="col-lg-10 order-lg-1 mx-auto">

      <div class="card shadow mb-4">

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Edit Post</h6>
        </div>

        <div class="card-body">

          <form action="{{ route('admin.posts.update', $post->slug) }}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="pl-lg-4">
              @if (session('error'))
                <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group focused">
                    <label class="form-control-label" for="title">Title</label>
                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                      name="title" placeholder="ex: How to create blog with Laravel 10"
                      value="{{ old('title', $post->title) }}">

                    @error('title')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" name="id_category">
                      @foreach ($categories as $category)
                        @if (old('id_category', $post->id_category) == $category->id_category)
                          <option value="{{ $category->id_category }}" selected>{{ $category->name }}</option>
                        @else
                          <option value="{{ $category->id_category }}">{{ $category->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="mb-1">Image <small><i>( Maks. 2 MB )</i></small></div>

                  @if ($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}"
                      class="image-banner-preview img-fluid img-thumbnail mb-2" alt="" style="max-height: 200px">
                  @else
                    <img class="d-none image-banner-preview img-fluid img-thumbnail mb-2" alt=""
                      style="max-height: 200px">
                  @endif

                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image-banner-input" name="image">
                    <label class="custom-file-label" for="image-banner-input">Choose file</label>
                  </div>

                  @error('image')
                    <p class="text-danger mt-2 mb-0">{{ $message }}</p>
                  @enderror &nbsp;
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-lg-12">
                  <label for="body" class="form-label">Body</label>
                  <textarea name="body">{{ old('body', $post->body) }}</textarea>

                  @error('body')
                    <p class="text-danger">{{ $message }}</p>
                  @enderror

                </div>
              </div>
            </div>

            <!-- Button -->
            <div class="pl-lg-4">
              <div class="row">
                <div class="col text-center">
                  <button type="submit" class="btn btn-primary">Update Post</button>
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
  <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

  <script>
    CKEDITOR.replace('body', {
      language: 'en',
    });
  </script>

  <script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    const bannerPreview = document.querySelector('.image-banner-preview');
    const bannerInput = document.querySelector('#image-banner-input');

    bannerInput.addEventListener('change', () => {
      const oFReader = new FileReader();
      oFReader.readAsDataURL(bannerInput.files[0]);

      oFReader.addEventListener('load', (e) => {
        bannerPreview.src = e.target.result;
        bannerPreview.classList.remove('d-none');
      })
    });
  </script>
@endsection
