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
                        <span class="panel-title">Settings</span>
                        {{-- 
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".modalAdd" style="margin-top: 12px;">Add New Settings</button> 
                        --}}
                    </div>
                    <div class="panel-body">
                        <div id="showData">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr class="success">
                                        <th>sl</th>
                                        <th>Name</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(info,index) in allValues">
                                        <td >@{{ index+1 }}</td>
                                        <td>@{{ info.field_name }}</td>
                                        <td>@{{ info.field_value }}</td>
                                        <td>
                                            <button type="button" @click="editSettings(info.id, index)" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target=".modalEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            {{-- <button type="button" @click="deleteUnit(info.id, index)" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash-o"></i>
                                            </button> --}}
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

    <!-- modalAdd modal start -->
    <div class="modal fade bs-example-modal-lg modalAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Settings Info</h4>
              </div>
              <form class="form-horizontal" @submit.prevent="saveSettings('addSettingsFormData')" id="addSettingsFormData">
                <div class="modal-body">

                    <div id="create-form-errors">
                    </div>

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="field_name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input name="field_name" class="form-control input-sm" v-model="field_name" v-validate:field_name.initial="'required'" :class="{'input': true, 'is-danger': errors.has('field_name') }" data-vv-as="name" type="text" placeholder="Name">
                            <div v-show="errors.has('field_name')" class="help text-danger">
                                <i v-show="errors.has('field_name')" class="fa fa-warning"></i> 
                                @{{ errors.first('field_name') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field_value" class="col-md-3 control-label">Value</label>
                        <div class="col-md-9">
                            <input name="field_value" class="form-control input-sm" v-model="field_value" v-validate:field_value.initial="'required'" :class="{'input': true, 'is-danger': errors.has('field_value') }" data-vv-as="value" type="text" placeholder="Value">
                            <div v-show="errors.has('field_value')" class="help text-danger">
                                <i v-show="errors.has('field_value')" class="fa fa-warning"></i> 
                                @{{ errors.first('field_value') }}
                            </div>
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close-btn" id="modal-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Settings</button>
              </div>

              </form>
            </div>
        </div>
    </div>
    <!-- modalAdd modal end --> 

    <!-- salary Info Edit modal start -->
    <div class="modal fade bs-example-modal-lg modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Settings</h4>
              </div>
              <form class="form-horizontal department-create" @submit.prevent="updateSettings('updateSettingsFormData')" id="updateSettingsFormData">
                
                <div class="modal-body">

                    <div id="edit-form-errors">
                    </div>

                    {{ csrf_field() }}

                    <input type="hidden" name="hdn_id" data-vv-as="id" v-model="hdn_id">

                    <div class="form-group">
                        <label for="edit_field_name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input name="edit_field_name" class="form-control input-sm" v-model="edit_field_name" disabled="">
                            <div v-show="errors.has('edit_field_name')" class="help text-danger">
                                <i v-show="errors.has('edit_field_name')" class="fa fa-warning"></i> 
                                @{{ errors.first('edit_field_name') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_field_value" class="col-md-3 control-label">Value</label>
                        <div class="col-md-9">
                            <input name="edit_field_value" class="form-control input-sm" v-model="edit_field_value" v-validate:edit_field_value.initial="'required'" :class="{'input': true, 'is-danger': errors.has('edit_field_value') }" data-vv-as="value" type="text" placeholder="Value">
                            <div v-show="errors.has('edit_field_value')" class="help text-danger">
                                <i v-show="errors.has('edit_field_value')" class="fa fa-warning"></i> 
                                @{{ errors.first('edit_field_value') }}
                            </div>
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default modal-edit-close-btn" id="modal-edit-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    Update Settings
                </button>
              </div>

              </form>
            </div>
        </div>
    </div>
    <!-- salary Info Edit modal end --> 
</div>
@endsection

@section('script')

<script src="{{asset('js/settings.js')}}"></script>

@endsection