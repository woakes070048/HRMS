@extends('layouts.hrms')

@section('style')
    
@endsection

@section('content')
<div id="mainDiv">
    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">Weekends</span>
                        
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".dataAdd" style="margin-top: 12px;">Add New Weekend</button>
                   
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
                                    <tr v-for="(info,index) in weekends">
                                        <td v-text="index+1"></td>
                                        <td v-text="info.weekend"></td>
                                        <td v-text="info.status==1?'Active':'Inactive'"></td>
                                        <td v-text="info.created_at"></td>
                                        <td>
                                            <button type="button" @click="editData(info.id, index)" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target=".dataEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                    </tr>
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
    <div class="modal fade bs-example-modal-lg dataAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalDataAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Weekend</h4>
                </div>
                <form class="form-horizontal" @submit.prevent="saveData('addFormData')" id="addFormData">
                    <div class="modal-body">

                        <div id="create-form-errors">
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-3">Select Weekend</label>
                            <div class="col-md-9">
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Friday"> Friday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Saturday"> Saturday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Sunday"> Sunday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Monday"> Monday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Tuesday"> Tuesday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Wednesday"> Wednesday
                                </div>
                                <div class="col-md-3">
                                    <input type="checkbox" name="weekend_name[]" value="Thursday"> Thursday
                                </div>
                            </div>      
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-success mb5">
                                            <input type="radio" name="weekend_status" id="active" v-model="weekend_status" value="1">
                                            <label for="active">Active</label>
                                        </div>    
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-danger mb5">
                                            <input type="radio" name="weekend_status" id="inactive" v-model="weekend_status" value="0">
                                            <label for="inactive">Inactive</label>
                                        </div>    
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-close-btn" id="modal-close-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- unitAdd modal end --> 

    <!-- salary Info Edit modal start -->
    <div class="modal fade bs-example-modal-lg dataEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalDataEdit">
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
    </div>
    <!-- salary Info Edit modal end --> 
</div>
@endsection

@section('script')

<script src="{{asset('/js/weekend.js')}}"></script>

@endsection
