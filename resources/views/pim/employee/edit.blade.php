@extends('layouts.hrms')
@section('content')

@section('style')
    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-tools/admin-forms/css/admin-forms.css')}}">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/plugins/magnific/magnific-popup.css')}}">
@endsection

<section class="animated fadeIn p10" id="employee">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title hidden-xs"><span class="glyphicons glyphicons-user_add"></span> Add New Employee</span>
            <ul class="nav panel-tabs-border panel-tabs">
                <li class="@if($tab == '') active @endif">
                    <a id="" href="#tab1_1" v-on:click="tab = ''" data-toggle="tab" aria-expanded="true">Basic</a>
                </li>
                <li class="@if(isset($id) && $tab == 'personal') active @endif">
                    <a id="personal" @if(isset($id)) href="#tab1_2" v-on:click="tab = 'personal'" data-toggle="tab" @endif aria-expanded="true">Personal</a>
                </li>
                <li class="@if(isset($id) && $tab == 'education') active @endif">
                    <a id="education" @if(isset($id)) href="#tab1_3" v-on:click="tab = 'education'" data-toggle="tab" @endif aria-expanded="true">Education</a>
                </li>
                <li class="@if(isset($id) && $tab == 'experience') active @endif">
                    <a id="experience" @if(isset($id)) href="#tab1_4" v-on:click="tab = 'experience'" data-toggle="tab" @endif aria-expanded="true">Experience</a>
                </li>
                <li class="@if(isset($id) && $tab == 'salary') active @endif">
                    <a id="salary" @if(isset($id)) href="#tab1_5" v-on:click="tab = 'salary'" data-toggle="tab" @endif aria-expanded="true">Salary</a>
                </li>
                <li class="@if(isset($id) && $tab == 'nominee') active @endif">
                    <a id="nominee" @if(isset($id)) href="#tab1_6" v-on:click="tab = 'nominee'" data-toggle="tab" @endif aria-expanded="true">Nominee</a>
                </li>
                <li class="@if(isset($id) && $tab == 'training') active @endif">
                    <a id="training" @if(isset($id)) href="#tab1_7" v-on:click="tab = 'training'" data-toggle="tab" @endif aria-expanded="true">Training</a>
                </li>
                <li class="@if(isset($id) && $tab == 'reference') active @endif">
                    <a id="reference" @if(isset($id)) href="#tab1_8" v-on:click="tab = 'reference'" data-toggle="tab" @endif aria-expanded="true">Reference</a>
                </li>
                <li class="@if(isset($id) && $tab == 'children') active @endif">
                    <a id="children" @if(isset($id)) href="#tab1_9" v-on:click="tab = 'children'" data-toggle="tab" @endif aria-expanded="true">Children</a>
                </li>
                <li class="@if(isset($id) && $tab == 'language') active @endif">
                    <a id="language" @if(isset($id)) href="#tab1_10" v-on:click="tab = 'language'" data-toggle="tab" @endif aria-expanded="true">Language</a>
                </li>
            </ul>
        </div>

        <div class="panel-body">
            <div class="tab-content pn br-n">

                <!--- Basic Info -->
                <div id="tab1_1" class="tab-pane @if($tab == '') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form action="{{url('employee/edit/'.$id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" :value="user_id" class="form-control input-sm">
                                <div v-for="(basic,index) in basics" v-if="index =='id'">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('employee_no')?'has-error':''}}">
                                                <label class="control-label">Employee No : <span class="text-danger">*</span></label>
                                                <input type="text" name="employee_no" :value="basics.employee_no" class="form-control input-sm" placeholder="Enter Employee No">
                                                @if($errors->has('employee_no'))<span class="help-block">{{$errors->first('employee_no')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('employee_type_id')?'has-error':''}}">
                                                <label class="control-label">Employee Type : <span
                                                            class="text-danger">*</span></label>
                                                <select class="form-control input-sm" id="employee_type_id" name="employee_type_id">
                                                    <option value="">...Select Employee Type...</option>
                                                    <option v-for="(employeeType,index) in employeeTypes" :value="employeeType.id" :selected="employeeType.id == basics.employee_type_id">@{{employeeType.type_name}}</option>
                                                </select>
                                                @if($errors->has('employee_type_id'))<span class="help-block">{{$errors->first('employee_type_id')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group {{$errors->has('designation_id')?'has-error':''}}">
                                                <label class="control-label">Employee Designation : <span
                                                            class="text-danger">*</span></label>
                                                <select class="select2-single form-control input-sm" id="designation_id"
                                                        name="designation_id">
                                                    <option>...Select Employee Designation...</option>
                                                    <option v-for="(designation,index) in designations" :selected="basics.designation.id == designation.id"
                                                            :value="designation.id">@{{designation.designation_name}} - ( @{{designation.level.level_name}} ) - (@{{designation.department.department_name}})</option>
                                                </select>
                                                @if($errors->has('designation_id'))<span
                                                        class="help-block">{{$errors->first('designation_id')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group mt25">
                                                <button type="button" id="add_new_designation_button"
                                                        onclick="modal_open('#add_new_designation_button','#add_new_designation_modal')"
                                                        v-on:click="getDepartmentsAndLevels()"
                                                        class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                        data-effect="mfp-newspaper"><span
                                                            class="glyphicons glyphicons-briefcase"></span> &nbsp; Add
                                                    Designation
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('first_name')?'has-error':''}}">
                                                <label class="control-label">First Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="first_name"
                                                       :value="basics.first_name"
                                                       class="form-control input-sm" placeholder="Enter First Name">
                                                @if($errors->has('first_name'))<span
                                                        class="help-block">{{$errors->first('first_name')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Middle Name : </label>
                                                <input type="text" name="middle_name"
                                                       :value="basics.middle_name"
                                                       class="form-control input-sm" placeholder="Enter Middle Name">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('last_name')?'has-error':''}}">
                                                <label class="control-label">Last Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="last_name"
                                                       :value="basics.last_name"
                                                       class="form-control input-sm" placeholder="Enter Last Name">
                                                @if($errors->has('last_name'))<span
                                                        class="help-block">{{$errors->first('last_name')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Nick Name</label>
                                                <input type="text" name="nick_name"
                                                       :value="basics.nick_name"
                                                       class="form-control input-sm" placeholder="Enter Nick Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                                <label class="control-label">Email Address : <span
                                                            class="text-danger">*</span></label>
                                                <input type="email" name="email"
                                                       :value="basics.email"
                                                       class="form-control input-sm" placeholder="Enter Email Address">
                                                @if($errors->has('email'))<span
                                                        class="help-block">{{$errors->first('email')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('mobile_number')?'has-error':''}}">
                                                <label class="control-label">Mobile Number : <span
                                                            class="text-danger">*</span></label>
                                                <input type="number" name="mobile_number"
                                                       :value="basics.mobile_number"
                                                       class="form-control input-sm" placeholder="Enter Mobile Number">
                                                @if($errors->has('mobile_number'))<span
                                                        class="help-block">{{$errors->first('mobile_number')}}</span>@endif
                                            </div>
                                        </div>

                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group {{$errors->has('password')?'has-error':''}}">--}}
                                                {{--<label class="control-label">Password : <span--}}
                                                            {{--class="text-danger">*</span></label>--}}
                                                {{--<input type="password" name="password" value="basics.password"--}}
                                                       {{--class="form-control input-sm" placeholder="Enter Password">--}}
                                                {{--@if($errors->has('password'))<span--}}
                                                        {{--class="help-block">{{$errors->first('password')}}</span>@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        {{--<div class="col-md-3">--}}
                                            {{--<div class="form-group {{$errors->has('retype_password')?'has-error':''}}">--}}
                                                {{--<label class="control-label">Retype Password : <span--}}
                                                            {{--class="text-danger">*</span></label>--}}
                                                {{--<input type="password" name="retype_password"--}}
                                                       {{--class="form-control input-sm"--}}
                                                       {{--placeholder="Enter Retype Password">--}}
                                                {{--@if($errors->has('retype_password'))<span--}}
                                                        {{--class="help-block">{{$errors->first('retype_password')}}</span>@endif--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 pt50">
                                            <label class="control-label">Employee Photo :</label>
                                            <div class="fileupload admin-form" :class="(basics.photo)?'fileupload-exists':'fileupload-new'"
                                                 data-provides="fileupload">
                                                <div class="fileupload-preview thumbnail mb15">
                                                    <img v-if="basics.photo" :src="'/files/'+basics.id+'/'+basics.photo" alt="holder">
                                                    <img v-else src="{{asset('img/placeholder.png')}}" alt="holder">
                                                </div>
                                                <span class="button btn btn-sm btn-dark btn-file btn-block ph5">
                                                    <span class="fileupload-exists"><span class="fa fa-user"></span> &nbsp; <strong>Change Photo</strong></span>
                                                    <span class="fileupload-new"><span class="fa fa-user"></span> &nbsp; <strong>Select Photo</strong></span>
                                                    <input type="file" name="image">
                                                    <input type="hidden" :value="basics.photo" name="old_image">
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
                                                        <label class="control-label">Division : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm" name="present_division_id"
                                                                v-model="present_division_id" :value="basics.address.present_division_id">
                                                            <option :value="''">---- Select Division ----</option>
                                                            <option v-for="(division, index) in divisions" :value="division.id" :selected="basics.address.present_division_id == division.id"
                                                                    >@{{ division.division_name }}</option>
                                                        </select>
                                                        @if($errors->has('present_division_id'))<span
                                                                class="help-block">{{$errors->first('present_division_id')}}</span>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group {{$errors->has('present_district_id')?'has-error':''}}">
                                                        <label class="control-label">District : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm" name="present_district_id"
                                                                v-model="present_district_id">
                                                            <option :value="''">---- Select District ----</option>
                                                            <option v-for="(district, index) in districts" :selected="basics.address.present_district_id == district.id"
                                                                    :value="district.id">@{{ district.district_name }}</option>
                                                        </select>
                                                        @if($errors->has('present_district_id'))<span
                                                                class="help-block">{{$errors->first('present_district_id')}}</span>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group {{$errors->has('present_policestation_id')?'has-error':''}}">
                                                        <label class="control-label">Police Station : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm"
                                                                name="present_policestation_id">
                                                            <option :value="''">---- Select Police Station ----</option>
                                                            <option v-for="(policeStation,index) in policeStations" :selected="basics.address.present_policestation_id == policeStation.id"
                                                                    :value="policeStation.id">@{{ policeStation.police_station_name }}</option>
                                                        </select>
                                                        @if($errors->has('present_policestation_id'))<span
                                                                class="help-block">{{$errors->first('present_policestation_id')}}</span>@endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group {{$errors->has('present_postoffice')?'has-error':''}}">
                                                        <label class="control-label">Post Office : <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" name="present_postoffice"
                                                               :value="basics.address.present_postoffice"
                                                               class="form-control input-sm"
                                                               placeholder="Enter Post Office">
                                                        @if($errors->has('present_postoffice'))<span
                                                                class="help-block">{{$errors->first('present_postoffice')}}</span>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group {{$errors->has('present_address')?'has-error':''}}">
                                                        <label class="control-label">Address : <span
                                                                    class="text-danger">*</span></label>
                                                        <textarea name="present_address" class="form-control input-sm"
                                                                  cols="60" rows="1"
                                                                  placeholder="House, Road, Village.">@{{basics.address.present_address}}</textarea>
                                                        @if($errors->has('present_address'))<span
                                                                class="help-block">{{$errors->first('present_address')}}</span>@endif
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
                                                        <label class="control-label">Division : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm"
                                                                name="permanent_division_id"
                                                                v-model="permanent_division_id">
                                                            <option :value="''">---- Select Division ----</option>
                                                            <option v-for="(division, index) in divisions"
                                                                    :value="division.id">@{{ division.division_name }}</option>
                                                        </select>
                                                        @if($errors->has('permanent_division_id'))<span
                                                                class="help-block">{{$errors->first('permanent_division_id')}}</span>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group {{$errors->has('permanent_district_id')?'has-error':''}}">
                                                        <label class="control-label">District : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm"
                                                                name="permanent_district_id"
                                                                v-model="permanent_district_id">
                                                            <option :value="''">---- Select Employee Designation ----
                                                            </option>
                                                            <option v-for="(district, index) in permanentDistricts"
                                                                    :value="district.id">@{{ district.district_name }}</option>
                                                        </select>
                                                        @if($errors->has('permanent_district_id'))<span
                                                                class="help-block">{{$errors->first('permanent_district_id')}}</span>@endif
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group {{$errors->has('permanent_policestation_id')?'has-error':''}}">
                                                        <label class="control-label">Police Station : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm"
                                                                name="permanent_policestation_id">
                                                            <option :value="''">---- Select Police Station ----</option>
                                                            <option v-for="(policeStation,index) in permanentPoliceStations"
                                                                    :value="policeStation.id">@{{ policeStation.police_station_name }}</option>
                                                        </select>
                                                        @if($errors->has('permanent_policestation_id'))<span
                                                                class="help-block">{{$errors->first('permanent_policestation_id')}}</span>@endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group {{$errors->has('permanent_postoffice')?'has-error':''}}">
                                                        <label class="control-label">Post Office : <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" name="permanent_postoffice"
                                                               :value="basics.address.permanent_postoffice"
                                                               class="form-control input-sm"
                                                               placeholder="Enter Post Office">
                                                        @if($errors->has('permanent_postoffice'))<span
                                                                class="help-block">{{$errors->first('permanent_postoffice')}}</span>@endif
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group {{$errors->has('permanent_address')?'has-error':''}}">
                                                        <label class="control-label">Address : <span
                                                                    class="text-danger">*</span></label>
                                                        <textarea name="permanent_address" class="form-control input-sm"
                                                                  cols="60" rows="1"
                                                                  placeholder="House, Road, Village.">@{{basics.address.permanent_address}}</textarea>
                                                        @if($errors->has('permanent_address'))<span
                                                                class="help-block">{{$errors->first('permanent_address')}}</span>@endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr class="short alt">

                                <div class="section row mbn">
                                        <div class="col-sm-2 pull-right">
                                            <p class="text-left">
                                                <button type="submit"
                                                        name="update_next" value="update_next"
                                                        class="btn btn-dark btn-gradient dark btn-block"><span
                                                            class="glyphicons glyphicons-ok_2"></span> &nbsp; Update &
                                                    Next
                                                    <span class="glyphicons glyphicons-right_arrow"></span></button>
                                            </p>
                                        </div>
                                        <div class="col-sm-2 pull-right">
                                            <p class="text-left">
                                                <button type="submit"
                                                        name="update_employee" value="update_employee"
                                                        class="btn btn-dark btn-gradient dark btn-block"><span
                                                            class="glyphicons glyphicons-ok_2"></span> &nbsp; Update
                                                    Employee
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!--- Personal Info -->
                <div id="tab1_2" class="tab-pane @if(isset($id) && $tab == 'personal') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_personal_info_form" v-on:submit.prevent="addPersonalInfo" method="post">
                                <div v-if="personals.details">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Employee Full Name:</label>
                                                <input type="text"
                                                       value="@if(isset($user->fullname)){{$user->fullname}}@endif"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Father Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" :value="personals.details.father_name"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Father Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text"
                                                       :value="personals.details.mother_name"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">National Id : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" :value="personals.details.national_id"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Passport No :</label>
                                                <input type="text" :value="personals.details.passport_no"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tin No :</label>
                                                <input type="text" :value="personals.details.tin_no"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Personal Email : <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm"
                                                       :value="personals.details.personal_email" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Official Email : <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control input-sm" disabled="disabled"
                                                       :value="personals.details.official_email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Phone Number : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text"
                                                       :value="personals.details.phone_number"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Birth Date :</label>
                                                <input type="text"
                                                       :value="personals.details.birth_date"
                                                       class="datepicker form-control input-sm"
                                                       disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Joining Date : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text"
                                                       :value="personals.details.joining_date"
                                                       class="datepicker form-control input-sm"
                                                       disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Blood Group :</label>
                                                <input type="text"
                                                       :value="personals.details.blood_group.blood_name"
                                                       class="form-control input-sm"
                                                       disabled="disabled">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Gender : <span class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="male" type="radio" disabled="disabled"
                                                           :checked="personals.details.gender == 'male'">
                                                    <label for="male">Male</label>

                                                    <input id="female" type="radio" disabled="disabled"
                                                           :checked="personals.details.gender =='female'">
                                                    <label for="female">Female</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Marital Status : <span class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="married" type="radio" disabled="disabled"
                                                           :checked="personals.details.marital_status == 'married'">
                                                    <label for="married">Married</label>

                                                    <input id="unmarried" type="radio" disabled="disabled"
                                                           :checked="personals.details.marital_status == 'unmarried'">
                                                    <label for="unmarried">Unmarried</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Religion :</label>
                                                <input type="text" :value="personals.details.religion"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Nationality :</label>
                                                <input type="text" :value="personals.details.nationality"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Emergency Contact Person :</label>
                                                <input type="text" :value="personals.details.emergency_contact_person"
                                                       class="form-control input-sm" disabled="disabled">
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="control-label">Emergency Contact Address :</label>
                                                <textarea class="form-control input-sm" cols="60" rows="1"
                                                          disabled="disabled">@{{personals.details.emergency_contact_address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.user_id}">
                                                <label class="control-label">Employee Full Name:</label>
                                                <input type="text" :value="personals.first_name+' '+personals.last_name"
                                                       class="form-control input-sm" disabled>
                                                <input type="hidden" name="user_id" :value="user_id"
                                                       class="form-control input-sm">
                                                <span v-if="errors.user_id" class="text-danger">@{{ errors.user_id[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.father_name}">
                                                <label class="control-label">Father Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="father_name"
                                                       value="{{old('father_name')}}"
                                                       class="form-control input-sm" placeholder="Enter Father Name">
                                                <span v-if="errors.father_name" class="text-danger">@{{ errors.father_name[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.mother_name}">
                                                <label class="control-label">Mother Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="mother_name" value="{{old('mother_name')}}"
                                                       class="form-control input-sm" placeholder="Enter Mother Name">
                                                <span v-if="errors.mother_name" class="text-danger">@{{ errors.mother_name[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.national_id}">
                                                <label class="control-label">National Id : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="national_id" value="{{old('national_id')}}"
                                                       class="form-control input-sm" placeholder="Enter National Id">
                                                <span v-if="errors.national_id" class="text-danger">@{{ errors.national_id[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.passport_no}">
                                                <label class="control-label">Passport No :</label>
                                                <input type="text" name="passport_no" value="{{old('passport_no')}}"
                                                       class="form-control input-sm" placeholder="Enter Passport No">
                                                <span v-if="errors.passport_no" class="text-danger">@{{ errors.passport_no[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.tin_no}">
                                                <label class="control-label">Tin No :</label>
                                                <input type="text" name="tin_no" value="{{old('tin_no')}}"
                                                       class="form-control input-sm" placeholder="Enter Tin No">
                                                <span v-if="errors.tin_no" class="text-danger">@{{ errors.tin_no[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.personal_email}">
                                                <label class="control-label">Personal Email : <span class="text-danger">*</span></label>
                                                <input type="text" name="personal_email"
                                                       value="{{old('personal_email')}}" class="form-control input-sm"
                                                       placeholder="Enter Personal Email">
                                                <span v-if="errors.personal_email" class="text-danger">@{{ errors.personal_email[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.official_email}">
                                                <label class="control-label">Official Email : <span class="text-danger">*</span></label>
                                                <input type="text" name="official_email"
                                                       value="{{old('official_email')}}" class="form-control input-sm"
                                                       placeholder="Enter Official Email">
                                                <span v-if="errors.official_email" class="text-danger">@{{ errors.official_email[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.phone_number}">
                                                <label class="control-label">Phone Number : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="phone_number" value="{{old('phone_number')}}"
                                                       class="form-control input-sm" placeholder="Enter Phone Number">
                                                <span v-if="errors.phone_number" class="text-danger">@{{ errors.phone_number[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.birth_date}">
                                                <label class="control-label">Birth Date :</label>
                                                <input type="text" name="birth_date" value="{{old('birth_date')}}"
                                                       class="datepicker form-control input-sm"
                                                       placeholder="Enter Birth Date" readonly="readonly">
                                                <span v-if="errors.birth_date" class="text-danger">@{{ errors.birth_date[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.joining_date}">
                                                <label class="control-label">Joining Date : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="joining_date" value="{{old('joining_date')}}"
                                                       class="datepicker form-control input-sm"
                                                       placeholder="Enter Joining Date" readonly="readonly">
                                                <span v-if="errors.joining_date" class="text-danger">@{{ errors.joining_date[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.blood_group_id}">
                                                <label class="control-label">Blood Group :</label>
                                                <select class="form-control input-sm" name="blood_group_id">
                                                    <option value="0">---- Select Blood Group ----</option>
                                                    <option v-bind:value="blood_group.id"
                                                            v-for="(blood_group, index) in blood_group">@{{ blood_group.blood_name}}</option>
                                                </select>
                                                <span v-if="errors.blood_group_id" class="text-danger">@{{ errors.blood_group_id[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.gender}">
                                                <label class="control-label">Gender : <span class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="male" name="gender" type="radio" value="male"
                                                           @if(old('gender') == 'male') checked="checked" @endif>
                                                    <label for="male">Male</label>

                                                    <input id="female" name="gender" type="radio" value="female"
                                                           @if(old('gender') == 'female') checked="checked" @endif>
                                                    <label for="female">Female</label>
                                                </div>
                                                <span v-if="errors.gender" class="text-danger">@{{ errors.gender[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.marital_status}">
                                                <label class="control-label">Marital Status : <span class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="married" name="marital_status" type="radio"
                                                           value="married"
                                                           @if(old('marital_status') == 'married') checked="checked" @endif>
                                                    <label for="married">Married</label>

                                                    <input id="unmarried" name="marital_status" type="radio"
                                                           value="unmarried"
                                                           @if(old('marital_status') == 'unmarried') checked="checked" @endif>
                                                    <label for="unmarried">Unmarried</label>
                                                </div>
                                                <span v-if="errors.marital_status" class="text-danger">@{{ errors.marital_status[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.religion}">
                                                <label class="control-label">Religion :</label>
                                                <input type="text" name="religion" value="{{old('religion')}}"
                                                       class="form-control input-sm" placeholder="Enter Religion">
                                                <span v-if="errors.religion" class="text-danger">@{{ errors.religion[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.nationality}">
                                                <label class="control-label">Nationality :</label>
                                                <input type="text" name="nationality" value="{{old('nationality')}}"
                                                       class="form-control input-sm" placeholder="Enter Nationality">
                                                <span v-if="errors.nationality" class="text-danger">@{{ errors.nationality[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.emergency_contact_person}">
                                                <label class="control-label">Emergency Contact Person :</label>
                                                <input type="text" name="emergency_contact_person"
                                                       value="{{old('emergency_contact_person')}}"
                                                       class="form-control input-sm"
                                                       placeholder="Emergency Contact Person">
                                                <span v-if="errors.emergency_contact_person" class="text-danger">@{{ errors.emergency_contact_person[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group" :class="{'has-error': errors.emergency_contact_address}">
                                                <label class="control-label">Emergency Contact Address :</label>
                                                <textarea name="emergency_contact_address" class="form-control input-sm"
                                                          cols="60" rows="1"
                                                          placeholder="Emergency Contact Address">{{old('emergency_contact_address')}}</textarea>
                                                <span v-if="errors.emergency_contact_address" class="text-danger">@{{ errors.emergency_contact_address[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button :disabled="personals.details" type="submit"
                                                    name="save_personal_and_next" value="save_personal_and_next"
                                                    v-on:click="submit_button='save_personal_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block">
                                                <span class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button :disabled="personals.details" type="submit" name="save_personal"
                                                    value="save_personal"
                                                    v-on:click="submit_button='save_personal'"
                                                    class="btn btn-dark btn-gradient dark btn-block">
                                                <span class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Personal
                                                Info
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!--- Education Info -->
                <div id="tab1_3" class="tab-pane @if(isset($id) && $tab == 'education') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_education_from" v-on:submit.prevent="addNewEducation" method="post" enctype="multipart/form-data">

                                <!-- start v-if -->
                                <div v-if="educations.educations !=''">
                                    <div v-for="(education, index) in educations.educations">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Education Level :</label>
                                                    <input type="text"
                                                           :value="education.institute.education_level.education_level_name"
                                                           class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Institute :</label>
                                                    <input type="text" :value="education.institute.institute_name"
                                                           class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Degree :</label>
                                                    <input type="text" :value="education.degree.degree_name"
                                                           class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Pass Year : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" :value="education.pass_year"
                                                           class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Result Type :</label>
                                                    <div class="radio-custom mb5">
                                                        <input id="result_type_cgpa"
                                                               :checked="education.result_type=='cgpa'" type="radio"
                                                               disabled="disabled" type="radio">
                                                        <label for="result_type_cgpa">CGPA</label>

                                                        <input id="result_type_division" type="radio"
                                                               :checked="education.result_type=='division'"
                                                               disabled="disabled">
                                                        <label for="result_type_division">Division</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3" v-if="education.result_type=='cgpa'">
                                                <div class="form-group">
                                                    <label class="control-label">CGPA :</label>
                                                    <input type="text" :value="education.cgpa" disabled="disabled"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3" v-if="education.result_type=='division'">
                                                <div class="form-group">
                                                    <label class="control-label">Division :</label>
                                                    <input type="text" :value="education.division" disabled="disabled" class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3" v-if="education.certificate">
                                                <div class="form-group">
                                                    <label class="control-label">Certificate:</label>
                                                    <div>
                                                        <a :href="'/files/'+education.user_id+'/'+education.certificate" target="_blank" class="text-success">
                                                            <i class="fa fa-2x fa-file-image-o"></i>
                                                            Click here to view certificate
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">

                                    </div>
                                </div>
                                <!-- end v-if -->

                                <!-- start v-else -->
                                <div v-else>
                                    <div class="row">
                                        <div class="col-md-3" v-if="educations !=''">
                                            <div class="form-group" :class="{'has-error': errors.user_id}">
                                                <label class="control-label">Employee Full Name:</label>
                                                <input type="text" :value="educations.first_name+' '+educations.last_name"
                                                       class="form-control input-sm" disabled>
                                                <input type="hidden" name="user_id"
                                                       :value="user_id"
                                                       class="form-control input-sm">
                                                <span v-if="errors.user_id" class="text-danger">@{{ errors.user_id[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.education_level_id}">
                                                <label class="control-label">Education Level : <span
                                                            class="text-danger">*</span></label>
                                                <select class="form-control input-sm" name="education_level_id"
                                                        v-on:change="getInstituteAndDegreeByEducationLevelId()"
                                                        v-model="education_level_id">
                                                    <option v-bind:value="''">---- Select Education Level ----</option>
                                                    <option v-bind:value="education_level.id"
                                                            v-for="(education_level, index) in education_levels">@{{ education_level.education_level_name }}</option>
                                                </select>
                                                <span v-if="errors.education_level_id" class="text-danger">@{{ errors.education_level_id[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.institute_id}">
                                                <label class="control-label">Institute : <span
                                                            class="text-danger">*</span></label>
                                                <select class="select2-single form-control input-sm" name="institute_id">
                                                    <option v-bind:value="''">---- Select Institute ----</option>
                                                    <option v-bind:value="institute.id"
                                                            v-for="(institute, index) in institutes">@{{ institute.institute_name }}</option>
                                                </select>
                                                <span v-if="errors.institute_id" class="text-danger">@{{ errors.institute_id[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.degree_id}">
                                                <label class="control-label">Degree : <span
                                                            class="text-danger">*</span></label>
                                                <select class="select2-single form-control input-sm" name="degree_id">
                                                    <option v-bind:value="''">---- Select Degree ----</option>
                                                    <option v-bind:value="degree.id"
                                                            v-for="(degree, index) in degrees">@{{ degree.degree_name }}</option>
                                                </select>
                                                <span v-if="errors.degree_id" class="text-danger">@{{ errors.degree_id[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.pass_year}">
                                                <label class="control-label">Pass Year : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="pass_year" class="date form-control input-sm"
                                                       readonly="">
                                                <span v-if="errors.pass_year" class="text-danger">@{{ errors.pass_year[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.certificate_file}">
                                                <label class="control-label">Certificate:</label>
                                                <input type="file" name="certificate_file"
                                                       class="form-control btn-primary input-sm">
                                                <span v-if="errors.certificate_file" class="text-danger">@{{ errors.certificate_file[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.result_type}">
                                                <label class="control-label">Result Type : <span
                                                            class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="result_type_cgpa" name="result_type" type="radio"
                                                           value="cgpa"
                                                           @if(old('result_type') == 'cgpa') checked="checked" @endif
                                                           v-on:click="showCgpa=true,showDivision=false">
                                                    <label for="result_type_cgpa">CGPA</label>

                                                    <input id="result_type_division" name="result_type" type="radio"
                                                           @if(old('result_type') == 'division') checked="checked"
                                                           @endif
                                                           value="division"
                                                           v-on:click="showCgpa=false,showDivision=true">
                                                    <label for="result_type_division">Division</label>
                                                </div>
                                                <span v-if="errors.result_type" class="text-danger">@{{ errors.result_type[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3" v-if="showCgpa">
                                            <div class="form-group" :class="{'has-error': errors.cgpa}">
                                                <label class="control-label">CGPA : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="cgpa" value="{{old('cgpa')}}"
                                                       class="form-control input-sm" placeholder="Enter CGPA">
                                                <span v-if="errors.cgpa" class="text-danger">@{{ errors.cgpa[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3" v-if="showDivision">
                                            <div class="form-group" :class="{'has-error': errors.division}">
                                                <label class="control-label">Division : <span
                                                            class="text-danger">*</span></label>
                                                <select name="division" class="form-control input-sm">
                                                    <option value="">--- Select Division ---</option>
                                                    <option value="1" @if(old('division') == 1) {{"selected"}} @endif>
                                                        First Division
                                                    </option>
                                                    <option value="2" @if(old('division') == 2) {{"selected"}} @endif>
                                                        Second Division
                                                    </option>
                                                    <option value="3" @if(old('division') == 3) {{"selected"}} @endif>
                                                        Third Division
                                                    </option>
                                                </select>
                                                <span v-if="errors.division" class="text-danger">@{{ errors.division[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end v-else -->

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_education" :disabled="educations.educations ==''"
                                                    onclick="modal_open('#add_education','#add_new_education_modal')"
                                                    class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span
                                                        class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New
                                                Education
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="educations.educations !=''"
                                                    name="save_education_and_next" value="save_education_and_next" v-on:click="submit_button='save_education_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block">
                                                <span class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="educations.educations !=''"
                                                    name="save_education" value="save_education" v-on:click="submit_button='save_education'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Education
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!---  Experience Info -->
                <div id="tab1_4" class="tab-pane @if(isset($id) && $tab == 'experience') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_experience_form" v-on:submit.prevent="addNewExperience" method="post">

                                <!-- start v-if -->
                                <div v-if="experiences.length>0">
                                    <!-- start v-for in experiences   -->
                                    <div v-for="(experience, index) in experiences">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">company_name : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control input-sm"
                                                           :value="experience.company_name" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Position Held : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control input-sm"
                                                           :value="experience.position_held" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Job Start Date : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control input-sm"
                                                           :value="experience.job_start_date" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Job End Date : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control input-sm"
                                                           :value="experience.job_end_date" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Job Duration : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" class="form-control input-sm"
                                                           :value="experience.job_duration+' years'"
                                                           disabled="disabled">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Job Responsibility : <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control input-sm" disabled="disabled">@{{experience.job_responsibility}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Job Location : <span class="text-danger">*</span></label>
                                                    <textarea type="text" class="form-control input-sm" disabled="disabled">@{{experience.job_location}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="short alt">
                                    </div>
                                    <!-- end v-for -->
                                </div>

                                <!-- start v-else -->
                                <div v-else>
                                    <input type="hidden" name="user_id" :value="user_id" class="form-control input-sm">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.company_name}">
                                                <label class="control-label">Company Name : <span class="text-danger">*</span></label>
                                                <input type="text" name="company_name" class="form-control input-sm">
                                                <span v-if="errors.company_name" class="text-danger">@{{ errors.company_name[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.position_held}">
                                                <label class="control-label">Position Held : <span class="text-danger">*</span></label>
                                                <input type="text" name="position_held" class="form-control input-sm">
                                                <span v-if="errors.position_held" class="text-danger">@{{ errors.position_held[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.job_start_date}">
                                                <label class="control-label">Job Start Date : <span class="text-danger">*</span></label>
                                                <input type="text" id="job_start_date" name="job_start_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.job_start_date" class="text-danger">@{{ errors.job_start_date[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.job_end_date}">
                                                <label class="control-label">Job End Date : <span class="text-danger">*</span></label>
                                                <input type="text" name="job_end_date" id="job_end_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.job_end_date" class="text-danger">@{{ errors.job_end_date[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.job_duration}">
                                                <label class="control-label">Job Duration : <span class="text-danger">*</span></label>
                                                <input type="text" name="job_duration" v-on:click="theDuration" :value="job_duration" class="form-control input-sm" readonly="readonly">
                                                <span v-if="errors.job_duration" class="text-danger">@{{ errors.job_duration[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" :class="{'has-error': errors.job_responsibility}">
                                                <label class="control-label">Job Responsibility : <span class="text-danger">*</span></label>
                                                <textarea type="text" name="job_responsibility" class="form-control input-sm"></textarea>
                                                <span v-if="errors.job_responsibility" class="text-danger">@{{ errors.job_responsibility[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" :class="{'has-error': errors.job_location}">
                                                <label class="control-label">Job Location : <span class="text-danger">*</span></label>
                                                <textarea type="text" name="job_location" class="form-control input-sm"></textarea>
                                                <span v-if="errors.job_location" class="text-danger">@{{ errors.job_location[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end v-else -->

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_new_experience_button" :disabled="experiences.length<=0"
                                                    onclick="modal_open('#add_new_experience_button','#add_new_experience_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New
                                                Experience
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="experiences.length>0"
                                                    name="save_experience_and_next" v-on:click="submit_button='save_experience_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="experiences.length>0"
                                                    name="save_experience" v-on:click="submit_button='save_experience'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Experience
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!---  Salary Info -->
                <div id="tab1_5" class="tab-pane @if(isset($id) && $tab == 'salary') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_salary_form" v-on:submit.prevent="addSalary" method="post">
                                <input type="hidden" name="user_id" :value="user_id" class="form-control input-sm">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.basic_salary}">
                                            <label class="control-label">Basic Salary Amount: <span class="text-danger">*</span></label>
                                            <input type="text" name="basic_salary" class="form-control input-sm" :value="(salaries.basic_salary)?salaries.basic_salary:levelSalaryInfos.level_salary_amount" :readonly="salaries.basic_salary">
                                            <span v-if="errors.basic_salary" class="help-block">@{{errors.basic_salary[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.effective_date}">
                                            <label class="control-label">Salary Effective Date: <span class="text-danger">*</span></label>
                                            <input type="text" name="effective_date" :value="(salaries.effective_date)?salaries.effective_date:''" :readonly="salaries.effective_date" class="datepicker form-control input-sm">
                                            <span v-if="errors.effective_date" class="help-block">@{{errors.effective_date[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="admin-form">
                                    <div class="section-divider mb40">
                                        <span class="bg-white">Salary Allowance Information</span>
                                    </div>
                                </div>

                                <div class="row" v-if="salaries.salaries ==''">
                                    <div class="col-md-3 " v-for="levelSalaryInfo in levelSalaryInfos.salary_info">
                                        <div class="checkbox-custom mb5 pull-left">
                                            <input :id="levelSalaryInfo.basic_salary_info.id" type="checkbox" :name="'salary_info['+levelSalaryInfo.basic_salary_info.id+'][id]'" :value="levelSalaryInfo.basic_salary_info.id" checked="checked">

                                            <label :for="levelSalaryInfo.basic_salary_info.id" v-text="(levelSalaryInfo.basic_salary_info.amount_status==0)?levelSalaryInfo.basic_salary_info.name+' (%) ':levelSalaryInfo.basic_salary_info.name+' ($) '"></label>

                                        </div>

                                        <select class="col-md-2 form-control input-sm mb5" :name="'salary_info['+levelSalaryInfo.basic_salary_info.id+'][type]'">
                                            <option value="percent" :selected="levelSalaryInfo.basic_salary_info.amount_status ==0">Percent</option>
                                            <option value="fixed" :selected="levelSalaryInfo.basic_salary_info.amount_status ==1">Fixed</option>
                                        </select>

                                        <input type="number" :name="'salary_info['+levelSalaryInfo.basic_salary_info.id+'][amount]'" :value="levelSalaryInfo.amount" class="col-md-2 form-control input-sm mb5">

                                        <input type="text" :name="'salary_info['+levelSalaryInfo.basic_salary_info.id+'][effective_date]'" class="datepicker form-control input-sm">
                                    </div>
                                </div>

                                <div class="row" v-else>
                                    <div class="col-md-3 " v-for="salary in salaries.salaries">
                                        <div class="checkbox-custom mb5 pull-left">
                                            <input type="checkbox" checked="checked">
                                            <label v-text="salary.basic_salary_info.name+' ( '+salary.salary_amount_type+' ) '"></label>
                                        </div>

                                        <input type="text" :value="salary.salary_amount_type" class="col-md-2 form-control input-sm mb5" disabled="disabled">

                                        <input type="number" :value="salary.salary_amount" class="col-md-2 form-control input-sm mb5" disabled="disabled">

                                        <input type="text" :value="salary.salary_effective_date" class="datepicker form-control input-sm" disabled="disabled">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_more_allownce_button" :disabled="salaries.salaries !=''"
                                                    onclick="modal_open('#add_more_allownce_button','#add_more_allownce_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block" v-on:click="getAllowanceNotinLevel"
                                                    data-effect="mfp-with-fade"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add More Allowance
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="admin-form">
                                        <div class="section-divider mb40">
                                            <span class="bg-white">Salary Account Information</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.bank_id}">
                                            <label class="control-label">Bank Name : </label>
                                            <select class="form-control input-sm" name="bank_id" :disabled="salaries.salary_account">
                                                <option :value="''">---- Select Bank Name ----</option>
                                                <option v-for="(bank,index) in banks"
                                                        :value="bank.id">@{{ bank.bank_name }}</option>
                                            </select>
                                            <span v-if="errors.bank_id" class="help-block">@{{errors.bank_id[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.bank_account_no}">
                                            <label class="control-label">Account No : </label>
                                            <input type="text" name="bank_account_no" class="form-control input-sm" :disabled="salaries.salary_account">
                                            <span v-if="errors.bank_account_no" class="help-block">@{{errors.bank_account_no[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.bank_account_name}">
                                            <label class="control-label">Account Name : </label>
                                            <input type="text" name="bank_account_name" class="form-control input-sm" :disabled="salaries.salary_account">
                                            <span v-if="errors.bank_account_name" class="help-block">@{{errors.bank_account_name[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group" :class="{'has-error': errors.bank_branch_name}">
                                            <label class="control-label">Bank Branch : </label>
                                            <input type="text" name="bank_branch_name" class="form-control input-sm" :disabled="salaries.salary_account">
                                            <span v-if="errors.bank_branch_name" class="help-block">@{{errors.bank_branch_name[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="salaries.salaries !=''"
                                                    name="save_salary_and_next" v-on:click="submit_button='save_salary_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="salaries.salaries !=''"
                                                    name="save_salary" v-on:click="submit_button='save_salary'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Salary
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!---  Nominee Info -->
                <div id="tab1_6" class="tab-pane @if(isset($id) && $tab == 'nominee') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_nominee_form" v-on:submit.prevent="addNomineeInfo" method="post">
                                <input type="hidden" name="user_id" :value="user_id">

                                <div v-if="nominee.user_id">
                                    <div class="col-md-2">
                                        <label class="control-label">Nominee Photo :</label>
                                        <div class="fileupload-new admin-form" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail mb5">
                                                <img v-if="nominee.nominee_photo" :src="'/files/'+nominee.user_id+'/'+nominee.nominee_photo" alt="holder">
                                                <img v-else src="{{asset('img/placeholder.png')}}" alt="holder">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-10 mt40">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nominee Name : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_name" :value="nominee.nominee_name" class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nominee Relation : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_relation" class="form-control input-sm" :value="nominee.nominee_relation" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nominee Birth Date : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_birth_date" class="form-control input-sm" readonly="readonly" :value="nominee.nominee_birth_date">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nominee Distribution : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_distribution" class="form-control input-sm" :value="nominee.nominee_distribution" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nominee Rest Distribution : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_rest_distribution" class="form-control input-sm" :value="nominee.nominee_rest_distribution" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Nominee Address : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_address" class="form-control input-sm" :value="nominee.nominee_address" disabled="disabled">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="col-md-2" :class="{'has-error': errors.image}">
                                        <label class="control-label">Nominee Photo :</label>
                                        <div class="fileupload-new admin-form" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail mb5">
                                                <img src="{{asset('img/placeholder.png')}}" alt="holder">
                                            </div>
                                            <span class="button btn btn-sm btn-dark btn-file btn-block ph5">
                                            <span class="fileupload-exists"><span class="fa fa-user"></span> &nbsp; <strong>Change Photo</strong></span>
                                            <span class="fileupload-new"><span class="fa fa-user"></span> &nbsp; <strong>Select Photo</strong></span>
                                            <input type="file" name="image">
                                        </span>
                                        </div>
                                        <span v-if="errors.image" class="help-block">@{{errors.image[0]}}</span>
                                    </div>

                                    <div class="col-md-10 mt40">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" :class="{'has-error': errors.nominee_name}">
                                                    <label class="control-label">Nominee Name : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_name" class="form-control input-sm">
                                                    <span v-if="errors.nominee_name" class="help-block">@{{errors.nominee_name[0]}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group" :class="{'has-error': errors.nominee_relation}">
                                                    <label class="control-label">Nominee Relation : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_relation" class="form-control input-sm">
                                                    <span v-if="errors.nominee_relation" class="help-block">@{{errors.nominee_relation[0]}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group" :class="{'has-error': errors.nominee_birth_date}">
                                                    <label class="control-label">Nominee Birth Date : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_birth_date" class="datepicker form-control input-sm" readonly="readonly">
                                                    <span v-if="errors.nominee_birth_date" class="help-block">@{{errors.   nominee_birth_date[0]}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group" :class="{'has-error': errors.nominee_distribution}">
                                                    <label class="control-label">Nominee Distribution : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_distribution" class="form-control input-sm">
                                                    <span v-if="errors.nominee_distribution" class="help-block">@{{errors.nominee_distribution[0]}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group" :class="{'has-error': errors.nominee_rest_distribution}">
                                                    <label class="control-label">Nominee Rest Distribution : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_rest_distribution" class="form-control input-sm">
                                                    <span v-if="errors.nominee_rest_distribution" class="help-block">@{{errors.nominee_rest_distribution[0]}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group" :class="{'has-error': errors.nominee_address}">
                                                    <label class="control-label">Nominee Address : <span class="text-danger">*</span></label>
                                                    <input type="text" name="nominee_address" class="form-control input-sm">
                                                    <span v-if="errors.nominee_address" class="help-block">@{{errors.nominee_address[0]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">
                                    </div>
                                </div>

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="nominee.user_id"
                                                    name="save_nominee_and_next" v-on:click="submit_button='save_nominee_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="nominee.user_id"
                                                    name="save_nominee" v-on:click="submit_button='save_nominee'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Nominee
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!---  Training Info -->
                <div id="tab1_7" class="tab-pane @if(isset($id) && $tab == 'training') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_training_form" v-on:submit.prevent="addNewTraining" method="post">
                                <input type="hidden" name="user_id" :value="user_id">

                                <div v-if="trainings.length>0">
                                    <div v-for="training in trainings">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Training Code : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_code" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label">Training Title  : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_title" readonly="readonly" class="form-control input-sm">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Training Institute : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_institute" readonly="readonly" class="form-control input-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Training From Date : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_from_date" class="datepicker form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Training From Date : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_to_date" class="datepicker form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Training Passed Date : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_passed_date" class="datepicker form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Participation Date : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="training.training_participation_date" class="datepicker form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Training remarks : <span class="text-danger">*</span></label>
                                                    <textarea type="text" :value="training.training_remarks" readonly="readonly" class="form-control input-sm"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.training_code}">
                                                <label class="control-label">Training Code : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_code" class="form-control input-sm">
                                                <span v-if="errors.training_code" class="text-danger">@{{ errors.training_code[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group" :class="{'has-error': errors.training_title}">
                                                <label class="control-label">Training Title  : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_title" class="form-control input-sm">
                                                <span v-if="errors.training_title" class="text-danger">@{{ errors.training_title[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.training_institute}">
                                                <label class="control-label">Training Institute : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_institute" class="form-control input-sm">
                                                <span v-if="errors.training_institute" class="text-danger">@{{ errors.training_institute[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.training_from_date}">
                                                <label class="control-label">Training From Date : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_from_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.training_from_date" class="text-danger">@{{ errors.training_from_date[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.training_to_date}">
                                                <label class="control-label">Training From Date : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_to_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.training_to_date" class="text-danger">@{{ errors.training_to_date[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.training_passed_date}">
                                                <label class="control-label">Training Passed Date : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_passed_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.training_passed_date" class="text-danger">@{{ errors.training_passed_date[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" :class="{'has-error': errors.training_participation_date}">
                                                <label class="control-label">Participation Date : <span class="text-danger">*</span></label>
                                                <input type="text" name="training_participation_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.training_participation_date" class="text-danger">@{{ errors.training_participation_date[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.training_remarks}">
                                                <label class="control-label">Training remarks : <span class="text-danger">*</span></label>
                                                <textarea type="text" name="training_remarks" class="form-control input-sm"></textarea>
                                                <span v-if="errors.training_remarks" class="text-danger">@{{ errors.training_remarks[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_new_training_button" :disabled="trainings.length<=0"
                                                    onclick="modal_open('#add_new_training_button','#add_new_training_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New Training
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="trainings.length>0" :disabled="trainings.user_id"
                                                    name="save_training_and_next" v-on:click="submit_button='save_training_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="trainings.length>0"
                                                    name="save_training" v-on:click="submit_button='save_training'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Training
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!---  Reference Info -->
                <div id="tab1_8" class="tab-pane @if(isset($id) && $tab == 'reference') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_reference_form" v-on:submit.prevent="addNewReference" method="post">
                                <input type="hidden" name="user_id" :value="user_id">

                                <div v-if="references.length>0">
                                    <div v-for="reference in references">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Reference Name : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="reference.reference_name" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Reference Email  : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="reference.reference_email" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Reference Department : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="reference.reference_department" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Reference Organization : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="reference.reference_organization" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Reference Phone : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="reference.reference_phone" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Reference Address : <span class="text-danger">*</span></label>
                                                    <textarea type="text" :value="reference.reference_address" class="form-control input-sm" readonly="readonly"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.reference_name}">
                                                <label class="control-label">Reference Name : <span class="text-danger">*</span></label>
                                                <input type="text" name="reference_name" class="form-control input-sm">
                                                <span v-if="errors.reference_name" class="text-danger">@{{ errors.reference_name[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.reference_email}">
                                                <label class="control-label">Reference Email  : <span class="text-danger">*</span></label>
                                                <input type="text" name="reference_email" class="form-control input-sm">
                                                <span v-if="errors.reference_email" class="text-danger">@{{ errors.reference_email[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.reference_department}">
                                                <label class="control-label">Reference Department : <span class="text-danger">*</span></label>
                                                <input type="text" name="reference_department" class="form-control input-sm">
                                                <span v-if="errors.reference_department" class="text-danger">@{{ errors.reference_department[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.reference_organization}">
                                                <label class="control-label">Reference Organization : <span class="text-danger">*</span></label>
                                                <input type="text" name="reference_organization" class="form-control input-sm">
                                                <span v-if="errors.reference_organization" class="text-danger">@{{ errors.reference_organization[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.reference_phone}">
                                                <label class="control-label">Reference Phone : <span class="text-danger">*</span></label>
                                                <input type="text" name="reference_phone" class="form-control input-sm">
                                                <span v-if="errors.reference_phone" class="text-danger">@{{ errors.reference_phone[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.reference_address}">
                                                <label class="control-label">Reference Address : <span class="text-danger">*</span></label>
                                                <textarea type="text" name="reference_address" class="form-control input-sm"></textarea>
                                                <span v-if="errors.reference_address" class="text-danger">@{{ errors.reference_address[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_new_reference_button" :disabled="references.length<=0"
                                                    onclick="modal_open('#add_new_reference_button','#add_new_reference_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New Reference
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="references.user_id"
                                                    name="save_reference_and_next" v-on:click="submit_button='save_reference_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="references.user_id"
                                                    name="save_reference" v-on:click="submit_button='save_reference'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Reference
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!---  Children Info -->
                <div id="tab1_9" class="tab-pane @if(isset($id) && $tab == 'children') active @endif">
                    <div class="row mt20">
                        <div class="col-md-12">
                            <form id="add_children_form" v-on:submit.prevent="addNewChildren" method="post">
                                <input type="hidden" name="user_id" :value="user_id">

                                <div v-if="childrens.length>0">
                                    <div v-for="children in childrens">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Children Name : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="children.children_name" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="control-label">Children Education Level : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="children.children_education_level" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Children Birth Date  : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="children.children_birth_date" class="datepicker form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Children Gender : <span class="text-danger">*</span></label>
                                                    <div class="radio-custom mb5">
                                                        <input :checked="children.children_gender=='male'" type="radio" readonly="readonly">
                                                        <label for="children_male">Male</label>

                                                        <input :checked="children.children_gender=='female'" type="radio" readonly="readonly">
                                                        <label for="children_female">Female</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="form-group" :class="{'has-error': errors.children_remarks}">
                                                    <label class="control-label">Children Remarks : <span class="text-danger">*</span></label>
                                                    <textarea name="children_remarks" class="form-control input-sm" readonly="readonly">@{{children.children_remarks}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.children_name}">
                                                <label class="control-label">Children Name : <span class="text-danger">*</span></label>
                                                <input type="text" name="children_name" class="form-control input-sm">
                                                <span v-if="errors.children_name" class="text-danger">@{{ errors.children_name[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group" :class="{'has-error': errors.children_education_level}">
                                                <label class="control-label">Children Education Level : <span class="text-danger">*</span></label>
                                                <input type="text" name="children_education_level" class="form-control input-sm">
                                                <span v-if="errors.children_education_level" class="text-danger">@{{ errors.children_education_level[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.children_birth_date}">
                                                <label class="control-label">Children Birth Date  : <span class="text-danger">*</span></label>
                                                <input type="text" name="children_birth_date" class="datepicker form-control input-sm" readonly="readonly">
                                                <span v-if="errors.children_birth_date" class="text-danger">@{{ errors.children_birth_date[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group" :class="{'has-error': errors.children_gender}">
                                                <label class="control-label">Children Gender : <span class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="children_male" name="children_gender" type="radio" value="male">
                                                    <label for="children_male">Male</label>
                                                    <input id="children_female" name="children_gender" type="radio" value="female">
                                                    <label for="children_female">Female</label>
                                                </div>
                                                <span v-if="errors.children_gender" class="text-danger">@{{ errors.children_gender[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group" :class="{'has-error': errors.children_remarks}">
                                                <label class="control-label">Children Remarks : <span class="text-danger">*</span></label>
                                                <textarea name="children_remarks" class="form-control input-sm"></textarea>
                                                <span v-if="errors.children_remarks" class="text-danger">@{{ errors.children_remarks[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_new_children_button" :disabled="childrens.length<=0"
                                                    onclick="modal_open('#add_new_children_button','#add_new_children_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New Children
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="childrens.length>0"
                                                    name="save_children_and_next" v-on:click="submit_button='save_children_and_next'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="childrens.length>0"
                                                    name="save_children" v-on:click="submit_button='save_children'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Children
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!---  Language Info -->
                <div id="tab1_10" class="tab-pane @if(isset($id) && $tab == 'language') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add_language_form" v-on:submit.prevent="addNewLanguage" method="post">
                                <input type="hidden" name="user_id" :value="user_id">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt20 mb25">
                                            <button type="button" id="add_new_language_modal_button" onclick="modal_open('#add_new_language_modal_button','#add_new_language_button_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block" data-effect="mfp-newspaper"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add Language
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="languages.languages !=''">
                                    <div v-for="language in languages.languages">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Language Name :</label>
                                                    <input :value="language.language.language_name" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Speaking Skill :</label>
                                                    <input :value="language.speaking" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Reading Skill :</label>
                                                    <input :value="language.reading" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Writing Skill :</label>
                                                    <input :value="language.writing" class="form-control input-sm" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="short alt">
                                    </div>
                                </div>

                                <div v-else>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.language_id}">
                                                <label class="control-label">Language Name : <span class="text-danger">*</span></label>
                                                <select name="language_id" class="form-control input-sm">
                                                    <option value="">...Select Language Name...</option>
                                                    <option v-for="lan in language" :value="lan.id" v-text="lan.language_name"></option>
                                                </select>
                                                <span v-if="errors.language_id" class="text-danger">@{{ errors.language_id[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.speaking}">
                                                <label class="control-label">Speaking Skill : <span class="text-danger">*</span></label>
                                                <select name="speaking" class="form-control input-sm">
                                                    <option value="">...Select Speaking Skill...</option>
                                                    <option>Bad</option>
                                                    <option>Medium</option>
                                                    <option>Good</option>
                                                    <option>excelent</option>
                                                </select>
                                                <span v-if="errors.speaking" class="text-danger">@{{ errors.speaking[0]}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.reading}">
                                                <label class="control-label">Reading Skill : <span class="text-danger">*</span></label>
                                                <select name="reading" class="form-control input-sm">
                                                    <option value="">...Select Reading Skill...</option>
                                                    <option>Bad</option>
                                                    <option>Medium</option>
                                                    <option>Good</option>
                                                    <option>excelent</option>
                                                </select>
                                                <span v-if="errors.reading" class="text-danger">@{{ errors.reading[0]}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group" :class="{'has-error': errors.writing}">
                                                <label class="control-label">Writing Skill : <span class="text-danger">*</span></label>
                                                <select name="writing" class="form-control input-sm">
                                                    <option value="">...Select Writing Skill...</option>
                                                    <option>Bad</option>
                                                    <option>Medium</option>
                                                    <option>Good</option>
                                                    <option>excelent</option>
                                                </select>
                                                <span v-if="errors.writing" class="text-danger">@{{ errors.writing[0]}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_new_language_button" :disabled="languages.languages ==''"
                                                    onclick="modal_open('#add_new_language_button','#add_new_language_modal')" class="btn btn-sm btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New Language
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="languages.languages !=''"
                                                    name="save_language" v-on:click="submit_button='save_language'"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Language
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Add Designation Form Popup -->
    @include('pim.employee.modals.designation')

    <!-- Add Education Form Popup -->
    @include('pim.employee.modals.education')

    <!-- Add Experience Form Popup -->
    @include('pim.employee.modals.experience')

    <!-- Add Allowance Form Popup -->
    @include('pim.employee.modals.allowance')

    <!-- Add Training Form Popup -->
    @include('pim.employee.modals.training')

    <!-- Add Reference Form Popup -->
    @include('pim.employee.modals.reference')

    <!-- Add Children Form Popup -->
    @include('pim.employee.modals.children')

    <!-- Add Language Form Popup -->
        @include('pim.employee.modals.language')

        <div id="add_new_language_button_modal" style="max-width:400px" class="popup-basic mfp-with-anim mfp-hide">
            <div class="panel">
                <div class="panel-heading">
                <span class="panel-title">
                    <i class="fa fa-rocket"></i>Add New Language
                </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add_language" method="post" v-on:submit.prevent="addLanguage('add_language')">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" :class="{'has-error': errors.language_name}">
                                            <label class="control-label">Language Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="language_name" class="form-control input-sm">
                                            <span v-if="errors.language_name" class="text-danger">@{{ errors.language_name[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-6 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="add_language" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Add Language
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </form>
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

    <!-- Page Plugins -->
    <script src="{{asset('vendor/plugins/magnific/jquery.magnific-popup.js')}}"></script>


    <script type="text/javascript">

        // var diff = Math.abs(new Date('2010-10-09') - new Date('2011-11-09'));
        // var year = 1000 * 60 * 60 * 24 * 30 * 12;
        // var years = Math.abs(diff/year);
        // alert(years.toFixed(1));

        var base_url = "{{url('/')}}";
        var add_edit = "edit";
        var current_tab = "{{($tab)?$tab:''}}";
        var id = "{{(isset($id))?base64_encode($id).'/':''}}";
        var user_id = "{{(isset($id))?$id:''}}";

        jQuery(document).ready(function () {

            $('.date').datetimepicker({
                format: 'YYYY',
                viewMode: 'years',
                minViewMode: "years",
                pickTime: false
            });
        });

        // Modal Start
        function modal_open(id, form_id) {
            $(document).on('click', id, function (e) {
                e.preventDefault();
                $(this).removeClass('active-animation');
                $(this).addClass('active-animation item-checked');

                $.magnificPopup.open({
                    removalDelay: 300,
                    items: {
                        src: form_id
                    },
                    callbacks: {
                        beforeOpen: function (e) {
                            var Animation = "mfp-zoomIn";
                            this.st.mainClass = Animation;
                        }
                    },
                    midClick: true
                });

            });
        }
        //Modal End


    </script>

    <script type="text/javascript" src="{{asset('/js/employee.js')}}"></script>

@endsection


@endsection