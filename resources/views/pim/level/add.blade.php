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

                                    <div class="form-group">
                                        <label for="amount" class="col-md-2 control-label">
                                        </label>
                                        <div class="col-md-9">
                                            <div class="checkbox-custom mb5">
                                                <input type="checkbox" class="chk_parent" id="checkboxDefault3" name="chk_parent" {{ ($errors->has('parent_id') || old('parent_id')) ? "checked" : '' }} value="1">
                                                <label for="checkboxDefault3"> This level have parent</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group parent-cls{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                        <label for="parent_id" class="col-md-2 control-label">Parent Name</label>
                                        <div class="col-md-6">
                                            <select class="form-control input-sm" name="parent_id">
                                                <option value="">Select Level's Parent</option>
                                                @if($parents)
                                                    @foreach($parents as $info)
                                                        <option value="{{$info->id}}" 
                                                        {{($info->id == old('parent_id'))?"selected":''}}
                                                        >{{ $info->level_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('parent_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('parent_id') }}</strong>
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
                                        <label for="name" class="col-md-2 control-label">Salary Info</label>
                                        <div class="col-md-10">

                                            @foreach($salary_info as $sInfo)
                                                <div class="col-md-4" style="margin-top: 3px;">
                                                    <div class="col-md-8">
                                                        {{ $sInfo->salary_info_name}}
                                                        <span style="color:green;font-weight: bold;">
                                                            ({{$sInfo->salary_info_amount_status==0?"%":"$"}})
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salryInfoPercent[]" value="{{$sInfo->salary_info_amount}}">
                                                        <input type="hidden" name="salryInfoId[]" value="{{$sInfo->id}}">      
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
                            <a href="{{url('levels/index')}}">
                                <button type="button" class="btn btn-xs btn-success pull-right" style="margin-top: 12px;">Back</button>
                            </a>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('levels/edit') }} ">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{$info->id}}">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-2 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control input-sm" name="name" value="{{ $info->level_name }}" autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="amount" class="col-md-2 control-label">
                                        </label>
                                        <div class="col-md-9">
                                            <div class="checkbox-custom mb5">
                                                <input type="checkbox" class="chk_parent" id="checkboxDefault3" name="chk_parent" {{ ($errors->has('parent_id') || $info->parent_id > 0) ? "checked" : '' }} value="1">
                                                <label for="checkboxDefault3"> This level have parent</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group parent-cls{{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                        <label for="parent_id" class="col-md-2 control-label">Parent Name</label>
                                        <div class="col-md-6">
                                            <select class="form-control input-sm" name="parent_id">
                                                <option value="">Select Level's Parent</option>
                                                @if($parents)
                                                    @foreach($parents as $val)
                                                        @if($val->id != $info->id)
                                                            <option value="{{$val->id}}" 
                                                            {{($val->id == $info->parent_id)?"selected":''}}
                                                            >{{ $val->level_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('parent_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('parent_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('salary_amount') ? ' has-error' : '' }}">
                                        <label for="salary_amount" class="col-md-2 control-label">Salary Amount</label>

                                        <div class="col-md-6">
                                            <input id="salary_amount" type="number" class="form-control input-sm" name="salary_amount" value="{{ $info->level_salary_amount }}" autofocus>

                                            @if ($errors->has('salary_amount'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('salary_amount') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($salary_info->count() > 0)
                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">
                                            <button type="button" class="btn btn-xs btn-success"  data-toggle="modal" data-target=".salaryInfoAdd">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                            Salary Info
                                        </label>
                                        <div class="col-md-10">
                                            <?php 
                                                $selected_info_id = [];
                                            ?>
                                            @if($info->salaryInfo->count() > 0)
                                                @foreach($info->salaryInfo as $value)
                                                <div class="col-md-4" style="margin-top: 3px;">
                                                    <div class="col-md-8">
                                                        {{ $value->basicSalaryInfo->salary_info_name }}
                                                        <span style="color:green;font-weight: bold;">
                                                            ({{$value->basicSalaryInfo->salary_info_amount_status == 0?"%":"$"}})
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salryInfoPercent[]" value="{{$value->amount}}">
                                                        <input type="hidden" name="salryInfoId[]" value="{{$value->basic_salary_info_id}}"> 
                                                        <?php 
                                                            $selected_info_id[] = $value->basic_salary_info_id;
                                                        ?>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                                This level don't have any Extra Salary Info
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                        <label for="details" class="col-md-2 control-label">Details</label>

                                        <div class="col-md-6">
                                            <textarea id="details" class="form-control input-sm" name="details" autofocus>{{ $info->description }}</textarea>

                                            @if ($errors->has('details'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('details') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-2">
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
                                        <div class="col-md-6 col-md-offset-2">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--***** add Salary Info modal start *****-->

                    <?php 
                        $db_id = [];

                        if($salary_info->count() > 0){
                            foreach($salary_info as $infoId){
                                $db_id[] = $infoId->id;
                            }
                        }

                        $info_id_diff = array_diff($db_id, $selected_info_id);
                    ?>

                    
                    <div class="modal fade bs-example-modal-lg salaryInfoAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add New Basic Salary Info</h4>
                              </div>
                              <div class="modal-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ url('levels/edit/info') }}">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{$info->id}}">

                                    @if($salary_info->count() > 0)
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            @foreach($salary_info as $value)
                                                @if(in_array($value->id , $info_id_diff, false))
                                                    <div class="col-md-6" style="margin-top: 3px;">
                                                        <div class="col-md-8">
                                                            {{ $value->salary_info_name }}
                                                            <span style="color:green;font-weight: bold;">
                                                                ({{$value->salary_info_amount_status == 0?"%":"$"}})
                                                            </span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salryInfoPercent[]" value="" placeholder="{{$value->salary_info_amount}}">
                                                            <input type="hidden" name="salryInfoId[]" value="{{$value->id}}">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Salary Info</button>
                              </div>

                              </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <!-- ******Salary Info modal end****** --> 
                @endif
                
            </div>
        </div>
    </section>
    <!-- End: Content -->   
@endsection


@section('script')
<script type="text/javascript">
    
    $(document).ready(function() {
        
        if($('input.chk_parent').is(':checked')){  
            $('.parent-cls').show();
        }
        else{
            $('.parent-cls').hide();
        }

        $('.chk_parent').click(function(event){

            if($('input.chk_parent').is(':checked')){
                
                $('.parent-cls').show();
            }
            else{
                $('.parent-cls').hide();
            }
        });
    });
</script>
@endsection