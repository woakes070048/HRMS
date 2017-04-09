@extends('layouts.setup')
@section('content')

<!-- Begin: Content -->
<div id="mainDiv">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                @if(empty($info))
                    <div class="panel" >
                        <div class="panel-heading">
                            <span class="panel-title">Add New Package</span>
                            <a href="{{url('packages/index')}}">
                                <button type="button" class="btn btn-xs btn-success pull-right" style="margin-top: 12px;">Back</button>
                            </a>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-10 col-md-offset-2">
                                <div id="create-form-errors">
                                </div>

                                <form class="form-horizontal" @submit.prevent="saveData('addFormData')" id="addFormData">

                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('package_name') ? ' has-error' : '' }}">
                                        <label for="package_name" class="col-md-2 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="package_name" type="text" class="form-control input-sm" name="package_name" value="{{ old('package_name') }}" autofocus>

                                            @if ($errors->has('package_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_price') ? ' has-error' : '' }}">
                                        <label for="package_price" class="col-md-2 control-label">Package Price</label>

                                        <div class="col-md-6">
                                            <input id="package_price" type="number" class="form-control input-sm" name="package_price" value="{{ old('package_price') }}" autofocus>

                                            @if ($errors->has('package_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_duration') ? ' has-error' : '' }}">
                                        <label for="package_duration" class="col-md-2 control-label">Duration(months)</label>

                                        <div class="col-md-6">
                                            <input id="package_duration" type="number" class="form-control input-sm" name="package_duration" value="{{ old('package_duration') }}" autofocus>

                                            @if ($errors->has('package_duration'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_duration') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_type') ? ' has-error' : '' }}">
                                        <label for="package_type" class="col-md-2 control-label">Package Type</label>

                                        <div class="col-md-6">
                                            <select name="package_type" id="package_type" class="form-control input-sm">
                                                <option>Select Type</option>
                                                <option value="1">Free</option>
                                                <option value="2">Paid</option>
                                            </select>
                                            @if ($errors->has('package_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_level_limit') ? ' has-error' : '' }}">
                                        <label for="package_level_limit" class="col-md-2 control-label">Levels Limit</label>

                                        <div class="col-md-6">
                                            <input id="package_level_limit" type="number" class="form-control input-sm" name="package_level_limit" value="{{ old('package_level_limit') }}" autofocus>

                                            @if ($errors->has('package_level_limit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_level_limit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_user_limit') ? ' has-error' : '' }}">
                                        <label for="package_user_limit" class="col-md-2 control-label">Users Limit</label>

                                        <div class="col-md-6">
                                            <input id="package_user_limit" type="number" class="form-control input-sm" name="package_user_limit" value="{{ old('package_user_limit') }}" autofocus>

                                            @if ($errors->has('package_user_limit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_user_limit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">Permissions</label>
                                        <div class="col-md-10">
                                            @if($permissions)
                                                @foreach($permissions as $info)
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <b>{{$info->menu_name}}</b>
                                                    </div>    
                                                        @if($info->child_menu)
                                                            @foreach($info->child_menu as $cMenu)
                                                                {{-- <div class="col-md-8"> --}}
                                                                    <div class="col-md-2">
                                                                        <input type="checkbox" name="" value="1">
                                                                        {{ $cMenu->menu_name }}
                                                                    </div>
                                                                {{-- </div> --}}
                                                            @endforeach
                                                        @endif
                                                        <br>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if($salary_info)
                                            <div class="col-md-10">
                                                <?php $sl=0; ?>
                                                @foreach($salary_info as $sInfo)
                                                    <div class="col-md-4" style="margin-top: 3px;">
                                                        <div class="col-md-7">
                                                            {{ $sInfo->salary_info_name}}
                                                            <span style="color:green;font-weight: bold;">
                                                                ({{$sInfo->salary_info_amount_status==0?"%":"$"}})
                                                            </span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox" name="salaryInfoChk[{{$sl}}][chk]" value="1">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salaryInfoChk[{{$sl}}][amount]" value="{{$sInfo->salary_info_amount}}">

                                                            <input type="hidden" name="salaryInfoChk[{{$sl}}][id]" value="{{$sInfo->id}}"> 
                                                            <input type="hidden" name="salaryInfoChk[{{$sl}}][name]" value="{{$sInfo->salary_info_name}}"> 
                                                        </div>
                                                    </div>

                                                    <?php $sl++; ?>
                                                @endforeach
                                            </div>
                                        @endif
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
                                <div id="edit-form-errors">
                                </div>

                                <form class="form-horizontal" @submit.prevent="updateData('updateFormData')" id="updateFormData">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{$info->id}}">

                                    <div class="form-group{{ $errors->has('package_name') ? ' has-error' : '' }}">
                                        <label for="package_name" class="col-md-2 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="package_name" type="text" class="form-control input-sm" name="package_name" value="{{ old('package_name') }}" autofocus>

                                            @if ($errors->has('package_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_price') ? ' has-error' : '' }}">
                                        <label for="package_price" class="col-md-2 control-label">Package Price</label>

                                        <div class="col-md-6">
                                            <input id="package_price" type="number" class="form-control input-sm" name="package_price" value="{{ old('package_price') }}" autofocus>

                                            @if ($errors->has('package_price'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_duration') ? ' has-error' : '' }}">
                                        <label for="package_duration" class="col-md-2 control-label">Duration(months)</label>

                                        <div class="col-md-6">
                                            <input id="package_duration" type="number" class="form-control input-sm" name="package_duration" value="{{ old('package_duration') }}" autofocus>

                                            @if ($errors->has('package_duration'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_duration') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_type') ? ' has-error' : '' }}">
                                        <label for="package_type" class="col-md-2 control-label">Package Type</label>

                                        <div class="col-md-6">
                                            <select name="package_type" id="package_type" class="form-control input-sm">
                                                <option>Select Type</option>
                                                <option value="1">Free</option>
                                                <option value="2">Paid</option>
                                            </select>
                                            @if ($errors->has('package_type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">Permissions</label>
                                        @if($salary_info)
                                            <div class="col-md-10">
                                                <?php $sl=0; ?>
                                                @foreach($salary_info as $sInfo)
                                                    <div class="col-md-4" style="margin-top: 3px;">
                                                        <div class="col-md-7">
                                                            {{ $sInfo->salary_info_name}}
                                                            <span style="color:green;font-weight: bold;">
                                                                ({{$sInfo->salary_info_amount_status==0?"%":"$"}})
                                                            </span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox" name="salaryInfoChk[{{$sl}}][chk]" value="1">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salaryInfoChk[{{$sl}}][amount]" value="{{$sInfo->salary_info_amount}}">

                                                            <input type="hidden" name="salaryInfoChk[{{$sl}}][id]" value="{{$sInfo->id}}"> 
                                                            <input type="hidden" name="salaryInfoChk[{{$sl}}][name]" value="{{$sInfo->salary_info_name}}"> 
                                                        </div>
                                                    </div>

                                                    <?php $sl++; ?>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('package_level_limit') ? ' has-error' : '' }}">
                                        <label for="package_level_limit" class="col-md-2 control-label">Levels Limit</label>

                                        <div class="col-md-6">
                                            <input id="package_level_limit" type="number" class="form-control input-sm" name="package_level_limit" value="{{ old('package_level_limit') }}" autofocus>

                                            @if ($errors->has('package_level_limit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_level_limit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('package_user_limit') ? ' has-error' : '' }}">
                                        <label for="package_user_limit" class="col-md-2 control-label">Users Limit</label>

                                        <div class="col-md-6">
                                            <input id="package_user_limit" type="number" class="form-control input-sm" name="package_user_limit" value="{{ old('package_user_limit') }}" autofocus>

                                            @if ($errors->has('package_user_limit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('package_user_limit') }}</strong>
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
                @endif
                
            </div>
        </div>
    </div>
</div>
<!-- End: Content -->   
@endsection


@section('script')
<script type="text/javascript">
    
    // new Vue({
    //     el: "#mainDiv",
    //     data:{
    //         msg: 'testinggg',
    //     },
    //     methods: {
    //         saveData: function(formId){

    //             var formData = $('#'+formId).serialize();

    //             axios.post('/levels/add', formData)
    //             .then((response) => { 

    //                 $('#create-form-errors').html('');

    //                 swal({
    //                     title: "Success",
    //                     text: "Data added successfully!",
    //                     type: "success",
    //                     showCancelButton: false,
    //                     confirmButtonColor: "#DD6B55",
    //                     confirmButtonText: "Done",
    //                     closeOnConfirm: false
    //                 },
    //                 function(){
    //                     window.location="{{url('/levels/index')}}";
    //                 });
                    
    //             })
    //             .catch( (error) => {
    //                 var errors = error.response.data;

    //                 var errorsHtml = '<div class="alert alert-danger"><ul>';
    //                 $.each( errors , function( key, value ) {
    //                     errorsHtml += '<li>' + value[0] + '</li>';
    //                 });
    //                 errorsHtml += '</ul></di>';
    //                 $( '#create-form-errors' ).html( errorsHtml );
    //             });
    //         },
    //         updateData: function(formId){

    //             var formData = $('#'+formId).serialize();

    //             axios.post('/levels/edit', formData)
    //             .then((response) => { 

    //                 $('#edit-form-errors').html('');

    //                 swal({
    //                     title: "Success",
    //                     text: "Data updated successfully!",
    //                     type: "success",
    //                     showCancelButton: false,
    //                     confirmButtonColor: "#DD6B55",
    //                     confirmButtonText: "Done",
    //                     closeOnConfirm: false
    //                 },
    //                 function(){
    //                     window.location="{{url('/levels/index')}}";
    //                 });
                    
    //             })
    //             .catch( (error) => {
    //                 var errors = error.response.data;

    //                 var errorsHtml = '<div class="alert alert-danger"><ul>';
    //                 $.each( errors , function( key, value ) {
    //                     errorsHtml += '<li>' + value[0] + '</li>';
    //                 });
    //                 errorsHtml += '</ul></di>';
    //                 $( '#edit-form-errors' ).html( errorsHtml );
    //             });
    //         }
    //     }
    // });

    // $(document).ready(function() {
        
    //     if($('input.chk_parent').is(':checked')){  
    //         $('.parent-cls').show();
    //     }
    //     else{
    //         $('.parent-cls').hide();
    //     }

    //     $('.chk_parent').click(function(event){

    //         if($('input.chk_parent').is(':checked')){
                
    //             $('.parent-cls').show();
    //         }
    //         else{
    //             $('.parent-cls').hide();
    //         }
    //     });
    // });
</script>
@endsection