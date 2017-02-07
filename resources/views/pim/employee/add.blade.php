@extends('layouts.hrms')
@section('content')

    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">Add Employee</span>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Standard</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control input-sm" placeholder="Type Here...">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Select List</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control input-sm" placeholder="Type Here...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Content -->

@endsection