<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>FindCozy | @yield('title')</title>

  @stack('style-up')
  @include('includes.style')
  @stack('style-down')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

 {{-- navbar --}}
 @include('includes.navbar')

  @include('includes.sidebar')

  <div class="content-wrapper">
    @include('sweetalert::alert')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  {{-- footer --}}

  @include('includes.footer')

</div>

{{-- js --}}
@stack('script-up')
@include('includes.js')
@stack('script-down')

</body>
</html>
