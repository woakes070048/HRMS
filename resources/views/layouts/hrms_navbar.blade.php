<header class="navbar navbar-fixed-top navbar-shadow">
    <div class="navbar-branding">
        <a class="navbar-brand" href="dashboard.html">
            <b>AFC</b>HRMS
        </a>
        <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
    </div>


    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown menu-merge">
            <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
                @if(empty($auth->photo))
                <img src="{{asset('img/placeholder.png')}}" alt="avatar" class="mw30 br64">
                @else
                <img src="{{$auth->full_image}}" alt="{{$auth->full_name}}" class="mw30 br64">
                @endif
                <span class="hidden-xs pl15"> {{$auth->full_name}} </span>
                <span class="caret caret-tp hidden-xs"></span>
            </a>
            <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
                <li class="list-group-item">
                    <a href="#" class="animated animated-short fadeInUp">
                        <span class="fa fa-envelope"></span> Messages
                        <span class="label label-warning">2</span>
                    </a>
                </li>
                
                <li class="list-group-item">
                    <a href="#" class="animated animated-short fadeInUp">
                        <span class="fa fa-gear"></span> Account Settings </a>
                </li>
                <li class="dropdown-footer">
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="fa fa-power-off pr5"></span> Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</header>
