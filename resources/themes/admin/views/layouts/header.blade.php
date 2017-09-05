<header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow hidden-print">
            
    <div class="navbar-header aside bg-white {{ (Auth::guest())? 'nav' : 'nav' }}">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
            <i class="icon-list"></i>
        </a>
        <a href="#" class="navbar-brand text-lt">
            <img src="{{ asset('images/logo.png') }}">
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
            <i class="icon-settings"></i>
        </a>
    </div>

    {{-- @if(! Auth::guest())
    <ul class="nav navbar-nav hidden-xs">
        <li>
            <a href="#nav" data-toggle="class:nav-xs" class="text-muted">
                <i class="icon-list text"></i>
                <i class="icon-list text-active"></i>
            </a>
        </li>
    </ul>
    @endif --}}

    <!-- Right Side Of Navbar -->
    <div class="navbar-right">
        <ul class="nav navbar-nav m-n hidden-xs nav-user user">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li><a href="{{ route('admin.login') }}">Login</a></li>
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
                        <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                            <img src="{{ theme_asset('/images/a0.png') }}" alt="...">
                        </span>
                        {{ Auth::user()->name }} <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</header>