@extends('layouts.hrms')
@section('content')

<section class="animated fadeIn p10">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-visible" id="spy3">
                <div class="panel-heading">
                    <div class="panel-title hidden-xs">
                        <span class="glyphicon glyphicon-tasks"></span>Employee Information</div>
                </div>
                <div class="panel-body pn">
                    <table class="table table-striped table-hover" id="datatable1" cellspacing="0" width="100%">
                        <thead>
                        <tr class="bg-dark">
                            <th>SL No:</th>
                            <th>Employee No</th>
                            <th>Employee Name</th>
                            <th>Email Address</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="bg-dark">
                            <th>SL No:</th>
                            <th>Employee No</th>
                            <th>Employee Name</th>
                            <th>Email Address</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th>Created Date</th>
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
                               <td>
                                  @if($user->photo)
                                   <img src="{{$user->full_image}}" alt="{{$user->fullname}}" width="50px">
                                   @else
                                   <img src="{{asset('img/placeholder.png')}}" alt="" width="50px">
                                   @endif
                               </td>
                               <td>{{$user->created_at->format('d M Y')}}</td>
                               <td>
                                   <div class="btn-group">
                                       <button type="button" class="btn btn-sm btn-primary">
                                           <i class="glyphicons glyphicons-pencil"></i>
                                       </button>
                                   </div>
                                   <div class="btn-group">
                                       <button type="button" class="btn btn-sm btn-success">
                                           <i class="glyphicons glyphicons-eye_open"></i>
                                       </button>
                                   </div>
                                   <div class="btn-group">
                                       <button type="button" class="btn btn-sm btn-danger">
                                           <i class="glyphicons glyphicons-bin"></i>
                                       </button>
                                   </div>
                               </td>
                            </tr>
                            <?php $sl++;?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection