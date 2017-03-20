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
                        <span class="panel-title">Promotion/Transfer</span>
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".unitAdd" style="margin-top: 12px;">Add New Data</button>
                    </div>
                    <div class="panel-body">
                        <div id="showData">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr class="success">
                                        <th>sl</th>
                                        <th>Type</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th>prev. Desig.</th>
                                        <th>Branch</th>
                                        <th>Prev. Branch</th>
                                        <th>Unit</th>
                                        <th>Prev. Unit</th>
                                        <th>Supervisor</th>
                                        <th>Prev. Supvi.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(info,index) in allData">
                                        <td v-text="index+1"></td>
                                        <td v-text="info.promotion_type"></td>
                                        <td v-text="info.user.first_name +' '+ info.user.last_name"></td>
                                        <td v-text="info.current_designation.designation_name"></td>
                                        <td v-text="info.prev_designation.designation_name"></td>
                                        <td v-text="info.current_branch.branch_name"></td>
                                        <td v-text="info.prev_branch.branch_name"></td>
                                        <td v-text="info.current_unit.unit_name +' - '+info.current_unit.promotion_department.department_name"></td>
                                        <td v-text="
                                        info.prev_unit.unit_name+'-'+info.prev_unit.promotion_department.department_name"
                                        ></td>
                                        <td v-text="info.current_supervisor.first_name"></td>
                                        <td v-text="info.prev_supervisor.first_name"></td>
                                        <td>
                                            <button type="button" @click="editUnit(info.id, index)" class="btn btn-xs btn-primary edit-btn" data-toggle="modal" data-target=".unitEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" @click="deleteUnit(info.id, index)" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash-o"></i>
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

    <!-- unitAdd modal start -->
    {{-- <div class="modal fade bs-example-modal-lg unitAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalUnitAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Unit</h4>
              </div>
              <form class="form-horizontal" @submit.prevent="saveUnit('addUnitFormData')" id="addUnitFormData">
                <div class="modal-body">

                    <div id="create-form-errors">
                    </div>

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Unit Name</label>
                        <div class="col-md-9">
                            <input name="unit_name" class="form-control input-sm" v-model="unit_name" v-validate:unit_name.initial="'required'" :class="{'input': true, 'is-danger': errors.has('unit_name') }" data-vv-as="unit name" type="text" placeholder="Unit name">
                            <div v-show="errors.has('unit_name')" class="help text-danger">
                                <i v-show="errors.has('unit_name')" class="fa fa-warning"></i> 
                                @{{ errors.first('unit_name') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="unit_department_id" class="col-md-3 control-label">Department Name</label>
                        <div class="col-md-9">
                            <select class="form-control input-sm" name="unit_department_id" v-model="unit_department_id" v-validate:unit_department_id.initial="'required'" :class="{'input': true, 'is-danger': errors.has('unit_department_id') }" data-vv-as="unit department">
                                <option value="">Select Department</option>
                                <option v-for="department in departments" v-bind:value="department.id"> 
                                    @{{ department.department_name }} 
                                </option>
                            </select>
                            <div v-show="errors.has('unit_department_id')" class="help text-danger">
                                <i v-show="errors.has('unit_department_id')" class="fa fa-warning"></i> 
                                @{{ errors.first('unit_department_id') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-md-3 control-label">
                        </label>
                        <div class="col-md-9">
                            <div class="checkbox-custom mb5">
                                <input type="checkbox" @click="chk_parent==1?chk_parent=0:chk_parent=1" id="checkboxDefault3" name="chk_parent" value="1">
                                <label for="checkboxDefault3"> If this unit have parent</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" v-show="chk_parent == 1">
                        <label for="amount" class="col-md-3 control-label">Parent Name</label>
                        <div class="col-md-9">
                            <select class="form-control input-sm" name="unit_parent_id" v-model="unit_parent_id" v-validate:unit_parent_id.initial="'required'" :class="{'input': true, 'is-danger': errors.has('unit_parent_id') }" data-vv-as="unit parent">
                                <option value="">Select Unit's Parent</option>
                                <option v-for="unit in activeUnits" v-bind:value="unit.id"> @{{unit.unit_name}} </option>
                            </select>
                            <div v-show="errors.has('unit_parent_id')" class="help text-danger">
                                <i v-show="errors.has('unit_parent_id')" class="fa fa-warning"></i> 
                                @{{ errors.first('unit_parent_id') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="unit_details" class="col-md-3 control-label">Unit Details</label>
                        <div class="col-md-9">
                            <textarea name="unit_details" class="form-control input-sm" v-model="unit_details" data-vv-as="details" placeholder="Unit details"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-md-3 control-label"></label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="radio-custom radio-success mb5">
                                        <input type="radio" name="unit_status" id="active" v-model="unit_status" value="1">
                                        <label for="active">Active</label>
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="radio-custom radio-danger mb5">
                                        <input type="radio" name="unit_status" id="inactive" v-model="unit_status" value="0">
                                        <label for="inactive">Inactive</label>
                                    </div>    
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close-btn" id="modal-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Unit</button>
              </div>

              </form>
            </div>
        </div>
    </div> --}}
    <!-- unitAdd modal end --> 

    <!-- salary Info Edit modal start -->
    {{-- <div class="modal fade bs-example-modal-lg unitEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalUnitEdit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Unit</h4>
              </div>
              <form class="form-horizontal department-create" @submit.prevent="updateUnit('updateUnitFormData')" id="updateUnitFormData">
                
                <div class="modal-body">

                    <div id="edit-form-errors">
                    </div>

                    {{ csrf_field() }}

                    <input type="hidden" name="hdn_id" data-vv-as="id" v-model="hdn_id">

                    <div class="form-group">
                        <label for="edit_unit_name" class="col-md-3 control-label">Unit Name</label>
                        <div class="col-md-9">
                            <input name="edit_unit_name" class="form-control input-sm" v-model="edit_unit_name" v-validate:edit_unit_name.initial="'required'" :class="{'input': true, 'is-danger': errors.has('edit_unit_name') }" data-vv-as="unit name" type="text" placeholder="Unit name">
                            <div v-show="errors.has('edit_unit_name')" class="help text-danger">
                                <i v-show="errors.has('edit_unit_name')" class="fa fa-warning"></i> 
                                @{{ errors.first('edit_unit_name') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_unit_department_id" class="col-md-3 control-label">Department Name</label>
                        <div class="col-md-9">
                            <select class="form-control input-sm" name="edit_unit_department_id" v-model="edit_unit_department_id" v-validate:edit_unit_department_id.initial="'required'" :class="{'input': true, 'is-danger': errors.has('edit_unit_department_id') }" data-vv-as="unit department">
                                <option value="">Select Department</option>
                                <option v-for="department in departments" v-bind:value="department.id"> 
                                    @{{ department.department_name }} 
                                </option>
                            </select>
                            <div v-show="errors.has('edit_unit_department_id')" class="help text-danger">
                                <i v-show="errors.has('edit_unit_department_id')" class="fa fa-warning"></i> 
                                @{{ errors.first('edit_unit_department_id') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-md-3 control-label">
                        </label>
                        <div class="col-md-9">
                            <div class="checkbox-custom mb5">
                                <input type="checkbox" @click="chk_parent==1?chk_parent=0:chk_parent=1" id="checkboxDefault3" :checked="0" name="chk_parent" v-model="chk_parent" value="1">
                                <label for="checkboxDefault3"> If this unit have parent</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" v-show="chk_parent == 1">
                        <label for="edit_unit_parent_id" class="col-md-3 control-label">Parent Name</label>
                        <div class="col-md-9">
                            <select class="form-control input-sm" name="edit_unit_parent_id" v-model="edit_unit_parent_id" v-validate:edit_unit_parent_id.initial="'required'" :class="{'input': true, 'is-danger': errors.has('edit_unit_parent_id') }" data-vv-as="unit parent">
                                <option value="">Select Unit's Parent</option>
                                <option v-for="unit in activeUnits" v-bind:value="unit.id"> @{{unit.unit_name}} </option>
                            </select>
                            <div v-show="errors.has('edit_unit_parent_id')" class="help text-danger">
                                <i v-show="errors.has('edit_unit_parent_id')" class="fa fa-warning"></i> 
                                @{{ errors.first('edit_unit_parent_id') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_unit_details" class="col-md-3 control-label">Unit Details</label>
                        <div class="col-md-9">
                            <textarea name="edit_unit_details" class="form-control input-sm" v-model="edit_unit_details" data-vv-as="details" placeholder="Unit details"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-md-3 control-label"></label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="radio-custom radio-success mb5">
                                        <input type="radio" name="edit_unit_status" id="edit_active" v-model="edit_unit_status" value="1">
                                        <label for="edit_active">Active</label>
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="radio-custom radio-danger mb5">
                                        <input type="radio" name="edit_unit_status" id="edit_inactive" v-model="edit_unit_status" value="0">
                                        <label for="edit_inactive">Inactive</label>
                                    </div>    
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default modal-edit-close-btn" id="modal-edit-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    Update Unit
                </button>
              </div>

              </form>
            </div>
        </div>
    </div> --}}
    <!-- salary Info Edit modal end --> 
</div>
@endsection

@section('script')

<script src="{{asset('js/promotion.js')}}"></script>

@endsection