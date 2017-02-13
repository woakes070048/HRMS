@extends('layouts.hrms')
@section('content')

    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">

            <div class="col-md-8">
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
                        <span class="panel-title">All Levels</span>
                    </div>
                    <div class="panel-body">
                        @if($levels->count() > 0)
                        <table class="table table-hover">
                        <thead>
                            <tr class="success">
                                <th>sl</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1; ?>
                            @foreach($levels as $level)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $level->level_name }}</td>
                                <td>{{ $level->description }}</td>
                                <td>{{$level->status==1?"Active":"Inactive"}}</td>
                                <td>
                                    <a href="{{url("levels/edit/$level->id")}}" title="">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <a onclick="return confirm('Want to delete?');" href="{{url("levels/delete/$level->id")}}" title="">
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