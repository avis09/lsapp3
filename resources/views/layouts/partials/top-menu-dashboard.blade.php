<body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">{{config('app.name', 'LSAPP')}}</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-align-justify"></i></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            @if(Auth::user()->userRoleID == 1)
               @php 
               $profile = '/student/profile';
                $change_password = '/student/change-password';
                @endphp
            @elseif(Auth::user()->userRoleID == 2)
                @php 
                $profile = '/gasd/profile';
                $change_password = '/gasd/change-password';
                @endphp
            @elseif(Auth::user()->userRoleID == 3)
                @php 
                $profile = '/registrar/profile';
                $change_password = '/registrar/change-password';
                @endphp
            @elseif(Auth::user()->userRoleID == 4)
                @php 
                $profile = '/itd/profile';
                $change_password = '/itd/change-password';
                @endphp
            @endif

            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">{{ auth()->user()->firstName.' '.auth()->user()->lastName }} <i class="fa fa-user fa-lg ml-1"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{{$profile}}"><i class="fas fa-user fa-lg"></i> Profile</a></li>

                
            <li><a class="dropdown-item" href="{{$change_password}}"><i class="fas fa-cog fa-lg"></i> Settings</a></li>
                <li><a class="dropdown-item"onclick="document.getElementById('form-logout').submit();""><i class="fas fa-sign-out-alt fa-lg"></i> Logout</a></li>
                <form id="form-logout" action="{{route('logout')}}" method="POST" style="display: none;">
                        @csrf
                </form>
            </ul>
            </li>
        </ul>
        </header>
