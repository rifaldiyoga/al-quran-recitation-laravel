<nav class="navbar navbar-expand-lg navbar-light">
    <a href="#" class="navbar-brand">
        <img src="frontend/images/logo.png" alt="">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navb">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navb">
        <ul class="navbar-nav ms-auto mr-3">
            <li class="nav-item mx-md-2 me-6"><a href="{{ route('home') }}" class="nav-link active">Dashboard</a></li>
            <li class="nav-item mx-md-2"><a href="{{ route('surah') }}" class="nav-link">Quran</a></li>
            <li class="nav-item mx-md-2"><a href="" class="nav-link">Grup Ngaji</a></li>
            @guest
            <!-- Mobile Button -->
            <from class="from-inline d-sm-block d-md-none">
            
                <button class="btn btn-login my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Masuk
                </button>
            </from>

            <!-- Desktop button -->

            <from class="from-inline my-2 my-lg-0 d-none d-md-block">
            
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Masuk
                </button>
            </from>

            <from class="from-inline my-2 my-lg-0 d-none d-md-block">
                <button class="btn btn-navbar-right btn-register my-2 my-sm-0 px-4">
                    Daftar
                </button>
            </from>
            @endguest

            @auth
            <from class="from-inline d-sm-block d-md-none" action="{{ url('logout')}}" method="POST">
                @csrf
                <button class="btn btn-login my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Keluar
                </button>
            </from>

            <!-- Desktop button -->

            <from class="from-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout')}}" method="POST">
            @csrf
                <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" onclick="event.preventDefault(); location.href='{{url('login')}}';">
                    Keluar
                </button>
            </from>
            @endauth

            
        </ul>
    </div>
</nav>
