@extends('layouts.hrms')
@section('content')

    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">

            <div class="col-md-10">
                <?php 
                    $msgs = ['success','danger']; 
                    foreach($msgs as $msg){ if(Session::has($msg)){?>
                    <div class="alert alert-{{$msg}} alert-dismissible" role="alert" style="margin-top:10px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ucfirst($msg)}}!</strong> {{Session::get($msg)}}
                    </div>
                <?php } } ?>

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">All Designations</span>
                    </div>
                    <div class="panel-body">
                        @if($designations->count() > 0)
                        <table class="table table-hover">
                        <thead>
                            <tr class="success">
                                <th>sl</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1; ?>
                            @foreach($designations as $designation)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $designation->designation_name }}</td>
                                <td>{{ $designation->department->department_name }}</td>
                                <td>{{ $designation->level->level_name }}</td>
                                <td>{{ $designation->designation_description }}</td>
                                <td>{{$designation->status==1?"Active":"Inactive"}}</td>
                                <td>
                                    <a href="{{url("designation/edit/$designation->id")}}" title="">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <a onclick="return confirm('Want to delete?');" href="{{url("designation/delete/$designation->id")}}" title="">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        @else
                            {{"No level available..."}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Content -->       

@endsection