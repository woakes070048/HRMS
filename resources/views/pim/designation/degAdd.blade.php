@extends('layouts.hrms')
@section('content')

    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-8">
                <?php 
                    $msgs = ['success','danger']; 
                    foreach($msgs as $msg){ if(Session::has($msg)){ ?>
                    <div class="alert alert-{{$msg}} alert-dismissible" role="alert" style="margin-top:10px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{ucfirst($msg)}}!</strong> {{Session::get($msg)}}
                    </div>
                <?php } } ?>

                @if(empty($info))
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">Add Designation</span>
                        </div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('designation/add') }} ">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Name</label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control input-sm" name="name" value="{{ old('name') }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-3 control-label">Department</label>

                                <div class="col-md-9">
                                    <select id="department" name="department" class="form-control department input-sm">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" @if(old('department') == $department->id){{"selected"}}@endif>{{$department->department_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('department'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="col-md-3 control-label">Level</label>

                                <div class="col-md-9">
                                    <select id="level" name="level" class="form-control level input-sm">
                                        <option value="">Select Level</option>
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}" @if(old('level') == $level->id){{"selected"}}@endif>{{$level->level_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('level'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('level') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="col-md-3 control-label">Details</label>

                                <div class="col-md-9">
                                    <textarea id="details" class="form-control input-sm" name="details" autofocus>{{ old('details') }}</textarea>

                                    @if ($errors->has('details'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="radio-custom radio-success mb5">
                                                <input type="radio" id="active" name="status" checked="" value="1">
                                                <label for="active">Active</label>
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="radio-custom radio-danger mb5">
                                                <input type="radio" id="inactive" name="status" value="0">
                                                <label for="inactive">Inactive</label>
                                            </div>    
                                        </div>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                @elseif(count($info->id) > 0)
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">Edit Designation</span>
                        </div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" method="POST" action="{{ url('designation/edit') }} ">

                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{ $info->id }}">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Name</label>

                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control input-sm" name="name" value="{{ $info->designation_name }}" autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-3 control-label">Department</label>

                                <div class="col-md-9">
                                    <select id="department" name="department" class="form-control department input-sm">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" 
                                                @if($info->department_id == $department->id)
                                                    {{"selected"}}
                                                @endif
                                            >{{$department->department_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('department'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('department') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                                <label for="level" class="col-md-3 control-label">Level</label>

                                <div class="col-md-9">
                                    <select id="level" name="level" class="form-control level input-sm">
                                        <option value="">Select Level</option>
                                        @foreach($levels as $level)
                                            <option value="{{$level->id}}" 
                                                @if($info->level_id == $level->id)
                                                    {{"selected"}}
                                                @endif
                                            >{{$level->level_name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('level'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('level') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="col-md-3 control-label">Details</label>

                                <div class="col-md-9">
                                    <textarea id="details" class="form-control input-sm" name="details">{{ $info->designation_description }}</textarea>

                                    @if ($errors->has('details'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('details') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="radio-custom radio-success mb5">
                                                <input type="radio" id="active" name="status" @if($info->status == 1) {{"checked"}}  @endif value="1">
                                                <label for="active">Active</label>
                                            </div>    
                                        </div>
                                        <div class="col-md-4">
                                            <div class="radio-custom radio-danger mb5">
                                                <input type="radio" id="inactive" name="status" @if($info->status == 0) {{"checked"}}  @endif value="0">
                                                <label for="inactive">Inactive</label>
                                            </div>    
                                        </div>
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </section>
    <!-- End: Content -->       

@endsection