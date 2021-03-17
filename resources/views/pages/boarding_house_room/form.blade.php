@extends('layouts.main')

@section('title', 'Boarding House Room')

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
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $name }}">

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="available" {{ $status == 'available' ? 'selected' : null }}>Available</option>
                                <option value="not_available" {{ $status == 'not_available' ? 'selected' : null }}>Not Available</option>
                            </select>

                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $price }}">

                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('boardinghouseroom.index', $boardinghouse_id) }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go Back</a>

                    </form>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
