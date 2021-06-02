<!--====== HEADER PART START ======-->
<div class="navbar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ url('frontend/images/logo.svg') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class=" navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="page-scroll" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll" href="{{ route('surah') }}">Quran</a>
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll" href="{{ route('grup.index') }}">Grup Ngaji</a>
                            </li>
                        </ul>
                    </div> <!-- navbar collapse -->
                    @guest
                        <div class="navbar-btn d-none d-sm-inline-block">
                            <a class="main-btn" data-scroll-nav="0" href="{{ route('login') }}">Masuk</a>
                        </div>
                    @endguest

                    @auth
                        <!-- Sidebar Toggle (Topbar) -->
                        <form action="{{ url('logout') }}" method="post">
                            @csrf
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->first_name}}</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{url('backend/img/undraw_profile.svg')}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <button>Logout</button>
                                </div>
                            </li>
                        </form>
                        

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <img src="{{ url('frontend/images/person.jpg') }}" alt="..." class="rounded-circle border" style="height: 50px; ">
                        </div>
                    @endauth
                    
                </nav> <!-- navbar -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div> <!-- navbar area -->


<!--====== HEADER PART ENDS ======-->