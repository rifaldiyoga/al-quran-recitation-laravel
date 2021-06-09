<!--====== HEADER PART START ======-->
<div class="navbar-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <h3 style="
                            background: linear-gradient(to right, #5433c8 0%, #119bd2 50%, #33c8c1 100%);
                                background-clip: border-box;
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                        ">Ngaji Yuk!</h3>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class=" navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="page-scroll {{ Str::contains(Request::route()->getName(), 'home') || Str::contains(Request::route()->getName(), 'dashboard') ? 'active' : ''  }}" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll {{ Str::contains(Request::route()->getName(), 'surah') ? 'active' : ''  }}" href="{{ route('surah') }}">Quran</a>
                            </li>
                            <li class="nav-item">
                                <a class="page-scroll {{ Str::contains(Request::route()->getName(), 'grup') ? 'active' : ''  }}" href="{{ route('grup.index') }}">Grup Ngaji</a>
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
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown no-arrow">
                                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="mr-2 d-none d-lg-inline text-gray-600">{{Auth::user()->last_name}}</span>
                                        <img class="img-profile rounded-circle"
                                            src="{{url('backend/img/undraw_profile.svg')}}" style="max-width: 30px;">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                        aria-labelledby="userDropdown"> 
                                        <a class="dropdown-item" href="{{ route('kemajuan-belajar') }}">
                                            <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Riwayat Membaca
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="$(this).closest('form').submit()">
                                            <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            
                        </form>
                    
                    @endauth
                    
                </nav> <!-- navbar -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div> <!-- navbar area -->


<!--====== HEADER PART ENDS ======-->