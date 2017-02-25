@extends('layouts.hrms')

@section('style')
    
@endsection

@section('content')
    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">All Salary Info</span>
                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".salaryInfoAdd" style="margin-top: 12px;">Add New Info</button>
                    </div>
                    <div class="panel-body">
                        <div id="showData">
                            <table class="table table-hover" id="datatable">
                                <thead>
                                    <tr class="success">
                                        <th>sl</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sl = 1;
                                    ?>
                                    <tr v-for="(info,index) in salaryInfo">
                                        <td>@{{ index+1 }}</td>
                                        <td>@{{info.name}}</td>
                                        <td>
                                            @{{info.amount}}
                                            @{{ info.amount_status==1?" (BDT)":" (%)" }}
                                        </td>
                                        <td>
                                            <button data-id="" type="button" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target=".salaryInfoEdit">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <a onclick="return confirm('Want to delete?');" href="{{url("department/delete/")}}" title="">
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
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

    <!-- salaryInfoAdd modal start -->
    <div class="modal fade bs-example-modal-lg salaryInfoAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalSalaryInfoAdd">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Salary Info</h4>
              </div>
              <form class="form-horizontal department-create" id="department-create">
              <div class="modal-body">

                    <div id="create-form-errors">
                    </div>

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input name="info_name" class="form-control input-sm" v-model="info_name" v-validate:info_name.initial="'required'" :class="{'input': true, 'is-danger': errors.has('info_name') }" type="text" data-vv-as="name" placeholder="Salary info name">
                            <div v-show="errors.has('info_name')" class="help text-danger">
                                <i v-show="errors.has('info_name')" class="fa fa-warning"></i> 
                                @{{ errors.first('info_name') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="amount" class="col-md-3 control-label">Amount</label>
                        <div class="col-md-9">
                            <input name="info_amount" type="number" class="form-control input-sm" v-model="info_amount" v-validate:info_amount.initial="'required'" :class="{'input': true, 'is-danger': errors.has('info_amount') }" type="text" data-vv-as="amount" placeholder="00.00">
                            <div v-show="errors.has('info_amount')" class="help text-danger">
                                <i v-show="errors.has('info_amount')" class="fa fa-warning"></i> 
                                @{{ errors.first('info_amount') }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="radio-custom radio-success mb5">
                                        <input type="radio" id="inactive" v-model="info_status" value="0">
                                        <label for="inactive">Percent</label>
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="radio-custom radio-success mb5">
                                        <input type="radio" id="active" v-model="info_status" value="1">
                                        <label for="active">Amount(BDT)</label>
                                    </div>    
                                </div>
                            </div>     
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default modal-close-btn" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" @click.prevent="saveSalaryInfo">Save Salary Info</button>
              </div>

              </form>
            </div>
        </div>
    </div>
    <!-- salaryInfoAdd modal end --> 

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/vue.resource/1.0.3/vue-resource.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/vue.table/1.5.3/vue-table.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/2.2.1/vue-router.js"></script>

<script type="text/javascript">

//var router = new VueRouter();
        // router.go({
        //     path: '/salaryInfo/index',
        //     force: true
        // })

</script>

<script src="{{asset('js/salaryInfo.js')}}"></script>

@endsection