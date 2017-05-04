@extends('layouts.hrms')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <style type="text/css" media="screen">
        
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
                        
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".dataAdd" style="margin-top: 12px;">Add New Leave</button>
                    
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
                <form class="form-horizontal" @submit.prevent="saveData('addFormData')" id="addFormData">
                    <div class="modal-body">

                        <div id="create-form-errors">
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="emp_name" class="col-md-3 control-label">Employee Name</label>
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
                                    <option disabled value="0">Select Employee Name For Leave</option>
                                    <option v-for="(info,index) in users" 
                                        :value="info.id" 
                                        v-text="info.first_name+' '+info.last_name+' - '+info.designation.designation_name"
                                    ></option>
                                </select2>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="holiday_name" class="col-md-3 control-label">History</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <b>Leave Amount</b>
                                        <ul>
                                            <li v-for="info in userHaveLeavs" v-text="info.leave_type.leave_type_name +' : '+ info.number_of_days"></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <b>Leave Alreay Taken</b>
                                        <ul>
                                            <li>Sick Leave: 4</li>
                                            <li>Earn Leave: 2</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="holiday_name" class="col-md-3 control-label">Leave Type</label>
                            <div class="col-md-9">
                                <select class="form-control input-sm" name="" id="">
                                    <option value="">Select Type</option>
                                    <option v-for="(info,index) in userLeaveType" 
                                        :value="info.leave_type_id" 
                                        v-text="info.leave_type.leave_type_name"
                                    ></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="from_date" class="col-md-3 control-label">Select Date</label>
                            <div class="col-md-3">
                                <input type="text" id="from_date" name="from_date"  class="gui-input datepicker form-control input-sm jqueryDate" placeholder="From">
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="to_date" name="to_date" class="gui-input datepicker form-control input-sm jqueryDate" placeholder="To">
                            </div>
                            <label for="" class="col-md-2 control-label">Total:</label>
                            <label for="" class="col-md-1 control-label result">00</label>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Reason</label>
                            <div class="col-md-9">
                                <textarea name="holiday_description" class="form-control input-sm" placeholder="Write note"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Contact Address</label>
                            <div class="col-md-9">
                                <textarea name="holiday_description" class="form-control input-sm" placeholder="Write note"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="holiday_name" class="col-md-3 control-label">Contact Number</label>
                            <div class="col-md-9">
                                <input name="holiday_name" class="form-control input-sm" type="text" placeholder="Holiday name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="passport_no" class="col-md-3 control-label">Passport Number</label>
                            <div class="col-md-9">
                                <input name="passport_no" v-model="passport_no" class="form-control input-sm" type="text" placeholder="Holiday name">
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
                                    <option disabled value="0">Select Responsible Employee</option>
                                    <option v-for="(info,index) in options" 
                                        :value="info.id" 
                                        v-text="info.first_name+' '+info.last_name+' - '+info.designation.designation_name"
                                    ></option>
                                </select2>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-close-btn" id="modal-close-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Process</button>
                    </div>
                </form>
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
