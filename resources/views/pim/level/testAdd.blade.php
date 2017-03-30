@extends('layouts.hrms')
@section('content')

<div id="mainDiv">

    @{{msg}}sdfs
    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel" >
                    <div class="panel-heading">
                        <span class="panel-title">Add Level TESTING</span>
                        
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">


                            <div id="create-form-errors">
                            </div>

                            <form class="form-horizontal" @submit.prevent="saveData('addFormData')" id="addFormData">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">Salary Info</label>
                                    <div class="col-md-10">

                                        <?php $sl=0; ?>
                                        @foreach($salary_info as $sInfo)
                                            <div class="col-md-4" style="margin-top: 3px;">
                                                <div class="col-md-8">
                                                    {{ $sInfo->salary_info_name}}
                                                    <span style="color:green;font-weight: bold;">
                                                        ({{$sInfo->salary_info_amount_status==0?"%":"$"}})
                                                    </span>
                                                </div>
                                                <div class="col-md-4">
                                                    {{-- salaryInfoChk --}}
                                                    {{-- salryInfoPercent[{{$sInfo->id}}] --}}
                                                    <input type="checkbox" name="salaryInfoChk[{{$sl}}][chk]" value="1">

                                                    <input id="salryInfoPercent" type="text" class="form-control input-sm" name="salaryInfoChk[{{$sl}}][amount]" value="{{$sInfo->salary_info_amount}}">

                                                    <input type="hidden" name="salaryInfoChk[{{$sl}}][id]" value="{{$sInfo->id}}"> 
                                                    <input type="hidden" name="salaryInfoChk[{{$sl}}][name]" value="{{$sInfo->salary_info_name}}"> 
                                                </div>
                                            </div>

                                            <?php $sl++; ?>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-10 col-md-offset-2">
                                        <button type="submit" class="btn btn-sm btn-success btn-save">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Content -->  
    
</div> 
@endsection


@section('script')
<script type="text/javascript">
    
    new Vue({
        el: "#mainDiv",
        data: {
            msg: 'testing--',
            salaryInfoChk: [],
            salryInfoPercent: [],
        },
        mounted(){
            // alert('sdfsrrr');
        },
        methods: {
            saveData: function(formId){

                var formData = $('#'+formId).serialize();

                axios.post('/levels/test', formData)
                .then((response) => { 

                    $('#create-form-errors').html('');
                    // document.getElementById("modal-close-btn").click();

                    //console.log(response.data[0].id);

                    new PNotify({
                        title: response.data.title+' Message',
                        text: response.data.message,
                        shadow: true,
                        addclass: 'stack_top_right',
                        type: response.data.title,
                        width: '290px',
                        delay: 1500
                    });
                })
                .catch( (error) => {
                var errors = error.response.data;

                console.log('------->>>'+errors);

                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each( errors , function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                errorsHtml += '</ul></di>';
                $( '#create-form-errors' ).html( errorsHtml );
                });
            }
        }
    });
    // $(document).ready(function() {
        
        // action="levels/test"

    //     $('.btn-save').click(function(event) {
            
    //         $.ajax({
    //             url: '/path/to/file',
    //             type: 'default GET (Other values: POST)',
    //             dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
    //             data: {param1: 'value1'},
    //         })
    //         .done(function() {
    //             console.log("success");
    //         })
    //         .fail(function() {
    //             console.log("error");
    //         })
    //         .always(function() {
    //             console.log("complete");
    //         });
            
    //     });
    // });
</script>
@endsection