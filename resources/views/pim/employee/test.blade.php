@extends('layouts.hrms')
@section('content')

    <!-- Start: Topbar -->
    {{--<header id="topbar" class="ph10">--}}
    {{--<div class="topbar-left">--}}

    {{--<div class="pull-left mt5">--}}

    {{--<span class="panel-title">Employee Add Panel</span>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="topbar-right hidden-xs hidden-sm">--}}
    {{--<a href="ecommerce_products.html" class="btn btn-default btn-sm fw600 ml10">--}}
    {{--<span class="fa fa-plus pr5"></span> Add Employee</a>--}}
    {{--<a href="ecommerce_customers.html" class="btn btn-default btn-sm fw600 ml10">--}}
    {{--<span class="fa fa-user pr5"></span> View Employee</a>--}}
    {{--</div>--}}
    {{--</header>--}}
    <!-- End: Topbar -->


    <section class="animated fadeIn p5">
        <div class="panel">
            <div class="panel-heading">
                <ul class="nav panel-tabs-border panel-tabs">
                    <li class="">
                        <a href="#tab1_1" data-toggle="tab" aria-expanded="false">Account Actions</a>
                    </li>
                    <li class="">
                        <a href="#tab1_2" data-toggle="tab" aria-expanded="false">Messages</a>
                    </li>
                    <li class="active">
                        <a href="#tab1_3" data-toggle="tab" aria-expanded="true">User Tickets</a>
                    </li>
                </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content pn br-n">
                    <div id="tab1_1" class="tab-pane">
                        <div class="row">
                            <div class="col-md-12">
                                {{--<div class="panel panel-success panel-border top">--}}
                                {{--<div class="panel-body">--}}
                                <form role="form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" class="form-control input-sm" placeholder="enter first name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" class="form-control input-sm" placeholder="enter last name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Email Address</label>
                                                <input type="text" class="form-control input-sm" placeholder="enter first name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" class="form-control input-sm" placeholder="enter last name">
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="short alt">

                                    <div class="section row mbn">
                                        <div class="col-sm-4">
                                            <p class="text-right">
                                                <button class="btn btn-primary" type="button">Save Order</button>
                                            </p>
                                        </div>
                                    </div>

                                </form>
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>

                    <div id="tab1_2" class="tab-pane">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/img/stock/2.jpg" class="img-responsive thumbnail mr25">
                            </div>
                            <div class="col-md-8">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                        </div>
                    </div>
                    <div id="tab1_3" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets/img/stock/3.jpg" class="img-responsive thumbnail mr25">
                            </div>
                            <div class="col-md-8">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="panel panel-success panel-border top">
                <div class="panel-body">
                    <form role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control input-sm" placeholder="enter first name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control input-sm" placeholder="enter last name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Email Address</label>
                                    <input type="text" class="form-control input-sm" placeholder="enter first name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" class="form-control input-sm" placeholder="enter last name">
                                </div>
                            </div>
                        </div>

                        <hr class="short alt">

                        <div class="section row mbn">
                            <div class="col-sm-4">
                                <p class="text-right">
                                    <button class="btn btn-primary" type="button">Save Order</button>
                                </p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- End: Content -->

@endsection