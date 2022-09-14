<header style="background-color: #fff3e0;">
    <div class="container-fluid position-relative no-side-padding">
        
        {{-- <a href="#" class="logo" ><img src="{{ asset('assets/frontend/images/logo.png') }}"  width="80" height="80" alt=""></a> --}}

        <div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

        <ul class="main-menu visible-on-click" id="main-menu">
            <li><a href="#"><img src="{{ asset('assets/frontend/images/CATLOGO.png') }}"  width="60" height="60" alt="" /></a></li>
            <li><a href="{{ route('home') }}"><img src="{{ asset('assets/frontend/images/HOME.png') }}"  width="60" height="60" alt="" /></a></li>
            {{-- <li><a href="{{ route('post.index') }}">Posts</a></li>
            --}}


            @guest
                <li><a href="{{ route('login') }}"><img src="{{ asset('assets/frontend/images/LILOGO.png') }}"  width="60" height="60" alt="" /></a></li>
                <li><a href="{{ route('register') }}"><img src="{{ asset('assets/frontend/images/RE.png') }}"  width="60" height="60" alt="" /></a></li>
            @else
                @if (Auth::user()->role->id == 1)
                    <li><a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/frontend/images/DASHLOGO.png') }}"  width="60" height="60" alt="" /></a></li>
                    <li><a href="{{ route('chat') }}"><img src="{{ asset('assets/frontend/images/CHAT.png') }}"  width="60" height="60" alt="" /></a></li>

                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();"
                            data-toggle="tab">
                            <img src="{{ asset('assets/frontend/images/OUT.png') }}"  width="60" height="60" alt="" />
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>

                @endif
                @if (Auth::user()->role->id == 2)
                <li><a href="{{ route('author.dashboard') }}"><img src="{{ asset('assets/frontend/images/DASHLOGO.png') }}"  width="60" height="60" alt="" /></a></li>
                <li><a href="{{ route('chat') }}"><img src="{{ asset('assets/frontend/images/CHAT.png') }}"  width="60" height="60" alt="" /></a></li>
                <li><a href="{{ route('map') }}"><img src="{{ asset('assets/frontend/images/MAP.png') }}"  width="60" height="60" alt="" /></a></li>
                <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();"
                            data-toggle="tab">
                            <img src="{{ asset('assets/frontend/images/OUT.png') }}"  width="60" height="60" alt="" />
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            @endguest

        </ul><!-- main-menu -->

{{-- 
        <div class="src-area">
            <form method="GET" action="{{ route('search') }}">
                <button class="src-btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                <input class="src-input" value="{{ isset($query) ? $query : '' }}" name="query" type="text"
                    placeholder="Search">
            </form>
        </div> --}}


    </div><!-- conatiner -->
</header>