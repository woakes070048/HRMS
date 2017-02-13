@extends('layouts.hrms')
@section('content')

    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-tools/admin-forms/css/admin-forms.css')}}">

<section class="animated fadeIn p10">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"><span class="glyphicons glyphicons-user_add"></span> Add New Employee</span>
            <ul class="nav panel-tabs-border panel-tabs">
                <li class="active">
                    <a href="#tab1_1" data-toggle="tab" aria-expanded="false">Basic</a>
                </li>
                <li class="">
                    <a href="#tab1_2" data-toggle="tab" aria-expanded="false">Personal</a>
                </li>
                <li class="">
                    <a href="#tab1_3" data-toggle="tab" aria-expanded="true">Education</a>
                </li>
                <li class="">
                    <a href="#tab1_4" data-toggle="tab" aria-expanded="true">Experience</a>
                </li>
                <li class="">
                    <a href="#tab1_6" data-toggle="tab" aria-expanded="true">Salary</a>
                </li>
                <li class="">
                    <a href="#tab1_7" data-toggle="tab" aria-expanded="true">Nominee</a>
                </li>
                <li class="">
                    <a href="#tab1_8" data-toggle="tab" aria-expanded="true">Training</a>
                </li>
                <li class="">
                    <a href="#tab1_9" data-toggle="tab" aria-expanded="true">Reference</a>
                </li>
                <li class="">
                    <a href="#tab1_10" data-toggle="tab" aria-expanded="true">Children</a>
                </li>
            </ul>
        </div>

        <div class="panel-body">
            <div class="tab-content pn br-n">
                <div id="tab1_1" class="tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url('employee/add')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('employee_no')?'has-error':''}}">
                                            <label class="control-label">Employee No :</label>
                                            <input type="text" name="employee_no" class="form-control input-sm" placeholder="Enter Employee No">
                                            @if($errors->has('employee_no'))<span class="help-block">{{$errors->first('employee_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('designation_id')?'has-error':''}}">
                                            <label class="control-label">Employee Designation :</label>
                                            <select class="form-control input-sm" name="designation_id">
                                                <option value="">---- Select Employee Designation ----</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('designation_id'))<span class="help-block">{{$errors->first('designation_id')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button type="button" class="btn btn-sm btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add Designation</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('first_name')?'has-error':''}}">
                                            <label class="control-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control input-sm" placeholder="Enter First Name">
                                            @if($errors->has('first_name'))<span class="help-block">{{$errors->first('first_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Middle Name</label>
                                            <input type="text" name="middle_name" class="form-control input-sm" placeholder="Enter Middle Name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('last_name')?'has-error':''}}">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control input-sm" placeholder="Enter Last Name">
                                            @if($errors->has('last_name'))<span class="help-block">{{$errors->first('last_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Nick Name</label>
                                            <input type="text" name="nick_name" class="form-control input-sm" placeholder="Enter Nick Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" name="email" class="form-control input-sm" placeholder="Enter Email Address">
                                            @if($errors->has('email'))<span class="help-block">{{$errors->first('email')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mobile_number')?'has-error':''}}">
                                            <label class="control-label">Mobile Number</label>
                                            <input type="number" name="mobile_number" class="form-control input-sm" placeholder="Enter Mobile Number">
                                            @if($errors->has('mobile_number'))<span class="help-block">{{$errors->first('mobile_number')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('password')?'has-error':''}}">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control input-sm" placeholder="Enter Password">
                                            @if($errors->has('password'))<span class="help-block">{{$errors->first('password')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('retype_password')?'has-error':''}}">
                                            <label class="control-label">Retype Password</label>
                                            <input type="password" name="retype_password" class="form-control input-sm" placeholder="Enter Retype Password">
                                            @if($errors->has('retype_password'))<span class="help-block">{{$errors->first('retype_password')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 pt50">
                                        <label class="control-label">Employee Photo</label>
                                        <div class="fileupload fileupload-new admin-form" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail mb15">
                                                <img src="http://placehold.it/250x250" alt="holder">
                                            </div>
                                            <span class="button btn btn-sm btn-dark btn-file btn-block ph5">
                                                <span class="fileupload-new"><span class="fa fa-user"></span> &nbsp; <strong>Select Photo</strong></span>
                                                <span class="fileupload-exists"><span class="fa fa-user"></span> &nbsp; <strong>Change Photo</strong></span>
                                                <input type="file" name="image">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="admin-form">
                                            <div class="section-divider mb40">
                                                <span class="bg-white">Present Address</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('present_division_id')?'has-error':''}}">
                                                    <label class="control-label">Division :</label>
                                                    <select class="form-control input-sm" name="present_division_id">
                                                        <option value="">---- Select Division ----</option>
                                                        @foreach($divisions as $division)
                                                            <option value="{{$division->id}}">{{$division->division_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('present_division_id'))<span class="help-block">{{$errors->first('present_division_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('present_district_id')?'has-error':''}}">
                                                    <label class="control-label">District :</label>
                                                    <select class="form-control input-sm" name="present_district_id">
                                                        <option value="">---- Select Employee Designation ----</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}">{{$district->district_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('present_district_id'))<span class="help-block">{{$errors->first('present_district_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('present_policestation_id')?'has-error':''}}">
                                                    <label class="control-label">Police Station :</label>
                                                    <select class="form-control input-sm" name="present_policestation_id">
                                                        <option value="">---- Select Police Station ----</option>
                                                        @foreach($police_stations as $police_station)
                                                            <option value="{{$police_station->id}}">{{$police_station->police_station_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('present_policestation_id'))<span class="help-block">{{$errors->first('present_policestation_id')}}</span>@endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Post Office</label>
                                                    <input type="text" name="present_post_office" class="form-control input-sm" placeholder="Enter Post Office">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <textarea name="present_address" id="" cols="60" rows="1"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="admin-form">
                                            <div class="section-divider mb40">
                                                <span class="bg-white">Permanent Address</span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('permanent_division_id')?'has-error':''}}">
                                                    <label class="control-label">Division :</label>
                                                    <select class="form-control input-sm" name="permanent_division_id">
                                                        <option value="">---- Select Division ----</option>
                                                        @foreach($divisions as $division)
                                                            <option value="{{$division->id}}">{{$division->division_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('permanent_division_id'))<span class="help-block">{{$errors->first('permanent_division_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('permanent_district_id')?'has-error':''}}">
                                                    <label class="control-label">District :</label>
                                                    <select class="form-control input-sm" name="permanent_district_id">
                                                        <option value="">---- Select Employee Designation ----</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}">{{$district->district_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('permanent_district_id'))<span class="help-block">{{$errors->first('permanent_district_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('permanent_policestation_id')?'has-error':''}}">
                                                    <label class="control-label">Police Station :</label>
                                                    <select class="form-control input-sm" name="permanent_policestation_id">
                                                        <option value="">---- Select Police Station ----</option>
                                                        @foreach($police_stations as $police_station)
                                                            <option value="{{$police_station->id}}">{{$police_station->police_station_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('permanent_policestation_id'))<span class="help-block">{{$errors->first('permanent_policestation_id')}}</span>@endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Post Office</label>
                                                    <input type="text" name="permanent_post_office" class="form-control input-sm" placeholder="Enter Post Office">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <textarea name="" id="" cols="60" rows="1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>




                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-3 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="add_employee" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Add Employee</button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div id="tab1_2" class="tab-pane">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url('employee/add')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('employee_no')?'has-error':''}}">
                                            <label class="control-label">Employee No :</label>
                                            <input type="text" name="employee_no" class="form-control input-sm" placeholder="Enter Employee No">
                                            @if($errors->has('employee_no'))<span class="help-block">{{$errors->first('employee_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('designation_id')?'has-error':''}}">
                                            <label class="control-label">Employee Designation :</label>
                                            <select class="form-control input-sm" name="designation_id">
                                                <option value="">---- Select Employee Designation ----</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->id}}">{{$designation->designation_name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('designation_id'))<span class="help-block">{{$errors->first('designation_id')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button type="button" class="btn btn-sm btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add Designation</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('first_name')?'has-error':''}}">
                                            <label class="control-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control input-sm" placeholder="Enter First Name">
                                            @if($errors->has('first_name'))<span class="help-block">{{$errors->first('first_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Middle Name</label>
                                            <input type="text" name="middle_name" class="form-control input-sm" placeholder="Enter Middle Name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('last_name')?'has-error':''}}">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control input-sm" placeholder="Enter Last Name">
                                            @if($errors->has('last_name'))<span class="help-block">{{$errors->first('last_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Nick Name</label>
                                            <input type="text" name="nick_name" class="form-control input-sm" placeholder="Enter Nick Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" name="email" class="form-control input-sm" placeholder="Enter Email Address">
                                            @if($errors->has('email'))<span class="help-block">{{$errors->first('email')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mobile_number')?'has-error':''}}">
                                            <label class="control-label">Mobile Number</label>
                                            <input type="number" name="mobile_number" class="form-control input-sm" placeholder="Enter Mobile Number">
                                            @if($errors->has('mobile_number'))<span class="help-block">{{$errors->first('mobile_number')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('password')?'has-error':''}}">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control input-sm" placeholder="Enter Password">
                                            @if($errors->has('password'))<span class="help-block">{{$errors->first('password')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('retype_password')?'has-error':''}}">
                                            <label class="control-label">Retype Password</label>
                                            <input type="password" name="retype_password" class="form-control input-sm" placeholder="Enter Retype Password">
                                            @if($errors->has('retype_password'))<span class="help-block">{{$errors->first('retype_password')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">Employee Photo</label>
                                        <div class="fileupload fileupload-new admin-form" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail mb15">
                                                <img src="http://placehold.it/350x150" alt="holder">
                                            </div>
                                            <span class="button btn btn-sm btn-dark btn-file btn-block ph5">
                                                <span class="fileupload-new"><span class="fa fa-user"></span> &nbsp; <strong>Select Photo</strong></span>
                                                <span class="fileupload-exists"><span class="fa fa-user"></span> &nbsp; <strong>Change Photo</strong></span>
                                                <input type="file" name="image">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-3 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="add_employee" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Add Employee</button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div id="tab1_3" class="tab-pane ">
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

@section('script')
    <!-- FileUpload JS -->
    <script src="{{asset('vendor/plugins/fileupload/fileupload.js')}}"></script>
@endsection


@endsection