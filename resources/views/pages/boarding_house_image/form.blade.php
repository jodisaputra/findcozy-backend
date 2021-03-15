@extends('layouts.main')

@section('title', 'Boarding House Image')

@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ $title }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div>
</div>

<div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="boardinghouse_id" value="{{ $boardinghouse_id }}">

                        @if ($type == 'edit')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                            @if ($type == 'edit')
                                <a href="{{ Storage::url($image) }}" target="_BLANK">See Image</a>
                            @endif

                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('boardinghouseimage.index', $boardinghouse_id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go Back</a>

                    </form>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
