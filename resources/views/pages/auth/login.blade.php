@extends('layouts.auth')

@section('title', 'Log In')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="POST">

        @csrf

      <div class="input-group mb-3">
        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email">

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
        <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" name="password">

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

      <div class="row">
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    {{-- <p class="mb-1 mt-2">
      <a href="forgot-password.html">I forgot my password</a>
    </p> --}}
    <p class="mb-1 mt-3">
      <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
    </p>
</div>
@endsection
