<nav class="navbar navbar-expand-lg navbar-light bg-light p-0">
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav main_navbar">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.index') }}">User Service Management</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{  route('frontend.blog') }}">All Blog</a>
            </li> --}}
            @auth <!-- Only show Logout when the user is logged in -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </li> --}}
            @endauth
            @guest <!-- Only show Registration and Login when the user is a guest -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registration</a>
            </li> --}}
            @endguest
        </ul>

    </div>
  </nav>
