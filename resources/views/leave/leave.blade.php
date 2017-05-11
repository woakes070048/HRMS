@extends('layouts.hrms')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <style type="text/css" media="screen">
        .sm-height {
            padding: 4px;
        }
    </style>
@endsection

@section('content')
<div id="mainDiv">
    <!-- Begin: Content -->
    <section id="content" class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"></span>
                        
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".dataAdd" style="margin-top: 12px;">Leave Application</button>
                    
                    </div>
                    <div class="panel-body">
                        <div id="showData">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr class="success">
                                        <th>sl</th>
                                        <th>Weekend</th>
                                        <th>Status</th>
                                        <th>Created Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr v-for="(info,index) in weekends">
                                        <td v-text="index+1"></td>
                                        <td v-text="info.weekend"></td>
                                        <td v-text="info.status==1?'Active':'Inactive'"></td>
                                        <td v-text="info.created_at"></td>
                                        <td>
                                            <button type="button" @click="editData(info.id, index)" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target=".dataEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Content -->   

    <!-- dataAdd modal start -->
    <div class="modal fade bs-example-modal-lg dataAdd" role="dialog" aria-labelledby="myLargeModalLabel" id="modalDataAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Leave Info</h4>
                </div>
                <form class="form-horizontal" @submit.prevent="saveData" id="addFormData" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div id="create-form-errors">
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="emp_name" class="col-md-3 control-label">Employee Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select2 name="emp_name" v-model="emp_name" style="
                                width: 100%;color: #555555;
                                border: 1px solid #dddddd;
                                transition: border-color ease-in-out .15s;
                                height: 30px;
                                padding: 5px 10px;
                                font-size: 12px;
                                line-height: 1.5;
                                border-radius: 2px;"
                                >
                                    <option value="">Select Employee Name For Leave</option>
                                    <option v-for="(info,index) in users" 
                                        :value="info.id" 
                                        v-text="info.first_name+' '+info.last_name+' - '+info.designation.designation_name"
                                    ></option>
                                </select2>
                            </div>
                        </div>

                        {{-- <div class="form-group" v-show="emp_name>0">
                            <label for="holiday_name" class="col-md-3 control-label">History</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Leave Amount</b>
                                        <ul>
                                            <li v-for="info in userHaveLeavs" v-text="info.leave_type.leave_type_name +' : '+ (info.number_of_days == null ? 'Undefined':info.number_of_days)"></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Leave Alreay Taken</b>
                                        <ul>
                                            <li v-for="info in userTakenLeave" v-text="info.name +' : '+ info.days">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group" style="padding-top: 0px;" v-show="emp_name>0">
                            <div class="row">
                                <div class="col-md-12 control-label">
                                    <div align="center"><h5 style="padding-top: 0px;margin-top: 0px;">Leave History</h5></div>
                                </div>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <table class="table">
                                    <tr class="success">
                                        <th>Sl</th>
                                        <th>Name</th>
                                        <th>Amount(Days)</th>
                                        <th>Taken(Days)</th>
                                    </tr>
                                    <tr v-for="(info, index) in show_history">
                                        <td v-text="index+1"></td>
                                        <td v-text="info.name"></td>
                                        <td v-text="info.amount_days == null ? 'Undefined':info.amount_days"></td>
                                        <td v-text="info.taken_days"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        {{-- v-if="info.days == null || info.days > 0" --}}
                        <div class="form-group">
                            <label for="emp_leave_type" class="col-md-3 control-label">Leave Type <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" name="emp_leave_type" id="emp_leave_type" v-model="emp_leave_type">
                                    <option value="">Select Type</option>
                                    <option v-for="(info,index) in userLeaveType" 
                                        :value="info.id" 
                                        v-text="info.name"
                                        :disabled="info.days == 0"
                                    ></option>
                                </select>
                                <input type="hidden" name="userLeaveType" v-model="userLeaveType">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="from_date" class="col-md-3 control-label">Select Date <span class="text-danger">*</span></label>
                            <div class="col-md-3">
                                <input type="text" id="from_date" name="from_date" v-model="from_date" class="gui-input datepicker form-control input-sm" placeholder="From">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="to_date" name="to_date" v-model="to_date" class="gui-input datepicker form-control input-sm" placeholder="To">
                            </div>
                            <label for="" class="col-md-2 control-label"><div @click="date_diff_cal" style="margin-top: -10px;" class="btn btn-xs btn-success">Cal. date diff.</div></label>
                            <label for="" class="col-md-1 control-label result" id="show_date_diff"></label>
                            <input type="hidden" v-model="date_diff" name="date_diff">
                            <label for="" style="color:#e95947;" class="col-md-9 control-label" id="show_date_diff_msg">
                                
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Reason <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea name="leave_reason" v-model="leave_reason" class="form-control input-sm" placeholder="Application reason"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Contact Address <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea name="leave_contact_address" v-model="leave_contact_address" class="form-control input-sm" placeholder="Leave time contact address."></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Contact Number</label>
                            <div class="col-md-9">
                                <input name="leave_contact_number" v-model="leave_contact_number" class="form-control input-sm" type="text" placeholder="Leave contract number.">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="passport_no" class="col-md-3 control-label">Passport Number</label>
                            <div class="col-md-9">
                                <input name="passport_no" v-model="passport_no" class="form-control input-sm" type="text" placeholder="Passport number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="responsible_emp" class="col-md-3 control-label">Responsible for official duty</label>
                            <div class="col-md-9">
                                <select2 name="responsible_emp" v-model="responsible_emp" style="
                                width: 100%;color: #555555;
                                border: 1px solid #dddddd;
                                transition: border-color ease-in-out .15s;
                                height: 30px;
                                padding: 5px 10px;
                                font-size: 12px;
                                line-height: 1.5;
                                border-radius: 2px;"
                                >
                                    <option value="">Select Responsible Employee</option>
                                    <option v-for="(info,index) in options" 
                                        :value="info.id" 
                                        v-text="info.first_name+' '+info.last_name+' - '+info.designation.designation_name"
                                    ></option>
                                </select2>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-success mb5">
                                            <input type="radio" name="leave_half_or_full" id="active" v-model="leave_half_or_full" value="1">
                                            <label for="active">Full day</label>
                                        </div>    
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-primary mb5">
                                            <input type="radio" name="leave_half_or_full" id="inactive" v-model="leave_half_or_full" value="2">
                                            <label for="inactive">Half day</label>
                                        </div>    
                                    </div>
                                </div>     
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="passport_no" class="col-md-3 control-label">Files</label>
                            <div class="col-md-9">
                                <input type="file" name="file[]" id="file" multiple="multiple"></input>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-close-btn" id="modal-close-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Process</button>
                    </div>
                </form>

                {{-- <form action="{{url('leave/add')}}" method="post" enctype="multipart/form-data">
                    
                    {{ csrf_field() }}

                    <input type="file" name="avatar">

                    <input type="submit" class="btn">
                </form> --}}
            </div>
        </div>
    </div>
    <!-- unitAdd modal end --> 

    <!-- salary Info Edit modal start -->
    {{-- <div class="modal fade bs-example-modal-lg dataEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalDataEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Weekend</h4>
                </div>
                
                <form class="form-horizontal" @submit.prevent="updateData('updateFormData')" id="updateFormData">
                    <div class="modal-body">

                        <div id="edit-form-errors">
                        </div>

                        {{ csrf_field() }}
                        <input type="hidden" name="hdn_id" v-model="hdn_id">

                        <div class="form-group">
                            <label class="col-md-3">Select Weekend</label>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Friday"> Friday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Saturday"> Saturday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Sunday"> Sunday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Monday"> Monday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Tuesday"> Tuesday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Wednesday"> Wednesday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="edit_weekend_name[]" value="Thursday"> Thursday
                                </div>
                            </div>      
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-success mb5">
                                            <input type="radio" name="edit_weekend_status" id="edit_active" v-model="edit_weekend_status" value="1">
                                            <label for="edit_active">Active</label>
                                        </div>    
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-danger mb5">
                                            <input type="radio" name="edit_weekend_status" id="edit_inactive" v-model="edit_weekend_status" value="0">
                                            <label for="edit_inactive">Inactive</label>
                                        </div>    
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default modal-close-btn" id="modal-edit-close-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
              
            </div>
        </div>
    </div> --}}
    <!-- salary Info Edit modal end --> 
</div>

@endsection

@section('script')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script> --}}
<script src="{{asset('/js/leave.js')}}"></script>
@endsection
