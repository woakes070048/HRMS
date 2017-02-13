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
                        <a class="accordion-toggle" href="#">
                            <span class="fa fa-level-up"></span> Manage Level
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <a href="{{url('levels/index')}}">Levels</a>
                                <a href="{{url('levels/add')}}">Add</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="fa fa-level-up"></span> Manage Department
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <a href="{{url('department/index')}}">Departments</a>
                                <a href="{{url('department/add')}}">Add</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="fa fa-level-up"></span> Manage Designation
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <a href="{{url('designation/index')}}">Designations</a>
                                <a href="{{url('designation/add')}}">Add</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="fa fa-users" aria-hidden="true"></span>
                            Manage Employee
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li>
                                <a href="{{url('employee/index')}}">Employees</a>
                            </li>
                            <li>
                                <a href="{{url('employee/add')}}">Add Employee</a>
                            </li>
                        </ul>
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