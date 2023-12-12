<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('main') }}">
                <img src="{{ asset('image/carsucc.png') }}" alt="homepage" class="logo pr-5" />
            </a>

        </div>
        <h3 style="color: #fff; margin-top:5px;">CSUCC CEIT LSG FEES MONITORING SYSTEM
        </h3>
        <div class="navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark"
                        href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
            </ul>
            <ul class="navbar-nav my-lg-0">
                @auth('web')
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="x">Welcome: {{ Str::ucfirst(Auth::guard('web')->user()->username) }}</span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout.admin') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="dropdown-item btn-sm logout waves-effect waves-dark"
                                        id="logout">
                                        <span>LOGOUT &nbsp;</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @elseif(auth()->guard('students')->check())
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="x">Account: {{ Str::ucfirst(Auth::guard('students')->user()->fname) }}</span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout.user') }}" method="post">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="dropdown-item btn-sm logout waves-effect waves-dark"
                                        id="logout">
                                        <span>LOGOUT &nbsp;</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"
                            href="{{ route('login_users') }}"><span class="x">Login</span> </a>
                    </li>
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic"
                            href="{{ route('register') }}"><span class="x">Register</span> </a>
                    </li>
                @endauth

            </ul>
        </div>



    </nav>


</header>
