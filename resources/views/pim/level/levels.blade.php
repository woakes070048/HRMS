@extends('layouts.hrms')
@section('content')
    <!-- Begin: Content -->
    <section id="content" class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title">All Levels</span>
                        <a href="{{url('levels/add')}}">
                            <button type="button" class="btn btn-xs btn-success pull-right" style="margin-top: 12px;">Add Level</button>
                        </a>
                    </div>
                    <div class="panel-body">
                        @if($levels->count() > 0)
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
                        <tbody>
                            <?php $sl=1; ?>
                            @foreach($levels as $level)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $level->level_name }}</td>
                                <td>
                                    @if($level->parent_id > 0)
                                        {{ !empty($level->parent)?$level->parent->level_name:'' }}
                                    @endif
                                </td>
                                <td>{{ $level->level_salary_amount }}</td>
                                <td>
                                    @if($level->salaryInfo->count() > 0)
                                        @foreach($level->salaryInfo as $info)
                                            @if(!empty($info->basicSalaryInfo->salary_info_name))
                                                {{ $info->basicSalaryInfo->salary_info_name }}
                                                ({{$info->basicSalaryInfo->salary_info_amount_status == 0?"%":"$"}})
                                                {{ ": ".$info->amount }}
                                                <br/>
                                            @endif
                                        @endforeach
                                    @endif    
                                </td>
                                <td>{{ $level->description }}</td>
                                <td>{{$level->status==1?"Active":"Inactive"}}</td>
                                <td>
                                    <a href="{{url("levels/edit/$level->id")}}" title="">
                                        <button type="button" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                    <button onclick="wantToDelete({{$level->id}})" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
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

@endsection

@section('script')
<script type="text/javascript">

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


</script>
@endsection
