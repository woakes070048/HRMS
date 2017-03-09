<aside id="sidebar_left" class="nano nano-light affix">

    <!-- Start: Sidebar Left Content -->
    <div class="sidebar-left-content nano-content">


        <!-- Start: Sidebar Menu -->
        <ul class="nav sidebar-menu">
            <li>
                <a class="accordion-toggle" href="#">
                    <span class="glyphicons glyphicons-group" aria-hidden="true"></span>
                    <span class="sidebar-title">Employee Management</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li>
                        <a href="{{url('department/index')}}">
                            <span class="fa fa-level-up"></span> Departments
                        </a>
                    </li>
                    <li>
                        <a href="{{url('unit/index')}}">
                            <span class="fa fa-level-up"></span> Unit
                        </a>
                    </li>
                    <li>
                        <a href="{{url('levels/index')}}">
                            <span class="fa fa-level-up"></span> Levels
                        </a>
                    </li>
                    <li>
                        <a href="{{url('designation/index')}}">
                            <span class="fa fa-level-up"></span> Designation
                        </a>
                    </li>
                    <li>
                        <a href="{{url('employee/index')}}"><span class="fa fa-users" aria-hidden="true"></span>Manage Employee</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle" href="#">
                    <span class="fa fa-money" aria-hidden="true"></span>
                    <span class="sidebar-title">PayRoll Management</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li>
                        <a href="{{url('salaryInfo/index')}}">
                            <span class="glyphicon glyphicon-usd"></span> Salary Info
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="accordion-toggle" href="#">
                    <span class="glyphicons glyphicons-adjust_alt" aria-hidden="true"></span>
                    <span class="sidebar-title">Application Settings</span>
                    <span class="caret"></span>
                </a>
                <ul class="nav sub-nav">
                    <li>
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