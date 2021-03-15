@extends('layouts.main')

@section('title', 'Boarding House')

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

                        @if ($type == 'edit')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" value="{{ $name }}" class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Address *</label>
                            <input type="text" name="address" value="{{ $address }}" class="form-control @error('address') is-invalid @enderror">

                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>City *</label>
                            <input type="text" name="city" value="{{ $city }}" class="form-control @error('city') is-invalid @enderror">

                            @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Map url <small>Optional</small></label>
                            <input type="text" name="map_url" value="{{ $map_url }}" class="form-control @error('map_url') is-invalid @enderror">

                            @error('map_url')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Business License</label>
                            <input type="file" class="form-control @error('license') is-invalid @enderror" name="license">

                            @if ($tipe = 'edit')
                                <a href="{{ Storage::url($license) }}" class="mt-2" target="_BLANK">See Document</a>
                            @endif

                            @error('license')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('boardinghouse.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Go Back</a>

                    </form>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
