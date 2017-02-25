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
            </ul>
        </div>

        <div class="panel-body">
            <div class="tab-content pn br-n">

                <!--- Basic Info -->
                <div id="tab1_1" class="tab-pane @if($tab == '') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{url('employee/add')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @if(isset($user))

                                    <div v-for="(basic,index) in basics" v-if="index =='id'">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Employee No : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" :value="basics.employee_no"
                                                           class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Employee Designation : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text" :value="basics.designation.designation_name"
                                                           class="form-control input-sm" disabled="disabled">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group mt25">
                                                    <button type="button" disabled="disabled"
                                                            class="btn btn-sm btn-dark btn-gradient dark btn-block">
                                                        <span class="glyphicons glyphicons-briefcase"></span> &nbsp; Add
                                                        Designation
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">First Name : <span class="text-danger">*</span></label>
                                                    <input type="text" :value="basics.first_name" disabled="disabled"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Middle Name : </label>
                                                    <input type="text" :value="basics.middle_name" disabled="disabled"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="text"
                                                           :value="basics.last_name" disabled="disabled"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Nick Name</label>
                                                    <input type="text" name="nick_name"
                                                           :value="basics.nick_name" disabled="disabled"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Email Address : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="email" disabled="disabled"
                                                           :value="basics.email"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Mobile Number : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="number" disabled="disabled"
                                                           :value="basics.mobile_number"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Password : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="password" disabled="disabled" :value="basics.password"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Retype Password : <span
                                                                class="text-danger">*</span></label>
                                                    <input type="password" disabled="disabled"
                                                           class="form-control input-sm">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2 pt50" v-if="basics.address">
                                                <label class="control-label">Employee Photo :</label>
                                                <div class="@if($user->photo) fileupload-exists @else fileupload-new @endif admin-form" data-provides="fileupload">
                                                    <div class="fileupload-preview thumbnail mb15">
                                                       
                                                    <img v-if="basics.photo" :src="'/files/'+basics.id+'/'+basics.photo" alt="holder">
                                                      
                                                    <img v-else src="{{asset('img/placeholder.png')}}" alt="holder">
                                                       
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-10" v-if="basics.address">
                                                <div class="admin-form">
                                                    <div class="section-divider mb40">
                                                        <span class="bg-white">Present Address</span>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Division : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.present_division.division_name"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">District : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.present_district.district_name"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Police Station : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.present_police_station.police_station_name"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Post Office : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.present_postoffice"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">Address : <span
                                                                        class="text-danger">*</span></label>
                                                            <textarea disabled="disabled" class="form-control input-sm"
                                                                      cols="60"
                                                                      rows="1">@{{basics.address.present_address}}</textarea>
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
                                                        <div class="form-group">
                                                            <label class="control-label">Division : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.permanent_division.division_name"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">District : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.permanent_district.district_name"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Police Station : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.permanent_police_station.police_station_name"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Post Office : <span
                                                                        class="text-danger">*</span></label>
                                                            <input type="text"
                                                                   :value="basics.address.permanent_postoffice"
                                                                   disabled="disabled" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label class="control-label">Address : <span
                                                                        class="text-danger">*</span></label>
                                                            <textarea disabled="disabled" class="form-control input-sm"
                                                                      cols="60"
                                                                      rows="1">@{{basics.address.permanent_address}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr class="short alt">

                                        <div class="section row mbn">
                                            <div class="col-sm-2 pull-right">
                                                <p class="text-left">
                                                    <button disabled="disabled" type="submit"
                                                            name="save_next" value="save_next"
                                                            class="btn btn-dark btn-gradient dark btn-block"><span
                                                                class="glyphicons glyphicons-ok_2"></span> &nbsp; Create
                                                        & Next
                                                        <span class="glyphicons glyphicons-right_arrow"></span></button>
                                                </p>
                                            </div>
                                            <div class="col-sm-2 pull-right">
                                                <p class="text-left">
                                                    <button disabled="disabled" type="submit"
                                                            name="add_employee"
                                                            class="btn btn-dark btn-gradient dark btn-block"><span
                                                                class="glyphicons glyphicons-ok_2"></span> &nbsp; Create
                                                        Employee
                                                    </button>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{$errors->has('employee_no')?'has-error':''}}">
                                                <label class="control-label">Employee No : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="employee_no"
                                                       value="{{old('employee_no')}}"
                                                       class="form-control input-sm" placeholder="Enter Employee No">
                                                @if($errors->has('employee_no'))<span
                                                        class="help-block">{{$errors->first('employee_no')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group {{$errors->has('designation_id')?'has-error':''}}">
                                                <label class="control-label">Employee Designation : <span
                                                            class="text-danger">*</span></label>
                                                <select class="form-control input-sm" id="designation_id"
                                                        name="designation_id">
                                                    <option v-bind:value="0">---- Select Employee Designation ----
                                                    </option>
                                                    <option v-for="(designation,index) in designations"
                                                            v-bind:value="designation.id"
                                                            :selected="designation.id == {{json_encode(old('designation_id'))?true:false}}">@{{designation.designation_name}}</option>
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
                                                       value="{{old('first_name')}}"
                                                       class="form-control input-sm" placeholder="Enter First Name">
                                                @if($errors->has('first_name'))<span
                                                        class="help-block">{{$errors->first('first_name')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Middle Name : </label>
                                                <input type="text" name="middle_name"
                                                       value="{{old('middle_name')}}"
                                                       class="form-control input-sm" placeholder="Enter Middle Name">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('last_name')?'has-error':''}}">
                                                <label class="control-label">Last Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="last_name"
                                                       value="{{old('last_name')}}"
                                                       class="form-control input-sm" placeholder="Enter Last Name">
                                                @if($errors->has('last_name'))<span
                                                        class="help-block">{{$errors->first('last_name')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Nick Name</label>
                                                <input type="text" name="nick_name"
                                                       value="{{old('nick_name')}}"
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
                                                       value="{{old('email')}}"
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
                                                       value="{{old('mobile_number')}}"
                                                       class="form-control input-sm" placeholder="Enter Mobile Number">
                                                @if($errors->has('mobile_number'))<span
                                                        class="help-block">{{$errors->first('mobile_number')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('password')?'has-error':''}}">
                                                <label class="control-label">Password : <span
                                                            class="text-danger">*</span></label>
                                                <input type="password" name="password" value="{{old('password')}}"
                                                       class="form-control input-sm" placeholder="Enter Password">
                                                @if($errors->has('password'))<span
                                                        class="help-block">{{$errors->first('password')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('retype_password')?'has-error':''}}">
                                                <label class="control-label">Retype Password : <span
                                                            class="text-danger">*</span></label>
                                                <input type="password" name="retype_password"
                                                       class="form-control input-sm"
                                                       placeholder="Enter Retype Password">
                                                @if($errors->has('retype_password'))<span
                                                        class="help-block">{{$errors->first('retype_password')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2 pt50">
                                            <label class="control-label">Employee Photo :</label>
                                            <div class="fileupload fileupload-new admin-form"
                                                 data-provides="fileupload">
                                                <div class="fileupload-preview thumbnail mb15">
                                                    <img src="{{asset('img/placeholder.png')}}" alt="holder">
                                                </div>
                                                <span class="button btn btn-sm btn-dark btn-file btn-block ph5">
                                                    <span class="fileupload-exists"><span class="fa fa-user"></span> &nbsp; <strong>Change Photo</strong></span>
                                                    <span class="fileupload-new"><span class="fa fa-user"></span> &nbsp; <strong>Select Photo</strong></span>
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
                                                        <label class="control-label">Division : <span
                                                                    class="text-danger">*</span></label>
                                                        <select class="form-control input-sm" name="present_division_id"
                                                                v-model="present_division_id">
                                                            <option :value="''">---- Select Division ----</option>
                                                            <option v-for="(division, index) in divisions"
                                                                    :value="division.id">@{{ division.division_name }}</option>
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
                                                            <option v-for="(district, index) in districts"
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
                                                            <option v-for="(policeStation,index) in policeStations"
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
                                                               value="{{old('present_postoffice')}}"
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
                                                                  placeholder="House, Road, Village.">{{old('present_address')}}</textarea>
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
                                                               value="{{old('permanent_postoffice')}}"
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
                                                                  placeholder="House, Road, Village.">{{old('permanent_address')}}</textarea>
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
                                                        name="save_next" value="save_next"
                                                        class="btn btn-dark btn-gradient dark btn-block"><span
                                                            class="glyphicons glyphicons-ok_2"></span> &nbsp; Create &
                                                    Next
                                                    <span class="glyphicons glyphicons-right_arrow"></span></button>
                                            </p>
                                        </div>
                                        <div class="col-sm-2 pull-right">
                                            <p class="text-left">
                                                <button type="submit"
                                                        name="add_employee" value="add_employee"
                                                        class="btn btn-dark btn-gradient dark btn-block"><span
                                                            class="glyphicons glyphicons-ok_2"></span> &nbsp; Create
                                                    Employee
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!--- Personal Info -->
                <div id="tab1_2" class="tab-pane @if(isset($id) && $tab == 'personal') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="@if(isset($id) && isset($tab)){{url('employee/add/'.$id.'/personal')}}@endif"
                                  method="post">
                                {{csrf_field()}}

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
                                        @if(isset($user))
                                            <div class="col-md-3">
                                                <div class="form-group {{$errors->has('user_id')?'has-error':''}}">
                                                    <label class="control-label">Employee Full Name:</label>
                                                    <input type="text" value="{{$user->fullname}}"
                                                           class="form-control input-sm" disabled>
                                                    <input type="hidden" name="user_id" value="{{$user->id}}"
                                                           class="form-control input-sm">
                                                    @if($errors->has('user_id'))<span
                                                            class="help-block">{{$errors->first('user_id')}}</span>@endif
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('father_name')?'has-error':''}}">
                                                <label class="control-label">Father Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="father_name"
                                                       value="{{old('father_name')}}"
                                                       class="form-control input-sm" placeholder="Enter Father Name">
                                                @if($errors->has('father_name'))<span
                                                        class="help-block">{{$errors->first('father_name')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('mother_name')?'has-error':''}}">
                                                <label class="control-label">Father Name : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="mother_name" value="{{old('mother_name')}}"
                                                       class="form-control input-sm" placeholder="Enter Mother Name">
                                                @if($errors->has('mother_name'))<span
                                                        class="help-block">{{$errors->first('mother_name')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('national_id')?'has-error':''}}">
                                                <label class="control-label">National Id : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="national_id" value="{{old('national_id')}}"
                                                       class="form-control input-sm" placeholder="Enter National Id">
                                                @if($errors->has('national_id'))<span
                                                        class="help-block">{{$errors->first('national_id')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('passport_no')?'has-error':''}}">
                                                <label class="control-label">Passport No :</label>
                                                <input type="text" name="passport_no" value="{{old('passport_no')}}"
                                                       class="form-control input-sm" placeholder="Enter Passport No">
                                                @if($errors->has('passport_no'))<span
                                                        class="help-block">{{$errors->first('passport_no')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('tin_no')?'has-error':''}}">
                                                <label class="control-label">Tin No :</label>
                                                <input type="text" name="tin_no" value="{{old('tin_no')}}"
                                                       class="form-control input-sm" placeholder="Enter Tin No">
                                                @if($errors->has('tin_no'))<span
                                                        class="help-block">{{$errors->first('tin_no')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('personal_email')?'has-error':''}}">
                                                <label class="control-label">Personal Email : <span class="text-danger">*</span></label>
                                                <input type="text" name="personal_email"
                                                       value="{{old('personal_email')}}" class="form-control input-sm"
                                                       placeholder="Enter Personal Email">
                                                @if($errors->has('personal_email'))<span
                                                        class="help-block">{{$errors->first('personal_email')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('official_email')?'has-error':''}}">
                                                <label class="control-label">Official Email : <span class="text-danger">*</span></label>
                                                <input type="text" name="official_email"
                                                       value="{{old('official_email')}}" class="form-control input-sm"
                                                       placeholder="Enter Official Email">
                                                @if($errors->has('official_email'))<span
                                                        class="help-block">{{$errors->first('official_email')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('phone_number')?'has-error':''}}">
                                                <label class="control-label">Phone Number : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="phone_number" value="{{old('phone_number')}}"
                                                       class="form-control input-sm" placeholder="Enter Phone Number">
                                                @if($errors->has('phone_number'))<span
                                                        class="help-block">{{$errors->first('phone_number')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('birth_date')?'has-error':''}}">
                                                <label class="control-label">Birth Date :</label>
                                                <input type="text" name="birth_date" value="{{old('birth_date')}}"
                                                       class="datepicker form-control input-sm"
                                                       placeholder="Enter Birth Date" readonly="readonly">
                                                @if($errors->has('birth_date'))<span
                                                        class="help-block">{{$errors->first('birth_date')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('joining_date')?'has-error':''}}">
                                                <label class="control-label">Joining Date : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="joining_date" value="{{old('joining_date')}}"
                                                       class="datepicker form-control input-sm"
                                                       placeholder="Enter Joining Date" readonly="readonly">
                                                @if($errors->has('joining_date'))<span
                                                        class="help-block">{{$errors->first('joining_date')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('blood_group_id')?'has-error':''}}">
                                                <label class="control-label">Blood Group :</label>
                                                <select class="form-control input-sm" name="blood_group_id">
                                                    <option value="0">---- Select Blood Group ----</option>
                                                    <option v-bind:value="blood_group.id"
                                                            v-for="(blood_group, index) in blood_group">@{{ blood_group.blood_name}}</option>
                                                </select>
                                                @if($errors->has('blood_group_id'))<span
                                                        class="help-block">{{$errors->first('blood_group_id')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('gender')?'has-error':''}}">
                                                <label class="control-label">Gender : <span class="text-danger">*</span></label>
                                                <div class="radio-custom mb5">
                                                    <input id="male" name="gender" type="radio" value="male"
                                                           @if(old('gender') == 'male') checked="checked" @endif>
                                                    <label for="male">Male</label>

                                                    <input id="female" name="gender" type="radio" value="female"
                                                           @if(old('gender') == 'female') checked="checked" @endif>
                                                    <label for="female">Female</label>
                                                </div>
                                                @if($errors->has('gender'))<span
                                                        class="help-block">{{$errors->first('gender')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('marital_status')?'has-error':''}}">
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
                                                @if($errors->has('marital_status'))<span
                                                        class="help-block">{{$errors->first('marital_status')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('religion')?'has-error':''}}">
                                                <label class="control-label">Religion :</label>
                                                <input type="text" name="religion" value="{{old('religion')}}"
                                                       class="form-control input-sm" placeholder="Enter Religion">
                                                @if($errors->has('religion'))<span
                                                        class="help-block">{{$errors->first('religion')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('nationality')?'has-error':''}}">
                                                <label class="control-label">Nationality :</label>
                                                <input type="text" name="nationality" value="{{old('nationality')}}"
                                                       class="form-control input-sm" placeholder="Enter Nationality">
                                                @if($errors->has('nationality'))<span
                                                        class="help-block">{{$errors->first('nationality')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group {{$errors->has('emergency_contact_person')?'has-error':''}}">
                                                <label class="control-label">Emergency Contact Person :</label>
                                                <input type="text" name="emergency_contact_person"
                                                       value="{{old('emergency_contact_person')}}"
                                                       class="form-control input-sm"
                                                       placeholder="Emergency Contact Person">
                                                @if($errors->has('emergency_contact_person'))<span
                                                        class="help-block">{{$errors->first('emergency_contact_person')}}</span>@endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group {{$errors->has('emergency_contact_address')?'has-error':''}}">
                                                <label class="control-label">Emergency Contact Address :</label>
                                                <textarea name="emergency_contact_address" class="form-control input-sm"
                                                          cols="60" rows="1"
                                                          placeholder="Emergency Contact Address">{{old('emergency_contact_address')}}</textarea>
                                                @if($errors->has('emergency_contact_address'))<span
                                                        class="help-block">{{$errors->first('emergency_contact_address')}}</span>@endif
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
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Personal
                                                Info
                                            </button>
                                        </p>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!--- Education Info ---->
                <div id="tab1_3" class="tab-pane @if(isset($id) && $tab == 'education') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="@if(isset($id) && isset($tab)){{url('employee/add/'.$id.'/'.$tab)}}@endif"
                                  method="post" enctype="multipart/form-data">
                            {{csrf_field()}}

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
                                        @if(isset($user))
                                            <div class="col-md-3">
                                                <div class="form-group {{$errors->has('user_id')?'has-error':''}}">
                                                    <label class="control-label">Employee Full Name:</label>
                                                    <input type="text" value="{{($user->fullname)?$user->fullname:''}}"
                                                           class="form-control input-sm" disabled>
                                                    <input type="hidden" name="user_id"
                                                           value="{{($user->id)?$user->id:''}}"
                                                           class="form-control input-sm">
                                                    @if($errors->has('user_id'))<span
                                                            class="help-block">{{$errors->first('user_id')}}</span>@endif
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('education_level_id')?'has-error':''}}">
                                                <label class="control-label">Education Level : <span
                                                            class="text-danger">*</span></label>
                                                <select class="form-control input-sm" name="education_level_id"
                                                        v-on:change="getInstituteAndDegreeByEducationLevelId()"
                                                        v-model="education_level_id">
                                                    <option v-bind:value="''">---- Select Education Level ----</option>
                                                    <option v-bind:value="education_level.id"
                                                            v-for="(education_level, index) in education_levels">@{{ education_level.education_level_name }}</option>
                                                </select>
                                                @if($errors->has('education_level_id'))<span
                                                        class="help-block">{{$errors->first('education_level_id')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('institute_id')?'has-error':''}}">
                                                <label class="control-label">Institute : <span
                                                            class="text-danger">*</span></label>
                                                <select class="form-control input-sm" name="institute_id">
                                                    <option v-bind:value="''">---- Select Institute ----</option>
                                                    <option v-bind:value="institute.id"
                                                            v-for="(institute, index) in institutes">@{{ institute.institute_name }}</option>
                                                </select>
                                                @if($errors->has('institute_id'))<span
                                                        class="help-block">{{$errors->first('institute_id')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('degree_id')?'has-error':''}}">
                                                <label class="control-label">Degree : <span
                                                            class="text-danger">*</span></label>
                                                <select class="form-control input-sm" name="degree_id">
                                                    <option v-bind:value="''">---- Select Degree ----</option>
                                                    <option v-bind:value="degree.id"
                                                            v-for="(degree, index) in degrees">@{{ degree.degree_name }}</option>
                                                </select>
                                                @if($errors->has('degree_id'))<span
                                                        class="help-block">{{$errors->first('degree_id')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('pass_year')?'has-error':''}}">
                                                <label class="control-label">Pass Year : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="pass_year" class="date form-control input-sm"
                                                       readonly="">
                                                @if($errors->has('pass_year'))<span
                                                        class="help-block">{{$errors->first('pass_year')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('certificate')?'has-error':''}}">
                                                <label class="control-label">Certificate:</label>
                                                <input type="file" name="certificate"
                                                       class="form-control btn-primary input-sm">
                                                @if($errors->has('certificate'))<span
                                                        class="help-block">{{$errors->first('certificate')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('result_type')?'has-error':''}}">
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
                                                @if($errors->has('result_type'))<span
                                                        class="help-block">{{$errors->first('result_type')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3" v-if="showCgpa">
                                            <div class="form-group {{$errors->has('cgpa')?'has-error':''}}">
                                                <label class="control-label">CGPA : <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" name="cgpa" value="{{old('cgpa')}}"
                                                       class="form-control input-sm" placeholder="Enter CGPA">
                                                @if($errors->has('cgpa'))<span
                                                        class="help-block">{{$errors->first('cgpa')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3" v-if="showDivision">
                                            <div class="form-group {{$errors->has('division')?'has-error':''}}">
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
                                                @if($errors->has('division'))<span
                                                        class="help-block">{{$errors->first('division')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end v-else -->

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_education" :disabled="educations.educations ==''"
                                                    onclick="modal_open('#add_education','#add_education_form')"
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
                                                    name="save_education_and_next" value="save_education_and_next"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button type="submit" :disabled="educations.educations !=''"
                                                    name="save_education" value="save_education"
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

                <!---  Experience Info ---->
                <div id="tab1_4" class="tab-pane @if(isset($id) && $tab == 'experience') active @endif">
                    <div class="row">
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

                <!---  Salary Info ---->
                <div id="tab1_5" class="tab-pane @if(isset($id) && $tab == 'salary') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add_experience_form" v-on:submit.prevent="addNewExperience" method="post">

                          
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
            </div>
        </div>


        <!-- Add Designation Form Popup -->
        <div id="add_new_designation_modal" style="max-width:700px" class="popup-basic mfp-with-anim mfp-hide">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">
                        <i class="fa fa-rocket"></i>Add New Designation
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" v-on:submit.prevent="addNewDesignation('add_new_designation_form')"
                                  id="add_new_designation_form">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.designation_name}">
                                            <label class="control-label">Designation Name : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="designation_name" class="form-control input-sm">
                                            <span v-if="errors.designation_name"
                                                  class="text-danger">@{{ errors.designation_name[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.department_id}">
                                            <label class="control-label">Department : <span class="text-danger">*</span></label>
                                            <select class="form-control input-sm" name="department_id">
                                                <option v-bind:value="''">---- Select Department ----</option>
                                                <option v-bind:value="department.id"
                                                        v-for="(department, index) in departments">@{{ department.department_name }}</option>
                                            </select>
                                            <span v-if="errors.department_id"
                                                  class="text-danger">@{{ errors.department_id[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.level_id}">
                                            <label class="control-label">Level : <span
                                                        class="text-danger">*</span></label>
                                            <select class="form-control input-sm" name="level_id">
                                                <option v-bind:value="''">---- Select Level ----</option>
                                                <option v-bind:value="level.id"
                                                        v-for="(level, index) in levels">@{{ level.level_name }}</option>
                                            </select>
                                            <span v-if="errors.level_id"
                                                  class="text-danger">@{{ errors.level_id[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" :class="{'has-error': errors.designation_description}">
                                            <label class="control-label">Description : <span
                                                        class="text-danger">*</span></label>
                                            <textarea class="form-control input-sm"
                                                      name="designation_description"></textarea>
                                            <span v-if="errors.designation_description"
                                                  class="text-danger">@{{ errors.designation_description[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-4 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="save_designation"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Add New
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

        <!-- Add Education Form Popup -->
        <div id="add_new_education_modal" style="max-width:700px" class="popup-basic mfp-with-anim mfp-hide">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">
                        <i class="fa fa-rocket"></i>Add New Education
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addNewEducation">
                                <div class="row">
                                    <input type="hidden" name="user_id" v-model="user_id">
                                    <div class="col-md-4">
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
                                            <span v-if="errors.education_level_id"
                                                  class="text-danger">@{{ errors.education_level_id[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.institute_id}">
                                            <label class="control-label">Institute : <span class="text-danger">*</span></label>
                                            <select class="form-control input-sm" name="institute_id">
                                                <option v-bind:value="''">---- Select Institute ----</option>
                                                <option v-bind:value="institute.id"
                                                        v-for="(institute, index) in institutes">@{{ institute.institute_name }}</option>
                                            </select>
                                            <span v-if="errors.institute_id"
                                                  class="text-danger">@{{ errors.institute_id[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.degree_id}">
                                            <label class="control-label">Degree : <span
                                                        class="text-danger">*</span></label>
                                            <select class="form-control input-sm" name="degree_id">
                                                <option v-bind:value="''">---- Select Degree ----</option>
                                                <option v-bind:value="degree.id"
                                                        v-for="(degree, index) in degrees">@{{ degree.degree_name }}</option>
                                            </select>
                                            <span v-if="errors.degree_id"
                                                  class="text-danger">@{{ errors.degree_id[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.pass_year}">
                                            <label class="control-label">Pass Year : <span class="text-danger">*</span></label>
                                            <input type="text" name="pass_year" class="date form-control input-sm"
                                                   readonly="">
                                            <span v-if="errors.pass_year"
                                                  class="text-danger">@{{ errors.pass_year[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.result_type}">
                                            <label class="control-label">Result Type :</label>
                                            <div class="radio-custom mb5">
                                                <input id="result_type_cgpa" name="result_type" type="radio"
                                                       value="cgpa" checked="checked"
                                                       v-on:click="showCgpa=true,showDivision=false">
                                                <label for="result_type_cgpa">CGPA</label>

                                                <input id="result_type_division" name="result_type" type="radio"
                                                       value="division" v-on:click="showCgpa=false,showDivision=true">
                                                <label for="result_type_division">Division</label>
                                                <span v-if="errors.result_type"
                                                      class="text-danger">@{{ errors.result_type[0]}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" v-if="showCgpa">
                                        <div class="form-group" :class="{'has-error' : errors.cgpa}">
                                            <label class="control-label">CGPA : <span
                                                        class="text-danger">*</span></label>
                                            <input type="number" name="cgpa" class="form-control input-sm"
                                                   placeholder="Enter CGPA">
                                            <span v-if="errors.cgpa" class="text-danger">@{{ errors.cgpa[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4" v-if="showDivision">
                                        <div class="form-group" :class="{'has-error': errors.division}">
                                            <label class="control-label">Division : <span
                                                        class="text-danger">*</span></label>
                                            <select name="division" class="form-control input-sm">
                                                <option value="">--- Select Division ---</option>
                                                <option value="1">First Division</option>
                                                <option value="2">Second Division</option>
                                                <option value="3">Third Division</option>
                                            </select>
                                            <span v-if="errors.division"
                                                  class="text-danger">@{{ errors.division[0] }}</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6" :class="{'has-error': errors.certificate_file}">
                                        <div class="form-group">
                                            <label class="control-label">Certificate:</label>
                                            <input type="file" name="certificate_file" class="form-control btn-primary input-sm">
                                            <span v-if="errors.certificate_file" class="text-danger">@{{ errors.certificate_file[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-4 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="save_education"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Add New
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


        <!-- Add Experience Form Popup -->
        <div id="add_new_experience_modal" style="max-width:700px" class="popup-basic mfp-with-anim mfp-hide">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">
                        <i class="fa fa-rocket"></i>Add New Experience
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add_new_experience_form" method="post" v-on:submit.prevent="addNewExperience">
                                <input type="hidden" name="user_id" v-model="user_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" :class="{'has-error': errors.company_name}">
                                            <label class="control-label">Company Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="company_name" class="form-control input-sm">
                                            <span v-if="errors.company_name" class="text-danger">@{{ errors.company_name[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" :class="{'has-error': errors.position_held}">
                                            <label class="control-label">Position Held : <span class="text-danger">*</span></label>
                                            <input type="text" name="position_held" class="form-control input-sm">
                                            <span v-if="errors.position_held" class="text-danger">@{{ errors.position_held[0]}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.job_start_date}">
                                            <label class="control-label">Job Start Date : <span class="text-danger">*</span></label>
                                            <input type="text" id="job_start_date" name="job_start_date" class="datepicker form-control input-sm" readonly="readonly">
                                            <span v-if="errors.job_start_date" class="text-danger">@{{ errors.job_start_date[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.job_end_date}">
                                            <label class="control-label">Job End Date : <span class="text-danger">*</span></label>
                                            <input type="text" id="job_end_date" name="job_end_date" class="datepicker form-control input-sm" readonly="readonly">
                                            <span v-if="errors.job_end_date" class="text-danger">@{{ errors.job_end_date[0]}}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
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

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-4 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="save_experience" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Add New
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

        <!-- <add-education :education_levels="education_levels" :user_id="user_id"></add-education> -->
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