@extends('layouts.hrms')

@section('content')
    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">All departments</span>

                        <button type="button" class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target=".depAdd" style="margin-top: 12px;">Add Department</button>
                    </div>
                    <div class="panel-body">
                        @if($departments->count() > 0)
                        <table class="table table-hover" id="datatable">
                        <thead>
                            <tr class="success">
                                <th>sl</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1; ?>
                            @foreach($departments as $department)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $department->department_name }}</td>
                                <td>{{$department->status==1?"Active":"Inactive"}}</td>
                                <td>
                                    <button data-id="{{$department->id}}" type="button" class="btn btn-sm btn-primary edit-btn" data-toggle="modal" data-target=".depEdit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a onclick="return confirm('Want to delete?');" href="{{url("department/delete/$department->id")}}" title="">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        @else
                            {{"No level available..."}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End: Content -->    

    <!-- depAdd modal start -->
    <div class="modal fade bs-example-modal-lg depAdd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Department</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('department/add') }} ">

                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-3 control-label">Name</label>

                        <div class="col-md-9">
                            <input id="name" type="text" class="form-control input-sm" name="name" value="{{ old('name') }}" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="radio-custom radio-success mb5">
                                        <input type="radio" id="active" name="status" checked="" value="1">
                                        <label for="active">Active</label>
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="radio-custom radio-danger mb5">
                                        <input type="radio" id="inactive" name="status" value="0">
                                        <label for="inactive">Inactive</label>
                                    </div>    
                                </div>
                            </div>     
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Department</button>
              </div>

              </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- depAdd modal end -->

    <!-- depEdit modal start -->
    <div class="modal fade bs-example-modal-lg depEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Department</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('department/edit') }} ">

                    {{ csrf_field() }}

                    <input type="hidden" class="edit-hdn-id" name="id" value="">

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-3 control-label">Name</label>

                        <div class="col-md-9">
                            <input id="name" type="text" class="form-control input-sm edit-name" name="name" value="" autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="radio-custom radio-success mb5">
                                        <input type="radio" class="edit-status" id="edit-active" name="status" value="1">
                                        <label for="edit-active">Active</label>
                                    </div>    
                                </div>
                                <div class="col-md-4">
                                    <div class="radio-custom radio-danger mb5">
                                        <input type="radio" class="edit-status" id="edit-inactive" name="status" value="0">
                                        <label for="edit-inactive">Inactive</label>
                                    </div>    
                                </div>
                            </div>     
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Department</button>
              </div>

              </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- depEdit modal end -->
   

@endsection

@section('script')
<script type="text/javascript">
    
jQuery(document).ready(function() {

    // Init DataTables
    $('#datatable').dataTable({
      "aoColumnDefs": [{
        'bSortable': false,
        'aTargets': [-1]
      }],
      "oLanguage": {
        "oPaginate": {
          "sPrevious": "",
          "sNext": ""
        }
      },
      "iDisplayLength": 25,
      "aLengthMenu": [
        [25, 50, -1],
        [25, 50, "All"]
      ],
      "sDom": '<"dt-panelmenu clearfix"lfr>t<"dt-panelfooter clearfix"ip>',
      "oTableTools": {
        "sSwfPath": "vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
      }
    });

    $(".pagination").addClass(" pull-right");

});

$('.edit-btn').click(function(event) {

    var id = $(this).attr("data-id");
    
    $.ajax({
        url: "{{url('department/edit')}}/"+id,
        type: 'GET',
    })
    .done(function(data) {
        
        $('.edit-hdn-id').val(data['id']);
        $('.edit-name').val(data['department_name']);
        $(".edit-status[value=" + data['status'] + "]").prop('checked', true);
    })
    .fail(function() {
        //console.log("error");
        alert('error');
    });
    
});




</script>
@endsection