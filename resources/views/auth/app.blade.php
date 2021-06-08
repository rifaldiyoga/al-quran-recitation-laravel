<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ngaji Yuk! - @yield('title')</title>

    <link rel="stylesheet" href="{{url ('frontend/css/font-awesome.min.css') }}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('logins/main.css') }}">


</head>

<body>
    <!-- Navbar-->
    @yield('content')

</body>

<!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script src="{{ url('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>

<link href="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="https://repo.rachmat.id/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://repo.rachmat.id/jquery-ui-1.12.1/jquery-ui.js"></script>
<script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>



<script type="text/javascript">
	$(function(){
	  $("#birth_date").datepicker();
	});
</script>


</html>