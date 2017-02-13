<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$title or "HRMS"}}</title>
    <meta name="keywords" content="iddl, hrms, afc" />
    <meta name="description" content="human resource management system">
    <meta name="author" content="IDDL">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{asset('img/logo.png')}}">
    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>

    <!-- Glyphicons Pro CSS(font) -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/glyphicons-pro/glyphicons-pro.css')}}">

    <!-- Icomoon CSS(font) -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/icomoon/icomoon.css')}}">

    <!-- Iconsweets CSS(font) -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/iconsweets/iconsweets.css')}}">

    <!-- Octicons CSS(font) -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/octicons/octicons.css')}}">

    <!-- Stateface CSS(font) -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/stateface/stateface.css')}}">

    <!-- Font Awesome CSS(font) -->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome/font-awesome.min.css')}}">

    <!-- Theme CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/hrms.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    @yield('style')

</head>

<body class="blank-page">

<!-- Start: Main -->
<div id="main">

    <!-- Start: Header -->
    <header class="navbar navbar-fixed-top navbar-shadow">
        <div class="navbar-branding">
            <a class="navbar-brand" href="dashboard.html">
                <b>Admin</b>Designs
            </a>
            <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
        </div>


        <ul class="nav navbar-nav navbar-right">
            <li>
                <div class="navbar-btn btn-group">
                    <a href="#" class="topbar-menu-toggle btn btn-sm" data-toggle="button">
                        <span class="ad ad-wand"></span>
                    </a>
                </div>
            </li>
            <li class="dropdown menu-merge">
                <div class="navbar-btn btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
                        <span class="fa fa-bell-o fs14 va-m"></span>
                        <span class="badge badge-danger">9</span>
                    </button>
                    <div class="dropdown-menu dropdown-persist w350 animated animated-shorter fadeIn" role="menu">
                        <div class="panel mbn">
                            <div class="panel-menu">
                                <span class="panel-icon"><i class="fa fa-clock-o"></i></span>
                                <span class="panel-title fw600"> Recent Activity</span>
                                <button class="btn btn-default light btn-xs pull-right" type="button"><i class="fa fa-refresh"></i></button>
                            </div>
                            <div class="panel-body panel-scroller scroller-navbar scroller-overlay scroller-pn pn">
                                <ol class="timeline-list">
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-dark light">
                                            <span class="fa fa-tags"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Michael</b> Added to his store:
                                            <a href="#">Ipod</a>
                                        </div>
                                        <div class="timeline-date">1:25am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-dark light">
                                            <span class="fa fa-tags"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Sara</b> Added his store:
                                            <a href="#">Notebook</a>
                                        </div>
                                        <div class="timeline-date">3:05am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-success">
                                            <span class="fa fa-usd"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Admin</b> created invoice for:
                                            <a href="#">Software</a>
                                        </div>
                                        <div class="timeline-date">4:15am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-success">
                                            <span class="fa fa-usd"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Admin</b> created invoice for:
                                            <a href="#">Apple</a>
                                        </div>
                                        <div class="timeline-date">7:45am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-success">
                                            <span class="fa fa-usd"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Admin</b> created invoice for:
                                            <a href="#">Software</a>
                                        </div>
                                        <div class="timeline-date">4:15am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-success">
                                            <span class="fa fa-usd"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Admin</b> created invoice for:
                                            <a href="#">Apple</a>
                                        </div>
                                        <div class="timeline-date">7:45am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-dark light">
                                            <span class="fa fa-tags"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Michael</b> Added his store:
                                            <a href="#">Ipod</a>
                                        </div>
                                        <div class="timeline-date">8:25am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-system">
                                            <span class="fa fa-fire"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Admin</b> created invoice for:
                                            <a href="#">Software</a>
                                        </div>
                                        <div class="timeline-date">4:15am</div>
                                    </li>
                                    <li class="timeline-item">
                                        <div class="timeline-icon bg-dark light">
                                            <span class="fa fa-tags"></span>
                                        </div>
                                        <div class="timeline-desc">
                                            <b>Sara</b> Added to his store:
                                            <a href="#">Notebook</a>
                                        </div>
                                        <div class="timeline-date">3:05am</div>
                                    </li>
                                </ol>

                            </div>
                            <div class="panel-footer text-center p7">
                                <a href="#" class="link-unstyled"> View All </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown menu-merge">
                <div class="navbar-btn btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
                        <span class="ad ad-radio-tower fs14 va-m"></span>
                        <span class="badge">5</span>
                    </button>
                    <div class="dropdown-menu dropdown-persist w375 animated animated-shorter fadeIn" role="menu">
                        <div class="panel mbn">
                            <div class="panel-menu">
                                <div class="btn-group btn-group-justified btn-group-nav" role="tablist">
                                    <a href="#nav-tab1" data-toggle="tab" class="btn btn-default btn-sm active">Notifications</a>
                                    <a href="#nav-tab2" data-toggle="tab" class="btn btn-default btn-sm br-l-n br-r-n">Messages</a>
                                    <a href="#nav-tab3" data-toggle="tab" class="btn btn-default btn-sm">Activity</a>
                                </div>
                            </div>
                            <div class="panel-body panel-scroller scroller-navbar pn">
                                <div class="tab-content br-n pn">
                                    <div id="nav-tab1" class="tab-pane alerts-widget active" role="tabpanel">
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-user text-info"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Registration
                                                    <small class="text-muted"></small>
                                                </h5> Tyler Durden - 16 hours ago

                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Approve?</div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-check text-success"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-shopping-cart text-success"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Order
                                                    <small class="text-muted"></small>
                                                </h5> <a href="#">Apple Ipod</a> - 4 hours ago
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Confirm?</div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-check text-success"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-comment text-system"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Comment
                                                    <small class="text-muted"></small>
                                                </h5> Mike - I loved your article!
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response text-right"> Moderate?</div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-check text-success"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-star text-warning"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Review
                                                    <small class="text-muted"></small>
                                                </h5> Sammy Hilton - 4 hours ago
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Approve?</div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-check text-success"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-user text-info"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Registration
                                                    <small class="text-muted"></small>
                                                </h5> Michael Sober - 7 hours ago
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Approve?</div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-check text-success"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-remove"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-usd text-alert"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Invoice
                                                    <small class="text-muted"></small>
                                                </h5> <a href="#">Apple Ipod</a> - 4 hours ago

                                            </div>
                                            <div class="media-right">
                                                <div class="media-response single">#518358</div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <a class="media-left" href="#"> <span class="glyphicon glyphicon-shopping-cart text-success"></span> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading">New Order
                                                    <small class="text-muted"></small>
                                                </h5> <a href="#">Apple Ipod</a> - 4 hours ago
                                            </div>
                                            <div class="media-right">
                                                <div class="media-response"> Confirm?</div>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-check text-success"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-xs light">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="nav-tab2" class="tab-pane chat-widget" role="tabpanel">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/3.jpg">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="media-status online"></span>
                                                <h5 class="media-heading">Courtney Faught
                                                    <small> - 12:30am</small>
                                                </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-status offline"></span>
                                                <h5 class="media-heading">Joe Gibbons
                                                    <small> - 12:30am</small>
                                                </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.
                                            </div>
                                            <div class="media-right">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/1.jpg">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/2.jpg">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="media-status online"></span>
                                                <h5 class="media-heading">Courtney Faught
                                                    <small> - 12:30am</small>
                                                </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metuscommodo.
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-status offline"></span>
                                                <h5 class="media-heading">Joe Gibbons
                                                    <small> - 12:30am</small>
                                                </h5> Cras sit amet nibh libero, in Nulla vel metus scelerisque antecommodo.
                                            </div>
                                            <div class="media-right">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/1.jpg">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/2.jpg">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <span class="media-status online"></span>
                                                <h5 class="media-heading">Courtney Faught
                                                    <small> - 12:30am</small>
                                                </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque soltudino.
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-body">
                                                <span class="media-status offline"></span>
                                                <h5 class="media-heading">Joe Gibbons
                                                    <small> - 12:30am</small>
                                                </h5> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                                            </div>
                                            <div class="media-right">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="assets/img/avatars/1.jpg">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="nav-tab3" class="tab-pane scroller-nm" role="tabpanel">
                                        <ul class="media-list" role="menu">
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/5.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Article
                                                        <small class="text-muted">- 08/16/22</small>
                                                    </h5> Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/2.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading mv5">Article
                                                        <small> - 08/16/22</small>
                                                    </h5>
                                                    Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/3.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Article
                                                        <small class="text-muted">- 08/16/22</small>
                                                    </h5> Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/4.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading mv5">Article
                                                        <small class="text-muted">- 08/16/22</small>
                                                    </h5> Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/5.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Article
                                                        <small class="text-muted">- 08/16/22</small>
                                                    </h5> Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/2.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading mv5">Article
                                                        <small> - 08/16/22</small>
                                                    </h5>
                                                    Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <a class="media-left" href="#"> <img src="assets/img/avatars/3.jpg" class="mw40" alt="avatar"> </a>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Article
                                                        <small class="text-muted">- 08/16/22</small>
                                                    </h5> Last Updated 36 days ago by
                                                    <a class="text-system" href="#"> Max </a>
                                                </div>
                                            </li>
                                        </ul>
                                        <table class="table table-striped hidden">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            <tr>
                                                <td>Sussy</td>
                                                <td>Watcher</td>
                                                <td>@thehawk</td>
                                            </tr>
                                            <tr>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td>Sussy</td>
                                                <td>Watcher</td>
                                                <td>@thehawk</td>
                                            </tr>
                                            <tr>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            <tr>
                                                <td>Larry</td>
                                                <td>the Bird</td>
                                                <td>@twitter</td>
                                            </tr>
                                            <tr>
                                                <td>Sussy</td>
                                                <td>Watcher</td>
                                                <td>@thehawk</td>
                                            </tr>
                                            <tr>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                            </tr>
                                            <tr>
                                                <td>Jacob</td>
                                                <td>Thornton</td>
                                                <td>@fat</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-center p7">
                                <a href="#" class="link-unstyled"> View All </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown menu-merge">
                <div class="navbar-btn btn-group">
                    <button data-toggle="dropdown" class="btn btn-sm dropdown-toggle">
                        <span class="flag-xs flag-us"></span>
                        <!-- <span class="caret"></span> -->
                    </button>
                    <ul class="dropdown-menu pv5 animated animated-short flipInX" role="menu">
                        <li>
                            <a href="javascript:void(0);">
                                <span class="flag-xs flag-in mr10"></span> Hindu </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="flag-xs flag-tr mr10"></span> Turkish </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span class="flag-xs flag-es mr10"></span> Spanish </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-divider hidden-xs">
                <i class="fa fa-circle"></i>
            </li>
            <li class="dropdown menu-merge">
                <a href="#" class="dropdown-toggle fw600 p15" data-toggle="dropdown">
                    <img src="{{asset('img/placeholder.png')}}" alt="avatar" class="mw30 br64">
                    <span class="hidden-xs pl15"> {{Auth::user()->full_name}} </span>
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
                            <span class="fa fa-user"></span> Friends
                            <span class="label label-warning">6</span>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="animated animated-short fadeInUp">
                            <span class="fa fa-gear"></span> Account Settings </a>
                    </li>
                    <li class="dropdown-footer">
                        <a href="{{ url('/setup/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
    <!-- End: Header -->

    <!-- Start: Sidebar -->
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

    <!-- Start: Content-Wrapper -->
    <section id="content_wrapper">

        <!-- Start: Topbar-Dropdown -->
        <div id="topbar-dropmenu" class="alt">
            <div class="topbar-menu row">
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="metro-tile bg-primary light">
                        <span class="glyphicon glyphicon-inbox text-muted"></span>
                        <span class="metro-title">Messages</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="metro-tile bg-info light">
                        <span class="glyphicon glyphicon-user text-muted"></span>
                        <span class="metro-title">Users</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="metro-tile bg-success light">
                        <span class="glyphicon glyphicon-headphones text-muted"></span>
                        <span class="metro-title">Support</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="metro-tile bg-system light">
                        <span class="glyphicon glyphicon-facetime-video text-muted"></span>
                        <span class="metro-title">Videos</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="metro-tile bg-warning light">
                        <span class="fa fa-gears text-muted"></span>
                        <span class="metro-title">Settings</span>
                    </a>
                </div>
                <div class="col-xs-4 col-sm-2">
                    <a href="#" class="metro-tile bg-alert light">
                        <span class="glyphicon glyphicon-picture text-muted"></span>
                        <span class="metro-title">Pictures</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- End: Topbar-Dropdown -->

        @yield('content')

    </section>
    <!-- End: Content-Wrapper -->
</div>
<!-- End: Main -->

<!-- BEGIN: PAGE SCRIPTS -->
<script src="{{asset('js/hrms.js')}}"></script>
<script src="{{asset('vendor/jquery/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('vendor/jquery/jquery_ui/jquery-ui.min.js')}}"></script>

<script src="{{asset('vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
<script src="{{asset('vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>


<script src="{{asset('js/utility/utility.js')}}"></script>
<script src="{{asset('js/demo/demo.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

    });
</script>

@yield('script')
<!-- END: PAGE SCRIPTS -->

</body>

</html>
