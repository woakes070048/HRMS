@extends('layouts.hrms')
@section('content')

@section('style')
<!-- Admin Forms CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('admin-tools/admin-forms/css/admin-forms.css')}}">
@endsection

<section class="animated fadeIn p10">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"><span class="glyphicons glyphicons-user_add"></span> Add New Employee</span>
            <ul class="nav panel-tabs-border panel-tabs">
                <li class="@if($tab == '') active @endif">
                    <a href="#tab1_1" data-toggle="tab" aria-expanded="true">Basic</a>
                </li>
                <li class="@if($tab == 'personal') active @endif">
                    <a @if(isset($id)) href="#tab1_2" data-toggle="tab" @endif aria-expanded="true">Personal</a>
                    <!-- <a href="#tab1_2" data-toggle="tab" aria-expanded="true">Personal</a> -->
                </li>
                <li class="@if($tab == 'education') active @endif">
                    <a @if(isset($id)) href="#tab1_3" data-toggle="tab" @endif aria-expanded="true">Education</a>
                </li>
                <li class="@if($tab == 'experience') active @endif">
                    <a @if(isset($id)) href="#tab1_4" data-toggle="tab" @endif aria-expanded="true">Experience</a>
                </li>
                <li class="@if($tab == 'salary') active @endif">
                    <a @if(isset($id)) href="#tab1_5" data-toggle="tab" @endif aria-expanded="true">Salary</a>
                </li>
                <li class="@if($tab == 'nominee') active @endif">
                    <a @if(isset($id)) href="#tab1_6" data-toggle="tab" @endif aria-expanded="true">Nominee</a>
                </li>
                <li class="@if($tab == 'training') active @endif">
                    <a @if(isset($id)) href="#tab1_7" data-toggle="tab" @endif aria-expanded="true">Training</a>
                </li>
                <li class="@if($tab == 'reference') active @endif">
                    <a @if(isset($id)) href="#tab1_8" data-toggle="tab" @endif aria-expanded="true">Reference</a>
                </li>
                <li class="@if($tab == 'children') active @endif">
                    <a @if(isset($id)) href="#tab1_9" data-toggle="tab" @endif aria-expanded="true">Children</a>
                </li>
            </ul>
        </div>

        <div class="panel-body">
            <div class="tab-content pn br-n">
                <div id="tab1_1" class="tab-pane @if($tab == '') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url('employee/add')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('employee_no')?'has-error':''}}">
                                            <label class="control-label">Employee No : <span class="text-danger">*</span></label>
                                            <input type="text" name="employee_no" value="{{($user->employee_no)?$user->employee_no:old('employee_no')}}" class="form-control input-sm" placeholder="Enter Employee No">
                                            @if($errors->has('employee_no'))<span class="help-block">{{$errors->first('employee_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('designation_id')?'has-error':''}}">
                                            <label class="control-label">Employee Designation : <span class="text-danger">*</span></label>
                                             <?php $designation_id = ($user->designation_id)? $user->designation_id: old('designation_id'); ?>
                                            <select class="form-control input-sm" name="designation_id">
                                                <option value="">---- Select Employee Designation ----</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->id}}" @if($designation->id == $designation_id) selected="selected" @endif>{{$designation->designation_name}}</option>
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
                                            <label class="control-label">First Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" value="{{($user->first_name)?$user->first_name:old('first_name')}}" class="form-control input-sm" placeholder="Enter First Name">
                                            @if($errors->has('first_name'))<span class="help-block">{{$errors->first('first_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Middle Name : </label>
                                            <input type="text" name="middle_name" value="{{($user->middle_name)?$user->middle_name:old('middle_name')}}" class="form-control input-sm" placeholder="Enter Middle Name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('last_name')?'has-error':''}}">
                                            <label class="control-label">Last Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" value="{{($user->last_name)?$user->last_name:old('last_name')}}" class="form-control input-sm" placeholder="Enter Last Name">
                                            @if($errors->has('last_name'))<span class="help-block">{{$errors->first('last_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Nick Name</label>
                                            <input type="text" name="nick_name" value="{{ ($user->nick_name)?$user->nick_name:old('nick_name')}}" class="form-control input-sm" placeholder="Enter Nick Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                            <label class="control-label">Email Address : <span class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{($user->email)?$user->email:old('email')}}" class="form-control input-sm" placeholder="Enter Email Address">
                                            @if($errors->has('email'))<span class="help-block">{{$errors->first('email')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mobile_number')?'has-error':''}}">
                                            <label class="control-label">Mobile Number : <span class="text-danger">*</span></label>
                                            <input type="number" name="mobile_number" value="{{($user->mobile_number)?$user->mobile_number:old('mobile_number')}}" class="form-control input-sm" placeholder="Enter Mobile Number">
                                            @if($errors->has('mobile_number'))<span class="help-block">{{$errors->first('mobile_number')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('password')?'has-error':''}}">
                                            <label class="control-label">Password : <span class="text-danger">*</span></label>
                                            <input type="password" name="password" value="{{old('password')}}" class="form-control input-sm" placeholder="Enter Password">
                                            @if($errors->has('password'))<span class="help-block">{{$errors->first('password')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('retype_password')?'has-error':''}}">
                                            <label class="control-label">Retype Password : <span class="text-danger">*</span></label>
                                            <input type="password" name="retype_password" class="form-control input-sm" placeholder="Enter Retype Password">
                                            @if($errors->has('retype_password'))<span class="help-block">{{$errors->first('retype_password')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 pt50">
                                        <label class="control-label">Employee Photo :</label>
                                        <div class="fileupload fileupload-new admin-form" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail mb15">
                                                @if($user->photo)
                                                <img src="{{$user->full_image}}" alt="holder">
                                                @else
                                                <img src="http://placehold.it/250x250" alt="holder">
                                                @endif
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
                                                    <label class="control-label">Division : <span class="text-danger">*</span></label>
                                                    <select class="form-control input-sm" name="present_division_id">
                                                        <option value="">---- Select Division ----</option>
                                                        @foreach($divisions as $division)
                                                            <option value="{{$division->id}}" @if($division->id == old('present_division_id')) {{"selected"}} @endif>{{$division->division_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('present_division_id'))<span class="help-block">{{$errors->first('present_division_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('present_district_id')?'has-error':''}}">
                                                    <label class="control-label">District : <span class="text-danger">*</span></label>
                                                    <select class="form-control input-sm" name="present_district_id">
                                                        <option value="">---- Select Employee Designation ----</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}" @if($district->id == old('present_district_id')) {{"selected"}} @endif>{{$district->district_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('present_district_id'))<span class="help-block">{{$errors->first('present_district_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('present_policestation_id')?'has-error':''}}">
                                                    <label class="control-label">Police Station : <span class="text-danger">*</span></label>
                                                    <select class="form-control input-sm" name="present_policestation_id">
                                                        <option value="">---- Select Police Station ----</option>
                                                        @foreach($police_stations as $police_station)
                                                            <option value="{{$police_station->id}}" @if($police_station->id == old('present_policestation_id')) {{"selected"}} @endif>{{$police_station->police_station_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('present_policestation_id'))<span class="help-block">{{$errors->first('present_policestation_id')}}</span>@endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('present_postoffice')?'has-error':''}}">
                                                    <label class="control-label">Post Office : <span class="text-danger">*</span></label>
                                                    <input type="text" name="present_postoffice" value="{{old('present_postoffice')}}" class="form-control input-sm" placeholder="Enter Post Office">
                                                    @if($errors->has('present_postoffice'))<span class="help-block">{{$errors->first('present_postoffice')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group {{$errors->has('present_address')?'has-error':''}}">
                                                    <label class="control-label">Address : <span class="text-danger">*</span></label>
                                                    <textarea name="present_address" class="form-control input-sm" cols="60" rows="1" placeholder="House, Road, Village.">{{old('present_address')}}</textarea>
                                                    @if($errors->has('present_address'))<span class="help-block">{{$errors->first('present_address')}}</span>@endif
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
                                                    <label class="control-label">Division : <span class="text-danger">*</span></label>
                                                    <select class="form-control input-sm" name="permanent_division_id">
                                                        <option value="">---- Select Division ----</option>
                                                        @foreach($divisions as $division)
                                                            <option value="{{$division->id}}" @if($division->id == old('permanent_division_id')) {{"selected"}} @endif>{{$division->division_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('permanent_division_id'))<span class="help-block">{{$errors->first('permanent_division_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('permanent_district_id')?'has-error':''}}">
                                                    <label class="control-label">District : <span class="text-danger">*</span></label>
                                                    <select class="form-control input-sm" name="permanent_district_id">
                                                        <option value="">---- Select Employee Designation ----</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{$district->id}}" @if($district->id == old('permanent_district_id')) {{"selected"}} @endif>{{$district->district_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('permanent_district_id'))<span class="help-block">{{$errors->first('permanent_district_id')}}</span>@endif
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('permanent_policestation_id')?'has-error':''}}">
                                                    <label class="control-label">Police Station : <span class="text-danger">*</span></label>
                                                    <select class="form-control input-sm" name="permanent_policestation_id">
                                                        <option value="">---- Select Police Station ----</option>
                                                        @foreach($police_stations as $police_station)
                                                            <option value="{{$police_station->id}}" @if($police_station->id == old('permanent_policestation_id')) {{"selected"}} @endif>{{$police_station->police_station_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('permanent_policestation_id'))<span class="help-block">{{$errors->first('permanent_policestation_id')}}</span>@endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group {{$errors->has('permanent_postoffice')?'has-error':''}}">
                                                    <label class="control-label">Post Office : <span class="text-danger">*</span></label>
                                                    <input type="text" name="permanent_postoffice" value="{{old('permanent_postoffice')}}" class="form-control input-sm" placeholder="Enter Post Office">
                                                    @if($errors->has('permanent_postoffice'))<span class="help-block">{{$errors->first('permanent_postoffice')}}</span>@endif
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group {{$errors->has('permanent_address')?'has-error':''}}">
                                                    <label class="control-label">Address : <span class="text-danger">*</span></label>
                                                    <textarea name="permanent_address" class="form-control input-sm" cols="60" rows="1" placeholder="House, Road, Village.">{{old('permanent_address')}}</textarea>
                                                    @if($errors->has('permanent_address'))<span class="help-block">{{$errors->first('permanent_address')}}</span>@endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button @if(isset($id)) disabled="disabled" @endif type="submit" name="save_next" value="save_next" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Create & Next <span class="glyphicons glyphicons-right_arrow"></span></button>
                                        </p>
                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button @if(isset($id)) disabled="disabled" @endif type="submit" name="add_employee" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Create Employee</button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!--- Personal Info ---->
                <div id="tab1_2" class="tab-pane @if($tab == 'personal') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url('employee/add')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('user_id')?'has-error':''}}">
                                            <label class="control-label">Employee Full Name:</label>
                                            <input type="text" name="user_id" value="{{($user->fullname)?$user->fullname:''}}" class="form-control input-sm" disabled>
                                            @if($errors->has('user_id'))<span class="help-block">{{$errors->first('user_id')}}</span>@endif
                                        </div>
                                    </div>

                                   <div class="col-md-3">
                                        <div class="form-group {{$errors->has('father_name')?'has-error':''}}">
                                            <label class="control-label">Father Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="father_name" value="{{($user->father_name)?$user->father_name:old('father_name')}}" class="form-control input-sm" placeholder="Enter Father Name">
                                            @if($errors->has('father_name'))<span class="help-block">{{$errors->first('father_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mother_name')?'has-error':''}}">
                                            <label class="control-label">Father Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="mother_name" value="{{($user->mother_name)?$user->mother_name:old('mother_name')}}" class="form-control input-sm" placeholder="Enter Mother Name">
                                            @if($errors->has('mother_name'))<span class="help-block">{{$errors->first('mother_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('national_id')?'has-error':''}}">
                                            <label class="control-label">National Id : <span class="text-danger">*</span></label>
                                            <input type="text" name="national_id" value="{{($user->national_id)?$user->national_id:old('national_id')}}" class="form-control input-sm" placeholder="Enter National Id">
                                            @if($errors->has('national_id'))<span class="help-block">{{$errors->first('national_id')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('passport_no')?'has-error':''}}">
                                            <label class="control-label">Passport No : <span class="text-danger">*</span></label>
                                            <input type="text" name="passport_no" value="{{($user->passport_no)?$user->passport_no:old('passport_no')}}" class="form-control input-sm" placeholder="Enter Passport No">
                                            @if($errors->has('passport_no'))<span class="help-block">{{$errors->first('passport_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('tin_no')?'has-error':''}}">
                                            <label class="control-label">Tin No : <span class="text-danger">*</span></label>
                                            <input type="text" name="tin_no" value="{{($user->tin_no)?$user->tin_no:old('tin_no')}}" class="form-control input-sm" placeholder="Enter Tin No">
                                            @if($errors->has('tin_no'))<span class="help-block">{{$errors->first('tin_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('personal_email')?'has-error':''}}">
                                            <label class="control-label">Personal Email : <span class="text-danger">*</span></label>
                                            <input type="text" name="personal_email" value="{{($user->personal_email)?$user->personal_email:old('personal_email')}}" class="form-control input-sm" placeholder="Enter Personal Email">
                                            @if($errors->has('personal_email'))<span class="help-block">{{$errors->first('personal_email')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('official_email')?'has-error':''}}">
                                            <label class="control-label">Official Email : <span class="text-danger">*</span></label>
                                            <input type="text" name="official_email" value="{{($user->official_email)?$user->official_email:old('official_email')}}" class="form-control input-sm" placeholder="Enter Official Email">
                                            @if($errors->has('official_email'))<span class="help-block">{{$errors->first('official_email')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('phone_number')?'has-error':''}}">
                                            <label class="control-label">Phone Number : <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" value="{{($user->phone_number)?$user->phone_number:old('phone_number')}}" class="form-control input-sm" placeholder="Enter Phone Number">
                                            @if($errors->has('phone_number'))<span class="help-block">{{$errors->first('phone_number')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('birth_date')?'has-error':''}}">
                                            <label class="control-label">Birth Date : <span class="text-danger">*</span></label>
                                            <input type="text" id="datetimepicker1" name="birth_date" value="{{($user->birth_date)?$user->birth_date:old('birth_date')}}" class="form-control input-sm" placeholder="Enter Birth Date" readonly="readonly">
                                            @if($errors->has('birth_date'))<span class="help-block">{{$errors->first('birth_date')}}</span>@endif
                                        </div>
                                    </div>

                                     <div class="col-md-3">
                                        <div class="form-group {{$errors->has('joining_date')?'has-error':''}}">
                                            <label class="control-label">Joining Date : <span class="text-danger">*</span></label>
                                            <input type="text" id="datetimepicker2" name="joining_date" value="{{($user->joining_date)?$user->joining_date:old('joining_date')}}" class="form-control input-sm" placeholder="Enter Joining Date" readonly="readonly">
                                            @if($errors->has('joining_date'))<span class="help-block">{{$errors->first('joining_date')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('blood_group_id')?'has-error':''}}">
                                            <label class="control-label">Blood Group :</label>
                                            <select class="form-control input-sm" name="blood_group_id">
                                                <option value="">---- Select Blood Group ----</option>
                                                @foreach($blood_groups as $blood_group)
                                                    <option value="{{$blood_group->id}}">{{$blood_group->blood_name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('blood_group_id'))<span class="help-block">{{$errors->first('blood_group_id')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('gender')?'has-error':''}}">
                                            <label class="control-label">Gender : <span class="text-danger">*</span></label>
                                            <div class="radio-custom mb5">
                                              <input id="male" name="gender" type="radio" value="male">
                                              <label for="male">Male</label>

                                              <input id="female" name="gender" type="radio" value="female">
                                              <label for="female">Female</label>
                                            </div>
                                            @if($errors->has('gender'))<span class="help-block">{{$errors->first('gender')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('marital_status')?'has-error':''}}">
                                            <label class="control-label">Marital Status : <span class="text-danger">*</span></label>
                                            <div class="radio-custom mb5">
                                              <input id="married" name="marital_status" type="radio" value="married">
                                              <label for="married">Married</label>

                                              <input id="unmarried" name="marital_status" type="radio" value="unmarried">
                                              <label for="unmarried">Unmarried</label>
                                            </div>
                                            @if($errors->has('marital_status'))<span class="help-block">{{$errors->first('marital_status')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('religion')?'has-error':''}}">
                                            <label class="control-label">Religion :</label>
                                            <select class="form-control input-sm" name="religion">
                                                <option value="">---- Select Religion ----</option>
<!--                                                 @foreach($blood_groups as $blood_group)
                                                    <option value="{{$blood_group->id}}">{{$blood_group->blood_name}}</option>
                                                @endforeach -->
                                            </select>
                                            @if($errors->has('religion'))<span class="help-block">{{$errors->first('religion')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('nationality')?'has-error':''}}">
                                            <label class="control-label">Nationality :</label>
                                            <select class="form-control input-sm" name="nationality">
                                                <option value="">---- Select Nationality ----</option>
<!--                                                 @foreach($blood_groups as $blood_group)
                                                    <option value="{{$blood_group->id}}">{{$blood_group->blood_name}}</option>
                                                @endforeach -->
                                            </select>
                                            @if($errors->has('nationality'))<span class="help-block">{{$errors->first('nationality')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-3 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="save_personal" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Personal Info</button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div id="tab1_3" class="tab-pane @if($tab == 'education') active @endif">
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