@extends('layouts.setup')

@section('style')
<style type="text/css" media="screen">
    a{
      color: #fff;
    }

</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Payment Details</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>sl</th>
                                <th>Package Name</th>
                                <th>Levels</th>
                                <th>Users</th>
                                <th>Sister Concern</th>
                                <th>Payment Amount</th>
                                <th>Pay. Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <?php 
                            $sl=1; 
                            $chk_sis_con = 0;
                        ?>
                        <tbody>
                        @foreach($payment_info as $payment)
                            <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $payment->package->package_name }}</td>
                                <td>{{ $payment->package->package_level_limit }}</td>
                                <td>{{ $payment->package->package_user_limit }}</td>
                                <?php 
                                    $chk_sis_con =  $payment->package->package_sister_concern_limit; 
                                ?>
                                <td>{{ $payment->package->package_sister_concern_limit }}</td>
                                <td>{{ $payment->payment_amount }} (BDT)</td>
                                <?php $paymentDate = date("Y-m-d", strtotime($payment->created_at)); ?>
                                <td>{{ $paymentDate }}</td>
                                <?php 
                                    $package_duration = $payment->package->package_duration;
                                    $formet = "+$package_duration month";
                                ?>
                                <td>
                                    {{ date('Y-m-d', strtotime($formet, strtotime($paymentDate))) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Company Info</div>
                <div class="panel-body">
                   <table class="table">
                       <tr>
                           <td><b>Company Name: </b></td>
                           <td>{{$config_info->company_name}}</td>
                       </tr>
                       <?php 
                          session(['user_id' => $user_info->id]);
                          session(['parent_id' => $config_info->id]);
                          session(['end_date' => $config_info->package_end_date]);
                          session(['sister_concern' => $chk_sis_con]);
                       ?>
                       <tr>
                           <td><b>Contact Person: </b></td>
                           <td>{{$user_info->full_name}}</td>
                       </tr>
                       <tr>
                           <td><b>Email: </b></td>
                           <td>{{$user_info->email}}</td>
                       </tr>
                       <tr>
                           <td><b>Mobile: </b></td>
                           <td>{{$user_info->mobile_number}}</td>
                       </tr>
                       <tr>
                           <td><b>Address: </b></td>
                           <td>{{$config_info->company_address}}</td>
                       </tr>
                   </table>
                </div>
            </div>
        </div>
        @if($chk_sis_con > 0)
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sister Concern(Current Package)

                    <div type="button" class="btn btn-xs btn-success pull-right" style="margin-top: 12px;">
                      @if(Auth::user()->user_type == 1)
                        <a href="{{url('setup/admin/concern/add')}}" title="">
                          <span class="glyphicon glyphicon-user mr5"></span>Add
                        </a>
                      @else
                        <a href="{{url('setup/user/concern/add')}}" title="">
                          <span class="glyphicon glyphicon-user mr5"></span>Add
                        </a>
                      @endif
                    </div>


                </div>
                <div class="panel-body">
                    @if(count($sister_concern) > 0)
                        <table class="table">
                          <thead>
                            <tr>
                              <th>sl</th>
                              <th>Name</th>
                              <th>Address</th>
                            </tr>
                          </thead>
                          <?php $sl=1; ?>
                          <tbody>
                            @foreach($sister_concern as $concern)
                              <tr>
                                <td>{{ $sl++ }}</td>
                                <td>{{ $concern->company_name }}</td>
                                <td>{{ $concern->company_address }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                    @else 
                        {{ "No sister concern added yet !!!" }}
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection