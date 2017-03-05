<div id="add_new_reference_modal" style="max-width:700px" class="popup-basic mfp-with-anim mfp-hide">
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title">
                <i class="fa fa-rocket"></i>Add New Reference
            </span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="add_new_reference_form" method="post" v-on:submit.prevent="addNewReference">
                        <input type="hidden" name="user_id" v-model="user_id">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': errors.reference_name}">
                                    <label class="control-label">Reference Name : <span class="text-danger">*</span></label>
                                    <input type="text" name="reference_name" class="form-control input-sm">
                                    <span v-if="errors.reference_name" class="text-danger">@{{ errors.reference_name[0]}}</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': errors.reference_email}">
                                    <label class="control-label">Reference Email  : <span class="text-danger">*</span></label>
                                    <input type="text" name="reference_email" class="form-control input-sm">
                                    <span v-if="errors.reference_email" class="text-danger">@{{ errors.reference_email[0]}}</span>
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': errors.reference_department}">
                                    <label class="control-label">Reference Department : <span class="text-danger">*</span></label>
                                    <input type="text" name="reference_department" class="form-control input-sm">
                                    <span v-if="errors.reference_department" class="text-danger">@{{ errors.reference_department[0]}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': errors.reference_organization}">
                                    <label class="control-label">Reference Organization : <span class="text-danger">*</span></label>
                                    <input type="text" name="reference_organization" class="form-control input-sm">
                                    <span v-if="errors.reference_organization" class="text-danger">@{{ errors.reference_organization[0]}}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': errors.reference_phone}">
                                    <label class="control-label">Reference Phone : <span class="text-danger">*</span></label>
                                    <input type="text" name="reference_phone" class="form-control input-sm">
                                    <span v-if="errors.reference_phone" class="text-danger">@{{ errors.reference_phone[0]}}</span>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" :class="{'has-error': errors.reference_address}">
                                    <label class="control-label">Reference Address : <span class="text-danger">*</span></label>
                                    <textarea type="text" name="reference_address" class="form-control input-sm"></textarea>
                                    <span v-if="errors.reference_address" class="text-danger">@{{ errors.reference_address[0]}}</span>
                                </div>
                            </div>
                        </div>

                        <hr class="short alt">

                        <div class="section row mbn">
                            <div class="col-sm-4 pull-right">
                                <p class="text-left">
                                    <button type="submit" name="save_reference" class="btn btn-dark btn-gradient dark btn-block"><span class="glyphicons glyphicons-ok_2"></span> &nbsp; Add New
                                    </button>
                                </p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>