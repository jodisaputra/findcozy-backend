@extends('layouts.auth')

@section('title', 'Log In')

@section('content')
<div class="card-body login-card-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="POST">

        @csrf

      <div class="input-group mb-3">
        <input type="email" class="form-control" placeholder="Email">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3">
        <input type="password" class="form-control" placeholder="Password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
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
