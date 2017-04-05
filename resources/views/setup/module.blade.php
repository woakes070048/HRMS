@extends('layouts.setup')

@section('content')
<div id="mainDiv">
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Modules
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".dataAdd" style="margin-top: 12px;">Add New Module</button>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="success">
                                    <th>sl</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- dataAdd modal start -->
    <div class="modal fade bs-example-modal-lg dataAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalDataAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add New Module</h4>
                </div>
                <form class="form-horizontal" @submit.prevent="saveData('addFormData')" id="addFormData">
                    <div class="modal-body">

                        <div id="create-form-errors">
                        </div>

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="module_name" class="col-md-3 control-label">Module Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input name="module_name" class="form-control input-sm" v-model="module_name"  type="text" placeholder="Module Name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="module_details" class="col-md-3 control-label">Details</label>
                            <div class="col-md-9">
                                <textarea name="module_details" class="form-control input-sm" v-model="module_details" placeholder="Write details"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-success mb5">
                                            <input type="radio" name="module_status" id="active" v-model="module_status" value="1">
                                            <label for="active">Active</label>
                                        </div>    
                                    </div>
                                    <div class="col-md-4">
                                        <div class="radio-custom radio-danger mb5">
                                            <input type="radio" name="module_status" id="inactive" v-model="module_status" value="0">
                                            <label for="inactive">Inactive</label>
                                        </div>    
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-close-btn" id="modal-close-btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- unitAdd modal end --> 
</div>
@endsection

@section('script')
    <script src="{{asset('js/module.js')}}"></script>
@endsection