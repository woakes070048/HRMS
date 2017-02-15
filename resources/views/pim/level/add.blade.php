@extends('layouts.hrms')
@section('content')

    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                

                @if(empty($info))
                    <div class="panel" >
                        <div class="panel-heading">
                            <span class="panel-title">Add Level</span>
                            <a href="{{url('levels/index')}}">
                                <button type="button" class="btn btn-xs btn-success pull-right" style="margin-top: 12px;">Back</button>
                            </a>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('levels/add') }} ">

                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-2 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control input-sm" name="name" value="{{ old('name') }}" autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('salary_amount') ? ' has-error' : '' }}">
                                        <label for="salary_amount" class="col-md-2 control-label">Salary Amount</label>

                                        <div class="col-md-6">
                                            <input id="salary_amount" type="number" class="form-control input-sm" name="salary_amount" value="{{ old('salary_amount') }}" autofocus>

                                            @if ($errors->has('salary_amount'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('salary_amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">Salary Info(%)</label>

                                        <div class="col-md-10">
                                            @foreach($salary_info as $sInfo)
                                                <div class="col-md-4">
                                                    <div class="col-md-8">
                                                        {{-- <input type="checkbox" name="salaryInfoChk[]"> --}}
                                                        {{ $sInfo->name }}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salryInfoPercent[]" value="{{$sInfo->amount}}">  

                                                        <input type="hidden" name="salryInfoName[]" value="{{$sInfo->name}}">      
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">Permission</label>

                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    1. Manage Depertment:
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Add
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> View
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Delete
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="row">
                                                <div class="col-md-3">
                                                    2. Manage Level:
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Add
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> View
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Delete
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    3. Manage Designation:
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Add
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> View
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Delete
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-3">
                                                    4. Manage Employee:
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Add
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> View
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="checkbox" name=""> Delete
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                        <label for="details" class="col-md-2 control-label">Details</label>

                                        <div class="col-md-6">
                                            <textarea id="details" class="form-control input-sm" name="details" autofocus>{{ old('details') }}</textarea>

                                            @if ($errors->has('details'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('details') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10 col-md-offset-2">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="radio-custom radio-success mb5">
                                                        <input type="radio" id="active" name="status" checked="" value="1">
                                                        <label for="active">Active</label>
                                                    </div>    
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="radio-custom radio-danger mb5">
                                                        <input type="radio" id="inactive" name="status" value="0">
                                                        <label for="inactive">Inactive</label>
                                                    </div>    
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10 col-md-offset-2">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @elseif(count($info->id) > 0)
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title">Edit Level</span>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('levels/edit') }} ">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{$info->id}}">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-3 control-label">Name</label>

                                        <div class="col-md-9">
                                            <input id="name" type="text" class="form-control input-sm" name="name" value="{{ $info->level_name }}" autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                        <label for="details" class="col-md-3 control-label">Details</label>

                                        <div class="col-md-9">
                                            <textarea id="details" class="form-control input-sm" name="details" autofocus>{{ $info->description }}</textarea>

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
                    </div>
                @endif
                
            </div>
        </div>
    </section>
    <!-- End: Content -->       

@endsection