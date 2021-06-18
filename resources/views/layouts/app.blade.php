<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Ngaji Yuk! - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('includes.style')

</head>

<body>
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->
    @include('includes.navbar')


    <div style="min-height: 60vh">
      @yield('content')
    </div>

    @include('includes.footer')
  

</body>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>

@include('includes.script')

@yield('script')

</html>
