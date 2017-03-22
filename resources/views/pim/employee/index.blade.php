@extends('layouts.hrms')
@section('content')

<section class="animated fadeIn p10" id="employee_list">
<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">
            <span class="glyphicon glyphicon-tasks"></span>Employee Information
            <span class="pull-right">
              <a href="{{url('employee/add')}}" class="btn btn-sm btn-dark btn-gradient dark"><span class="glyphicons glyphicons-user_add"></span> &nbsp; Add Employee</a>
            </span>
        </div>
    </div>
    <div class="panel-body pn">
        <table class="table table-striped table-hover" id="datatable1" cellspacing="0" width="100%">
            <thead>
            <tr class="bg-dark">
                <th>SL:</th>
                <th>Employee No</th>
                <th>Employee Name</th>
                <th>Email Address</th>
                <th>Designation</th>
                <!-- <th>Level</th> -->
                <th>Department</th>
                <!-- <th>Unit</th> -->
                <th>Image</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tfoot>
            <tr class="bg-dark">
                <th>SL:</th>
                <th>Employee No</th>
                <th>Employee Name</th>
                <th>Email Address</th>
                <th>Designation</th>
                <!-- <th>Level</th> -->
                <th>Department</th>
                <!-- <th>Unit</th> -->
                <th>Image</th>
                <th>Created By</th>
                <th>Updated By</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Action</th>
            </tr>
            </tfoot>
            <tbody>
            <?php $sl=1;?>
            @foreach($users as $user)
                <tr>
                   <td>{{$sl}}</td>
                   <td>{{$user->employee_no}}</td>
                   <td>{{$user->fullname}}</td>
                   <td>{{$user->email}}</td>
                   <td>{{$user->designation->designation_name}}</td>
                  
                   <td>{{$user->designation->department->department_name}}</td>
              
                   <td>
                      @if($user->photo)
                       <img src="{{$user->full_image}}" alt="{{$user->fullname}}" width="50px">
                       @else
                       <img src="{{asset('img/placeholder.png')}}" alt="" width="50px">
                       @endif
                   </td>
                   <td>@if($user->createdBy) {{$user->createdBy->fullname}} @else Maybe system @endif</td>
                   <td>@if($user->updatedBy) {{$user->updatedBy->fullname}} @else Maybe system @endif</td>
                   <td>{{$user->created_at}}</td>
                   <td>{{$user->updated_at}}</td>
                   <td>
                       <div class="btn-group">
                           <a href="{{url('/employee/edit/'.$user->id)}}" class="btn btn-sm btn-primary">
                               <i class="glyphicons glyphicons-pencil"></i>
                           </a>
                       </div>
                       <div class="btn-group">
                           <a href="{{url('/employee/view/'.$user->employee_no)}}" class="btn btn-sm btn-success">
                               <i class="glyphicons glyphicons-eye_open"></i>
                           </a>
                       </div>
                       <div class="btn-group pt5">
                           <a class="btn btn-sm {{($user->status == 0)?'text-primary':'text-danger'}}" v-on:click="changeStatus($event,<?php echo $user->id?>)">{{($user->status == 0)?'Active':'Inactive'}}</a>
                       </div>
                       
                       <!-- <div class="btn-group">
                           <a href="{{url('/employee/delete/'.$user->id)}}" class="btn btn-sm btn-danger">
                               <i class="glyphicons glyphicons-bin"></i>
                           </a>
                       </div> -->
                   </td>
                </tr>
                <?php $sl++;?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</section>

@section('script')

<script type="text/javascript">

  new Vue({
    el: '#employee_list',
    methods:{

      changeStatus(e,id){
        $.LoadingOverlay("show");
        // console.log(e.target.className = 'tarek');
        var status = e.target.text;
        axios.post('/employee/status-change',{'id':id,'status':status}).then((response) => {
          if(status == 'Active'){
            e.target.classList.remove("text-primary");
            e.target.classList.add("text-danger");
            e.target.text = "Inactive";            
          }else{
            e.target.classList.remove("text-danger");
            e.target.classList.add("text-primary");
            e.target.text = "Active";
          }
          $.LoadingOverlay("hide");
          this.showMessage(response.data);
        }).catch((error) => {

          if(error.response.status == 500 || error.response.data.status == 'danger'){
                this.showMessage(error.response.data);
            }
          $.LoadingOverlay("hide");
        });
      },

      showMessage(data){
        new PNotify({
            title: data.title,
            text: data.message,
            shadow: true,
            addclass: 'stack_top_right',
            type: data.status,
            width: '290px',
            delay: 2000,
            icon: false,
        });
      },
    }
  });
</script>

@endsection


@endsection