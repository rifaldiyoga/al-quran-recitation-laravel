<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Asul:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('frontend/libraries/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('frontend/styles/main.css')}}">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a href="#" class="navbar-brand">
            <img src="frontend/images/logo.png" alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
            data-bs-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
            <ul class="navbar-nav ms-auto mr-3">
                <li class="nav-item mx-md-2 me-6"><a href="" class="nav-link active">Dashboard</a></li>
                <li class="nav-item mx-md-2"><a href="" class="nav-link">Quran</a></li>
                <li class="nav-item mx-md-2"><a href="" class="nav-link">Grup Ngaji</a></li>

                <!-- Mobile Button -->
                <from class="from-inline d-sm-block d-md-none">
                    <button class="btn btn-login my-2 my-sm-0 px-4">
                        Masuk
                    </button>
                </from>

                <!-- Desktop button -->
                <from class="from-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4">
                        Masuk
                    </button>
                </from>
                <from class="from-inline my-2 my-lg-0 d-none d-md-block">
                    <button class="btn btn-navbar-right btn-register my-2 my-sm-0 px-4">
                        Daftar
                    </button>
                </from>
            </ul>
        </div>
    </nav>
    
    @yield('content')

    <footer class="text-center p-4 mt-5">
        © 2021, Ngaji Yuk!. All Rights Reserved. Powered by Kopi Tech Anget.
    </footer>

    <script src="{{url('frontend/libraries/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{url('frontend/libraries/jquery/jquery-3.6.0.min.js')}}"></script>
</body>

</html>