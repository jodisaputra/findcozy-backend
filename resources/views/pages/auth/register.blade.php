@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="card-body register-card-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ route('auth.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="input-group mb-3">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full name" value="{{ old('name') }}">

        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>

        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

      </div>

      <div class="input-group mb-3">
        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}">

        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>

        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">

        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>

        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

      </div>

      <div class="input-group mb-3">
        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Retype password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>

        @error('password_confirmation')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
      </div>

      <div class="input-group mb-3">
        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">

        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-phone"></span>
          </div>
        </div>

        @error('phone_number')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

      </div>

      <div class="input-group mb-3">
        <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" name="profile_photo">

        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-image"></span>
          </div>
        </div>

        @error('profile_photo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror

      </div>

      <div class="input-group mb-3">
        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
            <option value="male" {{ old('gender') == 'male' ? 'selected' : null }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : null }}>Female</option>
        </select>
      </div>

      <div class="row">
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    <a href="{{ url('/') }}" class="text-center">I already have a membership</a>
</div>
@endsection
