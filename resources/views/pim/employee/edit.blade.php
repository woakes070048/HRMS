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
            <span class="panel-title hidden-xs"><span
                        class="glyphicons glyphicons-user_add"></span> Add New Employee</span>
            <ul class="nav panel-tabs-border panel-tabs">
                <li class="@if($tab == '') active @endif">
                    <a href="#tab1_1" v-on:click="tab = ''" data-toggle="tab" aria-expanded="true">Basic</a>
                </li>
                <li class="@if($tab == 'personal') active @endif">
                    <a @if(isset($id)) href="#tab1_2" v-on:click="tab = 'personal'" data-toggle="tab"
                       @endif aria-expanded="true">Personal</a>
                </li>
                <li class="@if($tab == 'education') active @endif">
                    <a @if(isset($id)) href="#tab1_3" v-on:click="tab = 'education'" data-toggle="tab"
                       @endif aria-expanded="true">Education</a>
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
                                            <label class="control-label">Employee No : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="employee_no"
                                                   value="{{($user->employee_no)?$user->employee_no:old('employee_no')}}"
                                                   class="form-control input-sm" placeholder="Enter Employee No">
                                            @if($errors->has('employee_no'))<span
                                                    class="help-block">{{$errors->first('employee_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{$errors->has('designation_id')?'has-error':''}}">
                                            <label class="control-label">Employee Designation : <span
                                                        class="text-danger">*</span></label>
                                            <?php $designation_id = ($user->designation_id) ? $user->designation_id : old('designation_id'); ?>
                                            <select class="form-control input-sm" id="designation_id"
                                                    name="designation_id">
                                                <option v-bind:value="0">---- Select Employee Designation ----</option>
                                                <option v-for="(designation,index) in designations"
                                                        v-bind:value="designation.id"
                                                        :selected="designation.id == {{json_encode($user->designation_id)?true:false}}">@{{designation.designation_name}}</option>
                                            </select>
                                            @if($errors->has('designation_id'))<span
                                                    class="help-block">{{$errors->first('designation_id')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button type="button"
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
                                            <label class="control-label">First Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name"
                                                   value="{{($user->first_name)?$user->first_name:old('first_name')}}"
                                                   class="form-control input-sm" placeholder="Enter First Name">
                                            @if($errors->has('first_name'))<span
                                                    class="help-block">{{$errors->first('first_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Middle Name : </label>
                                            <input type="text" name="middle_name"
                                                   value="{{($user->middle_name)?$user->middle_name:old('middle_name')}}"
                                                   class="form-control input-sm" placeholder="Enter Middle Name">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('last_name')?'has-error':''}}">
                                            <label class="control-label">Last Name : <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name"
                                                   value="{{($user->last_name)?$user->last_name:old('last_name')}}"
                                                   class="form-control input-sm" placeholder="Enter Last Name">
                                            @if($errors->has('last_name'))<span
                                                    class="help-block">{{$errors->first('last_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Nick Name</label>
                                            <input type="text" name="nick_name"
                                                   value="{{ ($user->nick_name)?$user->nick_name:old('nick_name')}}"
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
                                                   value="{{($user->email)?$user->email:old('email')}}"
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
                                                   value="{{($user->mobile_number)?$user->mobile_number:old('mobile_number')}}"
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
                                            <input type="password" name="retype_password" class="form-control input-sm"
                                                   placeholder="Enter Retype Password">
                                            @if($errors->has('retype_password'))<span
                                                    class="help-block">{{$errors->first('retype_password')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 pt50">
                                        <label class="control-label">Employee Photo :</label>
                                        <div class="fileupload @if($user->photo) fileupload-exists @else fileupload-new @endif admin-form"
                                             data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail mb15">
                                                @if($user->photo)
                                                    <img src="{{$user->full_image}}" alt="holder">
                                                @else
                                                    <img src="{{asset('img/placeholder.png')}}" alt="holder">
                                                @endif
                                            </div>
                                            <span class="button btn btn-sm btn-dark btn-file btn-block ph5">
                                                @if($user->photo)
                                                    <span class="fileupload-exists"><span class="fa fa-user"></span> &nbsp; <strong>Change Photo</strong></span>
                                                @else
                                                    <span class="fileupload-new"><span class="fa fa-user"></span> &nbsp; <strong>Select Photo</strong></span>
                                                @endif
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
                                                        <option value="">---- Select Division ----</option>
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
                                                        <option value="">---- Select District ----</option>
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
                                                        <option value="">---- Select Police Station ----</option>
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
                                                    <select class="form-control input-sm" name="permanent_division_id"
                                                            v-model="permanent_division_id">
                                                        <option value="">---- Select Division ----</option>
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
                                                    <select class="form-control input-sm" name="permanent_district_id"
                                                            v-model="permanent_district_id">
                                                        <option value="">---- Select Employee Designation ----</option>
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
                                                        <option value="">---- Select Police Station ----</option>
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
                                            <button @if(isset($id)) disabled="disabled" @endif type="submit"
                                                    name="save_next" value="save_next"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Create & Next
                                                <span class="glyphicons glyphicons-right_arrow"></span></button>
                                        </p>
                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button @if(isset($id)) disabled="disabled" @endif type="submit"
                                                    name="add_employee"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Create
                                                Employee
                                            </button>
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
                            <form action="@if(isset($id) && isset($tab)){{url('employee/add/'.$id.'/personal')}}@endif"
                                  method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('user_id')?'has-error':''}}">
                                            <label class="control-label">Employee Full Name:</label>
                                            <input type="text" value="{{($user->fullname)?$user->fullname:''}}"
                                                   class="form-control input-sm" disabled>
                                            <input type="hidden" name="user_id" value="{{($user->id)?$user->id:''}}"
                                                   class="form-control input-sm">
                                            @if($errors->has('user_id'))<span
                                                    class="help-block">{{$errors->first('user_id')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('father_name')?'has-error':''}}">
                                            <label class="control-label">Father Name : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="father_name"
                                                   value="{{($user->details->father_name)?$user->details->father_name:old('father_name')}}"
                                                   class="form-control input-sm" placeholder="Enter Father Name">
                                            @if($errors->has('father_name'))<span
                                                    class="help-block">{{$errors->first('father_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('mother_name')?'has-error':''}}">
                                            <label class="control-label">Father Name : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="mother_name"
                                                   value="{{($user->details->mother_name)?$user->details->mother_name:old('mother_name')}}"
                                                   class="form-control input-sm" placeholder="Enter Mother Name">
                                            @if($errors->has('mother_name'))<span
                                                    class="help-block">{{$errors->first('mother_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('national_id')?'has-error':''}}">
                                            <label class="control-label">National Id : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="national_id"
                                                   value="{{($user->details->national_id)?$user->details->national_id:old('national_id')}}"
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
                                            <input type="text" name="passport_no"
                                                   value="{{($user->details->passport_no)?$user->details->passport_no:old('passport_no')}}"
                                                   class="form-control input-sm" placeholder="Enter Passport No">
                                            @if($errors->has('passport_no'))<span
                                                    class="help-block">{{$errors->first('passport_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('tin_no')?'has-error':''}}">
                                            <label class="control-label">Tin No :</label>
                                            <input type="text" name="tin_no"
                                                   value="{{($user->details->tin_no)?$user->details->tin_no:old('tin_no')}}"
                                                   class="form-control input-sm" placeholder="Enter Tin No">
                                            @if($errors->has('tin_no'))<span
                                                    class="help-block">{{$errors->first('tin_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('personal_email')?'has-error':''}}">
                                            <label class="control-label">Personal Email : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="personal_email"
                                                   @if(empty($user->details->personal_email) && empty(old('personal_email'))) value="{{($user->email)}}"
                                                   @else value="{{($user->details->personal_email)?$user->details->personal_email:old('personal_email')}}"
                                                   @endif class="form-control input-sm"
                                                   placeholder="Enter Personal Email">
                                            @if($errors->has('personal_email'))<span
                                                    class="help-block">{{$errors->first('personal_email')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('official_email')?'has-error':''}}">
                                            <label class="control-label">Official Email : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="official_email"
                                                   @if(empty($user->details->official_email) && empty(old('official_email'))) value="{{($user->email)}}"
                                                   @else value="{{($user->details->official_email)?$user->official_email:old('official_email')}}"
                                                   @endif class="form-control input-sm"
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
                                            <input type="text" name="phone_number"
                                                   value="{{($user->details->phone_number)?$user->details->phone_number:old('phone_number')}}"
                                                   class="form-control input-sm" placeholder="Enter Phone Number">
                                            @if($errors->has('phone_number'))<span
                                                    class="help-block">{{$errors->first('phone_number')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('birth_date')?'has-error':''}}">
                                            <label class="control-label">Birth Date :</label>
                                            <input type="text" name="birth_date"
                                                   value="{{($user->details->birth_date)?$user->details->birth_date:old('birth_date')}}"
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
                                            <input type="text" name="joining_date"
                                                   value="{{($user->details->joining_date)?$user->details->joining_date:old('joining_date')}}"
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
                                                <option value="">---- Select Blood Group ----</option>
                                                <option v-bind:value="blood_group.id"
                                                        v-for="(blood_group, index) in blood_group">@{{ blood_group.blood_name}}</option>
                                            <!-- @foreach($blood_groups as $blood_group)
                                                <option value="{{$blood_group->id}}" @if($user->details->blood_group_id == $blood_group->id) selected="selected" @endif>{{$blood_group->blood_name}}</option>
                                                @endforeach -->
                                            </select>
                                            @if($errors->has('blood_group_id'))<span
                                                    class="help-block">{{$errors->first('blood_group_id')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('gender')?'has-error':''}}">
                                            <label class="control-label">Gender : <span
                                                        class="text-danger">*</span></label>
                                            <div class="radio-custom mb5">
                                                <input id="male" name="gender" type="radio" value="male"
                                                       @if($user->details->gender == 'male') checked="checked" @endif>
                                                <label for="male">Male</label>

                                                <input id="female" name="gender" type="radio" value="female"
                                                       @if($user->details->gender == 'female') checked="checked" @endif>
                                                <label for="female">Female</label>
                                            </div>
                                            @if($errors->has('gender'))<span
                                                    class="help-block">{{$errors->first('gender')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('marital_status')?'has-error':''}}">
                                            <label class="control-label">Marital Status : <span
                                                        class="text-danger">*</span></label>
                                            <div class="radio-custom mb5">
                                                <input id="married" name="marital_status" type="radio" value="married"
                                                       @if($user->details->marital_status == 'married') checked="checked" @endif>
                                                <label for="married">Married</label>

                                                <input id="unmarried" name="marital_status" type="radio"
                                                       value="unmarried"
                                                       @if($user->details->marital_status == 'unmarried') checked="checked" @endif>
                                                <label for="unmarried">Unmarried</label>
                                            </div>
                                            @if($errors->has('marital_status'))<span
                                                    class="help-block">{{$errors->first('marital_status')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('religion')?'has-error':''}}">
                                            <label class="control-label">Religion :</label>
                                            <input type="text" name="religion"
                                                   value="{{($user->details->religion)?$user->details->religion:old('religion')}}"
                                                   class="form-control input-sm" placeholder="Enter Religion">
                                            @if($errors->has('religion'))<span
                                                    class="help-block">{{$errors->first('religion')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('nationality')?'has-error':''}}">
                                            <label class="control-label">Nationality :</label>
                                            <input type="text" name="nationality"
                                                   value="{{($user->details->nationality)?$user->details->nationality:old('nationality')}}"
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
                                                   value="{{($user->details->emergency_contact_person)?$user->details->emergency_contact_person:old('emergency_contact_person')}}"
                                                   class="form-control input-sm" placeholder="Emergency Contact Person">
                                            @if($errors->has('emergency_contact_person'))<span
                                                    class="help-block">{{$errors->first('emergency_contact_person')}}</span>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group {{$errors->has('emergency_contact_address')?'has-error':''}}">
                                            <label class="control-label">Emergency Contact Address :</label>
                                            <textarea name="emergency_contact_address" class="form-control input-sm"
                                                      cols="60" rows="1"
                                                      placeholder="Emergency Contact Address">{{($user->details->emergency_contact_address)?$user->details->emergency_contact_address:old('emergency_contact_address')}}</textarea>
                                            @if($errors->has('emergency_contact_address'))<span
                                                    class="help-block">{{$errors->first('emergency_contact_address')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button @if($user->details) disabled="true" @endif type="submit"
                                                    name="save_personal"
                                                    class="btn btn-dark btn-gradient dark btn-block"><span
                                                        class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next <span class="glyphicons glyphicons-right_arrow"></span></button>
                                            </button>
                                        </p>
                                    </div>

                                    <div class="col-sm-2 pull-right">
                                        <p class="text-left">
                                            <button @if($user->details) disabled="true" @endif type="submit"
                                                    name="save_personal"
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
                <div id="tab1_3" class="tab-pane @if($tab == 'education') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            @if($user->education)
                                <form action="@if(isset($id) && isset($tab)){{url('employee/add/'.$id.'/'.$tab)}}@endif"
                                  method="post">
                                {{csrf_field()}}
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('user_id')?'has-error':''}}">
                                            <label class="control-label">Employee Full Name:</label>
                                            <input type="text" value="{{($user->fullname)?$user->fullname:''}}"
                                                   class="form-control input-sm" disabled>
                                            <input type="hidden" name="user_id" value="{{($user->id)?$user->id:''}}"
                                                   class="form-control input-sm">
                                            @if($errors->has('user_id'))<span
                                                    class="help-block">{{$errors->first('user_id')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('education_level_name')?'has-error':''}}">
                                            <label class="control-label">Education Level :</label>
                                            <select class="form-control input-sm" name="education_level_name"
                                                    v-on:change="getInstituteAndDegreeByEducationLevelId()"
                                                    v-model="education_level_id">
                                                <option v-bind:value="0">---- Select Education Level ----</option>
                                                <option v-bind:value="education_level.id"
                                                        v-for="(education_level, index) in education_levels">@{{ education_level.education_level_name }}</option>
                                            </select>
                                            @if($errors->has('education_level_name'))<span
                                                    class="help-block">{{$errors->first('education_level_name')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('institute_id')?'has-error':''}}">
                                            <label class="control-label">Institute :</label>
                                            <select class="form-control input-sm" name="institute_id">
                                                <option v-bind:value="0">---- Select Institute ----</option>
                                                <option v-bind:value="institute.id"
                                                        v-for="(institute, index) in institutes">@{{ institute.institute_name }}</option>
                                            </select>
                                            @if($errors->has('institute_id'))<span
                                                    class="help-block">{{$errors->first('institute_id')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('degree_id')?'has-error':''}}">
                                            <label class="control-label">Degree :</label>
                                            <select class="form-control input-sm" name="degree_id">
                                                <option v-bind:value="0">---- Select Degree ----</option>
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
                                            <label class="control-label">Pass Year : <span class="text-danger">*</span></label>
                                            <input type="text" name="pass_year" class="datepicker form-control input-sm"
                                                   readonly="">
                                            @if($errors->has('pass_year'))<span
                                                    class="help-block">{{$errors->first('pass_year')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('result_type')?'has-error':''}}">
                                            <label class="control-label">Result Type :</label>
                                            <div class="radio-custom mb5">
                                                <input id="result_type_cgpa" name="result_type" type="radio" value="1" checked="checked"
                                                       v-on:click="showCgpa=true,showDivision=false">
                                                <label for="result_type_cgpa">CGPA</label>

                                                <input id="result_type_division" name="result_type" type="radio"
                                                       value="2" v-on:click="showCgpa=false,showDivision=true">
                                                <label for="result_type_division">Division</label>
                                            </div>
                                            @if($errors->has('result_type'))<span
                                                    class="help-block">{{$errors->first('result_type')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3" v-if="showCgpa">
                                        <div class="form-group {{$errors->has('cgpa')?'has-error':''}}">
                                            <label class="control-label">CGPA :</label>
                                            <input type="number" name="cgpa"
                                                   value="{{($user->details->cgpa)?$user->details->religion:old('cgpa')}}"
                                                   class="form-control input-sm" placeholder="Enter CGPA">
                                            @if($errors->has('cgpa'))<span
                                                    class="help-block">{{$errors->first('cgpa')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3" v-if="showDivision">
                                        <div class="form-group {{$errors->has('division')?'has-error':''}}">
                                            <label class="control-label">Division :</label>
                                            <select name="division" class="form-control input-sm">
                                                <option value="">--- Select Division ---</option>
                                                <option value="1">First Division</option>
                                                <option value="2">Second Division</option>
                                                <option value="3">Third Division</option>
                                            </select>
                                            @if($errors->has('division'))<span
                                                    class="help-block">{{$errors->first('division')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mt25">
                                            <button id="add_education" class="btn btn-dark btn-gradient dark btn-block"
                                                    data-effect="mfp-with-fade"><span
                                                        class="glyphicons glyphicons-briefcase"></span> &nbsp; Add New
                                                Education
                                            </button>
                                        </div>
                                    </div>
                                </div>


                                <hr class="short alt">



                                </form>
                            @else
                                <form action="@if(isset($id) && isset($tab)){{url('employee/add/'.$id.'/education')}}@endif"
                                      method="post">
                                    {{csrf_field()}}
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('user_id')?'has-error':''}}">
                                                <label class="control-label">Employee Full Name:</label>
                                                <input type="text" value="{{($user->fullname)?$user->fullname:''}}"
                                                       class="form-control input-sm" disabled>
                                                <input type="hidden" name="user_id" value="{{($user->id)?$user->id:''}}"
                                                       class="form-control input-sm">
                                                @if($errors->has('user_id'))<span
                                                        class="help-block">{{$errors->first('user_id')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('education_level_id')?'has-error':''}}">
                                                <label class="control-label">Education Level :</label>
                                                <select class="form-control input-sm" name="education_level_id"
                                                        v-on:change="getInstituteAndDegreeByEducationLevelId()"
                                                        v-model="education_level_id">
                                                    <option v-bind:value="0">---- Select Education Level ----</option>
                                                    <option v-bind:value="education_level.id"
                                                            v-for="(education_level, index) in education_levels">@{{ education_level.education_level_name }}</option>
                                                </select>
                                                @if($errors->has('education_level_id'))<span
                                                        class="help-block">{{$errors->first('education_level_id')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('institute_id')?'has-error':''}}">
                                                <label class="control-label">Institute :</label>
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
                                                <label class="control-label">Degree :</label>
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
                                                <label class="control-label">Pass Year : <span class="text-danger">*</span></label>
                                                <input type="text" name="pass_year" class="date form-control input-sm"
                                                       readonly="">
                                                @if($errors->has('pass_year'))<span
                                                        class="help-block">{{$errors->first('pass_year')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('certificate')?'has-error':''}}">
                                                <label class="control-label">Certificate:</label>
                                                <input type="file" name="certificate" class="form-control btn-primary input-sm">
                                                @if($errors->has('certificate'))<span
                                                        class="help-block">{{$errors->first('certificate')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group {{$errors->has('result_type')?'has-error':''}}">
                                                <label class="control-label">Result Type :</label>
                                                <div class="radio-custom mb5">
                                                    <input id="result_type_cgpa" name="result_type" type="radio" value="cgpa" checked="checked"
                                                           v-on:click="showCgpa=true,showDivision=false">
                                                    <label for="result_type_cgpa">CGPA</label>

                                                    <input id="result_type_division" name="result_type" type="radio"
                                                           value="division" v-on:click="showCgpa=false,showDivision=true">
                                                    <label for="result_type_division">Division</label>
                                                </div>
                                                @if($errors->has('result_type'))<span
                                                        class="help-block">{{$errors->first('result_type')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3" v-if="showCgpa">
                                            <div class="form-group {{$errors->has('cgpa')?'has-error':''}}">
                                                <label class="control-label">CGPA :</label>
                                                <input type="number" name="cgpa"
                                                       class="form-control input-sm" placeholder="Enter CGPA">
                                                @if($errors->has('cgpa'))<span
                                                        class="help-block">{{$errors->first('cgpa')}}</span>@endif
                                            </div>
                                        </div>

                                        <div class="col-md-3" v-if="showDivision">
                                            <div class="form-group {{$errors->has('division')?'has-error':''}}">
                                                <label class="control-label">Division :</label>
                                                <select name="division" class="form-control input-sm">
                                                    <option value="">--- Select Division ---</option>
                                                    <option value="1">First Division</option>
                                                    <option value="2">Second Division</option>
                                                    <option value="3">Third Division</option>
                                                </select>
                                                @if($errors->has('division'))<span
                                                        class="help-block">{{$errors->first('division')}}</span>@endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group mt25">
                                                <button id="add_education" class="btn btn-dark btn-sm btn-gradient dark btn-block"
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
                                                <button type="submit"
                                                        name="save_education_and_next"
                                                        class="btn btn-dark btn-gradient dark btn-block"><span
                                                            class="glyphicons glyphicons-ok_2"></span> &nbsp; Save & Next <span class="glyphicons glyphicons-right_arrow"></span></button>
                                                </button>
                                            </p>
                                        </div>

                                        <div class="col-sm-2 pull-right">
                                            <p class="text-left">
                                                <button type="submit"
                                                        name="save_education"
                                                        class="btn btn-dark btn-gradient dark btn-block"><span
                                                            class="glyphicons glyphicons-ok_2"></span> &nbsp; Save Education
                                                </button>
                                            </p>
                                        </div>
                                    </div>

                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!---  Experience Info ---->
                <div id="tab1_4" class="tab-pane @if($tab == 'experience') active @endif">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="@if(isset($id) && isset($tab)){{url('employee/add/'.$id.'/'.$tab)}}@endif"
                                  method="post">
                                {{csrf_field()}}


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('passport_no')?'has-error':''}}">
                                            <label class="control-label">Passport No :</label>
                                            <input type="text" name="passport_no"
                                                   value="{{($user->details->passport_no)?$user->details->passport_no:old('passport_no')}}"
                                                   class="form-control input-sm" placeholder="Enter Passport No">
                                            @if($errors->has('passport_no'))<span
                                                    class="help-block">{{$errors->first('passport_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('tin_no')?'has-error':''}}">
                                            <label class="control-label">Tin No :</label>
                                            <input type="text" name="tin_no"
                                                   value="{{($user->details->tin_no)?$user->details->tin_no:old('tin_no')}}"
                                                   class="form-control input-sm" placeholder="Enter Tin No">
                                            @if($errors->has('tin_no'))<span
                                                    class="help-block">{{$errors->first('tin_no')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('personal_email')?'has-error':''}}">
                                            <label class="control-label">Personal Email : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="personal_email"
                                                   @if(empty($user->details->personal_email) && empty(old('personal_email'))) value="{{($user->email)}}"
                                                   @else value="{{($user->details->personal_email)?$user->details->personal_email:old('personal_email')}}"
                                                   @endif class="form-control input-sm"
                                                   placeholder="Enter Personal Email">
                                            @if($errors->has('personal_email'))<span
                                                    class="help-block">{{$errors->first('personal_email')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('official_email')?'has-error':''}}">
                                            <label class="control-label">Official Email : <span
                                                        class="text-danger">*</span></label>
                                            <input type="text" name="official_email"
                                                   @if(empty($user->details->official_email) && empty(old('official_email'))) value="{{($user->email)}}"
                                                   @else value="{{($user->details->official_email)?$user->official_email:old('official_email')}}"
                                                   @endif class="form-control input-sm"
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
                                            <input type="text" name="phone_number"
                                                   value="{{($user->details->phone_number)?$user->phone_number:old('phone_number')}}"
                                                   class="form-control input-sm" placeholder="Enter Phone Number">
                                            @if($errors->has('phone_number'))<span
                                                    class="help-block">{{$errors->first('phone_number')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('birth_date')?'has-error':''}}">
                                            <label class="control-label">Birth Date :</label>
                                            <input type="text" name="birth_date"
                                                   value="{{($user->details->birth_date)?$user->details->birth_date:old('birth_date')}}"
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
                                            <input type="text" name="joining_date"
                                                   value="{{($user->details->joining_date)?$user->details->joining_date:old('joining_date')}}"
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
                                                <option value="">---- Select Blood Group ----</option>
                                                @foreach($blood_groups as $blood_group)
                                                    <option value="{{$blood_group->id}}"
                                                            @if($user->details->blood_group_id == $blood_group->id) selected="selected" @endif>{{$blood_group->blood_name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('blood_group_id'))<span
                                                    class="help-block">{{$errors->first('blood_group_id')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('gender')?'has-error':''}}">
                                            <label class="control-label">Gender : <span
                                                        class="text-danger">*</span></label>
                                            <div class="radio-custom mb5">
                                                <input id="male" name="gender" type="radio" value="male"
                                                       @if($user->details->gender == 'male') checked="checked" @endif>
                                                <label for="male">Male</label>

                                                <input id="female" name="gender" type="radio" value="female"
                                                       @if($user->details->gender == 'female') checked="checked" @endif>
                                                <label for="female">Female</label>
                                            </div>
                                            @if($errors->has('gender'))<span
                                                    class="help-block">{{$errors->first('gender')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('marital_status')?'has-error':''}}">
                                            <label class="control-label">Marital Status : <span
                                                        class="text-danger">*</span></label>
                                            <div class="radio-custom mb5">
                                                <input id="married" name="marital_status" type="radio" value="married"
                                                       @if($user->details->marital_status == 'married') checked="checked" @endif>
                                                <label for="married">Married</label>

                                                <input id="unmarried" name="marital_status" type="radio"
                                                       value="unmarried"
                                                       @if($user->details->marital_status == 'unmarried') checked="checked" @endif>
                                                <label for="unmarried">Unmarried</label>
                                            </div>
                                            @if($errors->has('marital_status'))<span
                                                    class="help-block">{{$errors->first('marital_status')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('religion')?'has-error':''}}">
                                            <label class="control-label">Religion :</label>
                                            <input type="text" name="religion"
                                                   value="{{($user->details->religion)?$user->details->religion:old('religion')}}"
                                                   class="form-control input-sm" placeholder="Enter Religion">
                                            @if($errors->has('religion'))<span
                                                    class="help-block">{{$errors->first('religion')}}</span>@endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{$errors->has('nationality')?'has-error':''}}">
                                            <label class="control-label">Nationality :</label>
                                            <input type="text" name="nationality"
                                                   value="{{($user->details->nationality)?$user->details->nationality:old('nationality')}}"
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
                                                   value="{{($user->details->emergency_contact_person)?$user->details->emergency_contact_person:old('emergency_contact_person')}}"
                                                   class="form-control input-sm" placeholder="Emergency Contact Person">
                                            @if($errors->has('emergency_contact_person'))<span
                                                    class="help-block">{{$errors->first('emergency_contact_person')}}</span>@endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group {{$errors->has('emergency_contact_address')?'has-error':''}}">
                                            <label class="control-label">Emergency Contact Address :</label>
                                            <textarea name="emergency_contact_address" class="form-control input-sm"
                                                      cols="60" rows="1"
                                                      placeholder="Emergency Contact Address">{{($user->details->emergency_contact_address)?$user->details->emergency_contact_address:old('emergency_contact_address')}}</textarea>
                                            @if($errors->has('emergency_contact_address'))<span
                                                    class="help-block">{{$errors->first('emergency_contact_address')}}</span>@endif
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-3 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="save_personal"
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
            </div>
        </div>

        <!-- Admin Form Popup -->
        <div id="add_education_form" style="max-width:700px" class="popup-basic mfp-with-anim mfp-hide">
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">
                        <i class="fa fa-rocket"></i>Add New Education
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" @submit.prevent="AddNewEducation('add_new_education')" id="add_new_education">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.has('education level') }">
                                            <label class="control-label">Education Level :</label>
                                            <select class="form-control input-sm" name="education level" v-validate data-vv-rules="required"
                                                    v-on:change="getInstituteAndDegreeByEducationLevelId()"
                                                    v-model="education_level_id">
                                                <option v-bind:value="''">---- Select Education Level ----</option>
                                                <option v-bind:value="education_level.id"
                                                        v-for="(education_level, index) in education_levels">@{{ education_level.education_level_name }}</option>
                                            </select>
                                            <span v-show="errors.has('education level')" class="text-danger">@{{ errors.first('education level') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.has('institute_name')}">
                                            <label class="control-label">Institute :</label>
                                            <select class="form-control input-sm" name="institute_name" v-validate data-vv-rules="required">
                                                <option v-bind:value="''">---- Select Institute ----</option>
                                                <option v-bind:value="institute.id"
                                                        v-for="(institute, index) in institutes">@{{ institute.institute_name }}</option>
                                            </select>
                                            <span v-show="errors.has('institute_name')" class="text-danger">@{{ errors.first('institute_name') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" :class="{'has-error': errors.has('degree_name')}">Degree :</label>
                                            <select class="form-control input-sm" name="degree_name" v-validate data-vv-rules="required">
                                                <option v-bind:value="''">---- Select Degree ----</option>
                                                <option v-bind:value="degree.id"
                                                        v-for="(degree, index) in degrees">@{{ degree.degree_name }}</option>
                                            </select>
                                            <span v-show="errors.has('degree_name')" class="text-danger">@{{ errors.first('degree_name') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group" :class="{'has-error': errors.has('pass_year') }">
                                            <label class="control-label">Pass Year : <span class="text-danger">*</span></label>
                                            <input type="text" name="pass_year" v-validate data-vv-rules="required" class="date form-control input-sm"
                                                   readonly="">
                                            <span v-show="errors.has('pass_year')" class="text-danger">@{{ errors.first('pass_year') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label" :class="{'has-error': errors.has('result-type') }">Result Type :</label>
                                            <div class="radio-custom mb5">
                                                <input id="result_type_cgpa" name="result-type" v-validate data-vv-rules="required" type="radio" value="1" checked="checked"
                                                       v-on:click="showCgpa=true,showDivision=false">
                                                <label for="result_type_cgpa">CGPA</label>

                                                <input id="result_type_division" name="result-type" v-validate data-vv-rules="required" type="radio"
                                                       value="2" v-on:click="showCgpa=false,showDivision=true">
                                                <label for="result_type_division">Division</label>

                                            </div>
                                            <span v-show="errors.has('result-type')" class="text-danger">@{{ errors.first('result-type') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4" v-if="showCgpa">
                                        <div class="form-group">
                                            <label class="control-label">CGPA :</label>
                                            <input type="number" name="cgpa"
                                                   value="{{($user->details->cgpa)?$user->details->religion:old('cgpa')}}"
                                                   class="form-control input-sm" placeholder="Enter CGPA">
                                        </div>
                                    </div>

                                    <div class="col-md-4" v-if="showDivision">
                                        <div class="form-group">
                                            <label class="control-label">Division :</label>
                                            <select name="division" class="form-control input-sm">
                                                <option value="">--- Select Division ---</option>
                                                <option value="1">First Division</option>
                                                <option value="2">Second Division</option>
                                                <option value="3">Third Division</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr class="short alt">

                                <div class="section row mbn">
                                    <div class="col-sm-4 pull-right">
                                        <p class="text-left">
                                            <button type="submit" name="save_personal"
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

        {{--<add-education></add-education>--}}
    </div>
</section>



@section('script')
    <!-- FileUpload JS -->
    <script src="{{asset('vendor/plugins/fileupload/fileupload.js')}}"></script>

    <!-- Page Plugins -->
    <script src="{{asset('vendor/plugins/magnific/jquery.magnific-popup.js')}}"></script>


    <script type="text/javascript">

        var base_url = "{{url('/')}}";
        var current_tab = "{{($tab)?$tab:''}}";
        var id = "{{(isset($id))?base64_encode($id).'/':''}}";

        jQuery(document).ready(function () {

            $('.date').datetimepicker({
                format: 'YYYY',
                viewMode: 'years',
                minViewMode: "years",
                pickTime: false
            });

            // Modal Start
            $('#add_education').on('click', function (e) {
                e.preventDefault();
                $(this).removeClass('active-animation');
                $(this).addClass('active-animation item-checked');

                $.magnificPopup.open({
                    removalDelay: 300,
                    items: {
                        src: "#add_education_form"
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
            //Modal End

        });


//        import VeeValidate from 'vee-validate';
//        Vue.use(VeeValidate);
//
//        new Vue({
//            el : '#employee',
//            data : {
//                tempData:null,
//                tab: current_tab,
//                showCgpa:true,
//
//                present_division_id:null,
//                present_district_id:null,
//
//                permanent_division_id:null,
//                permanent_district_id:null,
//
//                designations: [],
//                divisions: [],
//                districts:[],
//                permanentDistricts:[],
//                policeStations: [],
//                permanentPoliceStations: [],
//                blood_group : [],
//                education_level_id: null,
//                education_levels : [],
//                institutes: [],
//                degrees:[],
//
//                showDivision:false,
//                showCgpa: true
//            },
//
//            mounted(){
//                this.getTabData();
//            },
//
//            watch : {
//                tab: 'getTabData',
//                present_division_id: function(id){
//                    this.getDistrictByDivisionId(id,'present');
//                },
//
//                present_district_id: function(id){
//                    this.getPoliceStationByDistrictId(id,'present');
//                },
//
//                permanent_division_id: function(id){
//                    this.getDistrictByDivisionId(id,'permanent');
//                },
//
//                permanent_district_id: function(id){
//                    this.getPoliceStationByDistrictId(id,'permanent');
//                },
//            },
//
//            methods : {
//
//                validateBeforeSubmit(){
//                    return this.$validator.validateAll().then(success => {
//                        if (!success) {
//                            return false;
//                        }else{
//                            this.addList();
//                        }
//                    });
//                },
//
//                getTabData(){
//                    // alert(this.tab);
//                    window.history.pushState('obj', this.tab, base_url+'/employee/add/'+id+this.tab);
//
//                    if(this.tab == ''){
//                        this.getDesignations();
//                        this.getDivisions();
//                    }
//                    if(this.tab == 'personal'){
//                        this.getBloodGroups();
//                    }
//                    if(this.tab == 'education'){
//                        this.getEducationLevels();
//                    }
//                },
//
//                getDesignations(){
//                    axios.get('/get-designations').then(response => this.designations = response.data);
//                },
//
//                getDivisions(){
//                    axios.get('/get-divisions').then(response => this.divisions = response.data);
//                },
//
//                getDistrictByDivisionId(id,tempData){
//                    axios.get('/get-district-by-division/'+id)
//                        .then((response)=>{
//                        if(tempData == 'permanent'){
//                        this.permanentDistricts = response.data;
//                    }
//                    if(tempData == 'present'){
//                        this.districts = response.data;
//                    }
//                });
//                },
//
//                getPoliceStationByDistrictId(id,tempData){
//                    axios.get('/get-police-station-by-district/'+id)
//                        .then((response) => {
//                        this.policeStations = response.data
//                    if(tempData == 'permanent'){
//                        this.permanentPoliceStations = response.data;
//                    }
//                    if(tempData == 'present'){
//                        this.policeStations = response.data;
//                    }
//                });
//                },
//
//                getBloodGroups(){
//                    axios.get('/get-blood-groups').then(
//                        response => this.blood_group = response.data
//                );
//                },
//
//                getEducationLevels(){
//                    axios.get('/get-education-levels').then(
//                        response => this.education_levels = response.data
//                );
//                },
//
//                getInstituteAndDegreeByEducationLevelId(){
//                    var id = this.education_level_id;
//                    this.getInstituteByEducationLevelId(id);
//                    this.getDegreeByEducationLevelId(id);
//                },
//
//                getInstituteByEducationLevelId(id){
//                    axios.get('/get-institute-by-education-level/'+id).then(
//                        response => this.institutes = response.data
//                );
//                },
//
//                getDegreeByEducationLevelId(id){
//                    axios.get('/get-degree-by-education-level/'+id).then(
//                        response => this.degrees = response.data
//                );
//                },
//
//            },
//        });


    </script>

    <script type="text/javascript" src="{{asset('/js/employee.js')}}"></script>
@endsection


@endsection