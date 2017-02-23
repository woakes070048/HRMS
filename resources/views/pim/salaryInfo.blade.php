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

{{-- <div id="app">
    <form  @submit.prevent="validateBeforeSubmit">
        <div class="column is-12">
            <label class="label">Email</label>
            <p class="control has-icon has-icon-right">
                <input name="email" v-model="email" v-validate:email.initial="'required|email'" :class="{'input': true, 'is-danger': errors.has('email') }" type="text" placeholder="Email">
                <i v-show="errors.has('email')" class="fa fa-warning"></i>
                <span v-show="errors.has('email')" class="help is-danger">@{{ errors.first('email') }}</span>
            </p>
        </div>
        <div class="column is-12">
            <label class="label">Name</label>
            <p class="control has-icon has-icon-right">
                <input name="name" v-model="name" v-validate:name.initial="'required|alpha'" :class="{'input': true, 'is-danger': errors.has('name') }" type="text" placeholder="Name">
                <i v-show="errors.has('name')" class="fa fa-warning"></i>
                <span v-show="errors.has('name')" class="help is-danger">@{{ errors.first('name') }}</span>
            </p>
        </div>
        <div class="column is-12">
            <label class="label">Phone</label>
            <p class="control has-icon has-icon-right">
                <input name="phone" v-model="phone" v-validate:phone.initial="'required|numeric'" :class="{'input': true, 'is-danger': errors.has('phone') }" type="text" placeholder="Phone">
                <i v-show="errors.has('phone')" class="fa fa-warning"></i>
                <span v-show="errors.has('phone')" class="help is-danger">@{{ errors.first('phone') }}</span>
            </p>
        </div>
        <div class="column is-12">
            <label class="label">Website</label>
            <p class="control has-icon has-icon-right">
                <input name="url" v-model="url" v-validate:url.initial="'required|url'" :class="{'input': true, 'is-danger': errors.has('url') }" type="text" placeholder="Website">
                <i v-show="errors.has('url')" class="fa fa-warning"></i>
                <span v-show="errors.has('url')" class="help is-danger">@{{ errors.first('url') }}</span>
            </p>
        </div>

        <p class="control">
            <button class="button is-primary" type="submit">Submit</button>
        </p>
    </form>
</div> --}}

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
                            <input type="number"  class="form-control input-sm" v-model="info_amount">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

<script type="text/javascript">
    
jQuery(document).ready(function() {

    new Vue({
        el: '#showData',
        data: {
            message: 'Hello Vue!',
            salaryInfo:[]
        },
        // mounted: function() {

        //     this.$http({url: '/salaryInfo/getAllInfo', method: 'GET'})
        //     .then(function (response){

        //         this.salaryInfo = response.data
        //     }.bind(this))
        // },
        mounted(){
            axios.get('/salaryInfo/getAllInfo').then(response => this.salaryInfo = response.data);
        }
    });
});
</script>

<script src="{{asset('js/salaryInfo.js')}}"></script>

@endsection