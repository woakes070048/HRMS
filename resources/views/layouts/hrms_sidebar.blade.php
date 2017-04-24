<aside id="sidebar_left" class="nano nano-light affix">

    <!-- Start: Sidebar Left Content -->
    <div class="sidebar-left-content nano-content">

        <!-- Sidebar Widget - Author -->
          <div class="sidebar-widget author-widget">
            <div class="media">
              <a class="media-left" href="{{url('employee/view/'.$auth->employee_no)}}">
                @if(empty($auth->photo))
                <img src="{{asset('img/placeholder.png')}}" alt="avatar" class="img-responsive">
                @else
                <img src="{{$auth->full_image}}" alt="{{$auth->full_name}}" class="img-responsive">
                @endif
              </a>
              <div class="media-body">
                <div class="media-links">
                <div class="media-author">{{$auth->full_name}}</div>
                    <a href="{{url('employee/view/'.$auth->employee_no)}}" class="sidebar-menu-toggle">{{$auth->designation->designation_name}} - </a>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="fa fa-power-off pr5"></span>Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
              </div>
            </div>
          </div>

          <?php 
            $employee = [
                'department',
                'unit',
                'levels',
                'designation',
                'branch',
                'bank',
                'promotion',
                'employee',
            ];
            $attendance = ['workshift','shiftassign','attendance'];
            $PayRoll = ['salaryInfo'];
            $settings = ['settings'];
          ?>

        <!-- Start: Sidebar Menu -->
        <ul class="nav sidebar-menu">
        <li class="sidebar-label pt20"></li>
            <li>
                <a href="{{url('/')}}">
                  <span class="glyphicon glyphicon-home"></span>
                  <span class="sidebar-title">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="accordion-toggle @if(in_array(\Request::segment(1), $employee)) menu-open @endif" href="#">
                    <span class="glyphicons glyphicons-group" aria-hidden="true"></span>
                    <span class="sidebar-title">Employee Management</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li class="@if(\Request::segment(1) == 'department') active @endif">
                        <a href="{{url('department/index')}}">
                            <span class="fa fa-level-up"></span> Departments
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'unit') active @endif">
                        <a href="{{url('unit/index')}}">
                            <span class="fa fa-level-up"></span> Unit
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'levels') active @endif">
                        <a href="{{url('levels/index')}}">
                            <span class="fa fa-level-up"></span> Levels
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'designation') active @endif">
                        <a href="{{url('designation/index')}}">
                            <span class="fa fa-level-up"></span> Designation
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'branch') active @endif">
                        <a href="{{url('branch/index')}}">
                            <span class="fa fa-level-up"></span> Branch
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'bank') active @endif">
                        <a href="{{url('bank/index')}}">
                            <span class="fa fa-level-up"></span> Bank
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'promotion') active @endif">
                        <a href="{{url('promotion/index')}}">
                            <span class="fa fa-level-up"></span> Transfer / Promotion
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'employee') active @endif">
                        <a href="{{url('employee/index')}}"><span class="fa fa-users" aria-hidden="true"></span> Manage Employee</a>
                    </li>
                    
                </ul>
            </li>
            <li>
                <a class="accordion-toggle @if(in_array(\Request::segment(1), $attendance)) menu-open @endif" href="#">
                    <span class="icon-stopwatch" aria-hidden="true"></span>
                    <span class="sidebar-title">Time & Attendance</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li class="@if(\Request::segment(1) == 'workshift') active @endif">
                        <a href="{{url('workshift/index')}}">
                            <span class="fa fa-level-up"></span> Work Shift
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'shiftassign') active @endif">
                        <a href="{{url('shiftassign/index')}}">
                            <span class="fa fa-level-up"></span> Work Shift Assign
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'attendance') active @endif">
                        <a href="{{url('attendance/index')}}">
                            <span class="fa fa-level-up"></span> Attendance
                        </a>
                    </li>
                    <li class="@if(\Request::segment(1) == 'attendance') active @endif">
                        <a href="{{url('attendance/index')}}">
                            <span class="fa fa-level-up"></span> My Attendance
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle @if(in_array(\Request::segment(1), $PayRoll)) menu-open @endif" href="#">
                    <span class="fa fa-money" aria-hidden="true"></span>
                    <span class="sidebar-title">PayRoll Management</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li class="@if(\Request::segment(1) == 'salaryInfo') active @endif">
                        <a href="{{url('salaryInfo/index')}}">
                            <span class="glyphicon glyphicon-usd"></span> Salary Info
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle @if(in_array(\Request::segment(1), $settings)) menu-open @endif" href="#">
                    <span class="glyphicons glyphicons-adjust_alt" aria-hidden="true"></span>
                    <span class="sidebar-title">Application Settings</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li class="@if(\Request::segment(1) == 'settings') active @endif">
                        <a href="{{url('settings/index')}}">
                            <span class="glyphicons glyphicons-settings"></span> 
                            Basic Settings
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- End: Sidebar Menu -->

        <!-- Start: Sidebar Collapse Button -->
        <div class="sidebar-toggle-mini">
            <a href="#">
                <span class="fa fa-sign-out"></span>
            </a>
        </div>
        <!-- End: Sidebar Collapse Button -->

    </div>
    <!-- End: Sidebar Left Content -->

</aside>