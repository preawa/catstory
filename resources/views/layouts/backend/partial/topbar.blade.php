 <nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ route('home') }}">WEBSITE-CATSTORY</a>
        </div>
    </div>
</nav> 

<header>
    <div class="container-fluid position-relative no-side-padding">

        <a href="#" class="logo"><img src="{{ asset('assets/frontend/images/logo-cat.png') }}" width="60" height="60"
                alt="Logo Image"></a>

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="{{ route('home') }}">Home</a></li>
            {{-- <li><a href="{{ route('post.index') }}">Posts</a></li>
            --}}


            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                @if (Auth::user()->role->id == 1)
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('chat') }}">Chat</a></li>

                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();"
                            data-toggle="tab">
                            LogOut
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                @endif
                @if (Auth::user()->role->id == 2)
                    <li><a href="{{ route('author.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('chat') }}">Chat</a></li>
                    <li><a href="{{ route('map') }}">MapCat</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();"
                            data-toggle="tab">
                            LogOut
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            @endguest

        </ul><!-- main-menu -->


        <div class="src-area">
            <form method="GET" action="{{ route('search') }}">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" value="{{ isset($query) ? $query : '' }}" name="query" type="text"
                    placeholder="Search">
            </form>
        </div>


    </div><!-- conatiner -->
</header>