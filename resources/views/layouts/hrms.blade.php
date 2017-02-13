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

</head>

<body class="@if(isset($sidevar_hide))sb-l-m sb-l-disable-animation @endif">

<!-- Start: Main -->
<div id="main">

    <!-- Start: Header -->
    @include('layouts.hrms_navbar')
    <!-- End: Header -->

    <!-- Start: Sidebar -->
    @include('layouts.hrms_sidebar')
    <!-- End: Sidebar -->

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
<!-- PNotify -->
<script src="{{asset('vendor/plugins/pnotify/pnotify.js')}}"></script>

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

<?php $messages= ['success','danger','warning']; foreach($messages as $msg){?>
@if(Session($msg))
    <script type="text/javascript">
        // Create new Notification
        new PNotify({
            title: '{{ucfirst($msg)}} Message',
            text: '{{Session($msg)}}',
            shadow: true,
            addclass: 'stack_top_right',
            type: '{{$msg}}',
            width: '290px',
            delay: 1500
        });
    </script>
@endif
<?php }?>

@yield('script')
<!-- END: PAGE SCRIPTS -->

</body>

</html>
