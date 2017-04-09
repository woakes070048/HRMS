@extends('layouts.setup')
@section('content')
    <!-- Begin: Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">All Packages</span>
                        <a href="{{url('packages/add')}}">
                            <button type="button" class="btn btn-xs btn-success pull-right" style="margin-top: 12px;">Add New Package</button>
                        </a>
                    </div>
                    <div class="panel-body">
                        {{-- @if($levels->count() > 0) --}}
                        <table class="table table-hover" id="datatable">
                        <thead>
                            <tr class="success">
                                <th>sl</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Salary</th>
                                <th>Salary Info</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        </table>
                        {{-- @else
                            {{"No level available..."}}
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Content -->       

@endsection

@section('script')
{{-- <script type="text/javascript">

function wantToDelete(id){

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this data !",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    },
    function(){
        $.ajax({
            url: "{{url('/levels/delete')}}/"+id,
            type: 'GET',
        })
        .done(function() {
            swal({
                title: "Deleted!",
                text: "Your data has been deleted.",
                type: "success",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Done",
                closeOnConfirm: false
            },
            function(){
                location.href=location.href;
            });
        })
        .fail(function(){
            swal("Error", "Data not removed.", "error");
        });
    });
}

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


</script> --}}
@endsection
