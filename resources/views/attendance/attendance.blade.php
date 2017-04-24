@extends('layouts.hrms')
@section('content')

@section('style')
    <!-- Admin Forms CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-tools/admin-forms/css/admin-forms.css')}}">
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/plugins/magnific/magnific-popup.css')}}">

    <style type="text/css">
      .name_show{
        font-size: 14px;
        font-weight: bold;
        visibility: hidden;
        position: absolute;
        background: #70ca63;
        color: #fff;
        z-index: 10000;
        padding: 5px;
        margin: -10px;
        margin-top: -40px;
      }
      .show_name:hover .name_show{
        visibility: visible;
      }
    </style>
@endsection

<section id="attendanceID" class="p5 pt10">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><i class="glyphicons glyphicons-history"></i></span>
            <strong>Employee Attendance</strong>
        </div>

        <div class="panel-body">
          <form v-on:submit.prevent="getAttendance">
            <div class="row">

              <div class="col-md-3 col-md-offset-1">
                <div class="form-group">
                  <label class="control-label">Department :</label>
                  <select name="department_id" class="form-control input-sm">
                    <option value="0">---- All Department ----</option>
                    <option v-for="department in departments" :value="department.id" v-text="department.department_name"></option>
                  </select>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group" :class="{'has-error':errors.from_date}">
                  <label class="control-label">From Date :</label>
                  <input type="text" name="from_date" v-on:focusout="toDate" id="formDate" class="form-control input-sm" placeholder="Form Date.." readonly="readonly">
                </div>
              </div>

              <div class="col-md-3">  
                <div class="form-group" :class="{'has-error':errors.to_date}">
                  <label class="control-label">To Date :</label>
                  <input type="text" name="to_date" id="toDate" v-on:mouseover="toDate" class="form-control input-sm" placeholder="To Date.." readonly="readonly">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <br>
                  <button type="submit" class="form-control input-sm btn btn-sm btn-dark">Submit</button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel" v-show="showAttendance">
        <div class="panel-heading">
          <span class="panel-title"><i class="glyphicons glyphicons-history"></i></span>
          <strong>Show Attendance</strong>
        </div>

        <div class="panel-body pn" id="showAttendance">
          <table class="table table-bordered" v-if="attendances !=''">
            <thead class="bg-dark">
              <tr class="text-center">
                <th style="min-width:120px; max-width: 150px!important">Employee Name</th>
                <th v-for="day in days" v-text="day"></th>
              </tr>
            </thead>

            <tbody style="background: #fff!important">
              <tr v-for="(user,uIndex) in attendances" class="text-center">
                <td v-text="user.first_name+' '+user.last_name+' ('+user.employee_no+')'" class="bg-dark" style="min-width:120px; max-width: 150px!important"></td>

                <td v-for="(attendance,aIndex) in user.attendanceTimesheets" class="text-center show_name">

                  <div style="position: relative!important;"></div>
                  <div class="name_show" v-text="user.first_name+' '+user.last_name+' ('+user.employee_no+')'"></div>

                  <div v-if="attendance.observation == 1">
                    <i class="glyphicons glyphicons-share text-success"></i>
                    <span v-text="attendance.in_time"></span>

                    <hr class="pn" style="margin: 2px!important">

                    <i class="glyphicons glyphicons-unshare text-info"></i>
                    <span v-text="attendance.out_time"></span>
                  </div>

                  <div v-else-if="attendance.observation == 2">
                    <i class="imoon imoon-lanyrd text-warning"></i>
                    <div v-text="attendance.leave_type"></div>
                  </div>

                  <div v-else-if="attendance.observation == 3">
                      <i class="fa-h-square text-danger"></i>
                  </div>

                  <div v-else-if="attendance.observation == 0">@{{attendance.timesheet_observation}}
                    <a class="btn btn-sm btn-rounded" v-on:click.prevent="addAttendance(uIndex,aIndex,user.id, attendance.id, attendance.date, user.first_name+' '+user.last_name+' ('+user.employee_no+')','#attendance_modal')"><i class="fa fa-font text-danger"></i></a>
                  </div>

                </td>
              </tr>
            </tbody>
          </table>
          <h5 v-else style="padding: 10px;">Data is loading...</h5>
        </div>
      </div>
    </div>
  </div>



  <div id="attendance_modal" style="max-width:450px" class="popup-basic mfp-with-anim mfp-hide">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">
                <i class="fa fa-rocket"></i>Add Attendance <span class="text-info" v-text="attend.user_fullname"></span>
            </span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                  <form v-on:submit.prevent="saveAttendance">
                    <input type="hidden" name="user_id" v-model="attend.user_id">
                    <input type="hidden" name="time_sheet_id" v-model="attend.time_sheet_id">
                    <input type="hidden" name="observation" value="1">

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group" :class="{'has-error':errors.date}">
                              <label class="control-label">Attendance Date: <span class="text-danger">*</span></label>
                              <input type="text" name="date" v-model="attend.date" class="form-control input-sm" readonly="readonly">
                              <span v-if="errors.date" class="text-danger" v-text="errors.date[0]"></span>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group" :class="{'has-error':errors.in_time}">
                              <label class="control-label">In Time: <span class="text-danger">*</span></label>
                              <input type="text" name="in_time" v-model="attend.in_time" v-on:mouseover="myTimePicker" class="myTimePicker form-control input-sm" readonly="readonly">
                              <span v-if="errors.in_time" class="text-danger" v-text="errors.in_time[0]"></span>
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group" :class="{'has-error':errors.out_time}">
                              <label class="control-label">Out Time: <span class="text-danger">*</span></label>
                              <input type="text" name="out_time" v-model="attend.out_time" v-on:mouseover="myTimePicker" class="myTimePicker form-control input-sm" readonly="readonly">
                              <span v-if="errors.out_time" class="text-danger" v-text="errors.out_time[0]"></span>
                          </div>
                      </div>
                    </div>

                    <hr class="short alt">

                    <div class="section row mbn">
                        <div class="col-sm-6 pull-right">
                            <p class="text-left">
                                <button type="submit" name="add_attendance" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Add Attendance
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


</section>




@section('script')

<!-- Page Plugins -->
<script src="{{asset('vendor/plugins/magnific/jquery.magnific-popup.js')}}"></script>

<script type="text/javascript" src="{{asset('js/attendance.js')}}"></script>

@endsection

@endsection