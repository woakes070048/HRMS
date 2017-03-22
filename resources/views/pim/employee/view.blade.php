@extends('layouts.hrms')
@section('content')

@section('style')
<style>
table.tc-med-2 tbody td:first-child{
  font-size:13px;
}
</style>
@endsection

<section id="content" class="animated fadeIn">

<!-- Begin .page-heading -->
<div class="page-heading">
    <div class="media clearfix">
      <div class="media-left pr30">
        <a href="#">
          @if($user->photo)
          <img class="media-object mw150" width="165px" src="{{$user->full_image}}" alt="{{$auth->fullname}}">
          @else
          <img class="media-object mw150" width="165px" src="{{asset('img/placeholder.png')}}" alt="{{$auth->fullname}}">
          @endif
        </a>
      </div>                      
      <div class="media-body va-m">
        <h2 class="media-heading">{{$user->fullname}}
          <small> - Profile (@if($user->status ==1) active @else inactive @endif account )</small>
        </h2>
        <p class="lead">{{$user->designation->designation_name}} <small>( Joining Date - {{$user->details->joining_date_format or ''}}, Profile Opening Date - {{$user->created_at}} )</small></p>
        <h4 class="media-heading">Present Address
          <small> - {{$user->address->present_postoffice or ''}}, {{$user->address->presentPoliceStation->police_station_name or ''}}, {{$user->address->presentDistrict->district_name or ''}}, {{$user->address->presentDivision->division_name or ''}}.</small>
        </h4>
        <h4 class="media-heading">Parmanent Address
          <small> - {{$user->address->permanent_postoffice or ''}}, {{$user->address->permanentPoliceStation->police_station_name or ''}}, {{$user->address->permanentDistrict->district_name or ''}}, {{$user->address->permanentDivision->division_name or ''}}.</small>
        </h4>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
    <!-- Basic info -->
      <div class="panel">
        <div class="panel-heading bg-dark">
          <span class="panel-icon">
            <i class="fa fa-star"></i>
          </span>
          <span class="panel-title">Basic Information</span>
        </div>
        <div class="panel-body pn">
          <table class="table mbn tc-icon-1 tc-med-2">
            <tbody>
              <tr>
                <td class="text-left">Employee No :</td>
                <td class="text-right">{{$user->employee_no}}</td>
              </tr>
              <tr>
                <td class="text-left">First Name :</td>
                <td class="text-right">{{$user->first_name}}</td>
              </tr>
               <tr>
                <td class="text-left">Middle Name :</td>
                <td class="text-right">{{$user->middle_name}}</td>
              </tr>
               <tr>
                <td class="text-left">Last Name :</td>
                <td class="text-right">{{$user->last_name}}</td>
              </tr>
               <tr>
                <td class="text-left">Nick Name :</td>
                <td class="text-right">{{$user->nick_name}}</td>
              </tr>
               <tr>
                <td class="text-left">Email Address :</td>
                <td class="text-right">{{$user->email}}</td>
              </tr>
               <tr>
                <td class="text-left">Mobile Number :</td>
                <td class="text-right">{{$user->mobile_number}}</td>
              </tr>
              <tr>
                <td class="text-left">Supervisor :</td>
                <td class="text-right">@if($user->supervisor){{$user->supervisor->fullname}}@endif</td>
              </tr>
              <tr>
                <td class="text-left">Designation :</td>
                <td class="text-right">{{$user->designation->designation_name}}</td>
              </tr>
              <tr>
                <td class="text-left">Department :</td>
                <td class="text-right">{{$user->designation->department->department_name}}</td>
              </tr>
              <tr>
                <td class="text-left">Level :</td>
                <td class="text-right">{{$user->designation->level->level_name}}</td>
              </tr>
              <tr>
                <td class="text-left">Unit :</td>
                <td class="text-right">{{$user->unit->unit_name}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Personal info -->
      <div class="panel">
        <div class="panel-heading bg-dark">
          <span class="panel-icon">
            <i class="fa fa-star"></i>
          </span>
          <span class="panel-title">Personal Information</span>
        </div>
        <div class="panel-body pn">
          <table class="table mbn tc-icon-1 tc-med-2">
            <tbody>
            @if($user->details)
              <tr>
                <td class="text-left">Father_name :</td>
                <td class="text-right">{{$user->details->father_name}}</td>
              </tr>
              <tr>
                <td class="text-left">Mother Name :</td>
                <td class="text-right">{{$user->details->mother_name}}</td>
              </tr>
              <tr>
                <td class="text-left">Spouse Name :</td>
                <td class="text-right">{{$user->details->spouse_name}}</td>
              </tr>
               <tr>
                <td class="text-left">Personal Email :</td>
                <td class="text-right">{{$user->details->personal_email}}</td>
              </tr>
               <tr>
                <td class="text-left">Official Email :</td>
                <td class="text-right">{{$user->details->official_email}}</td>
              </tr>
               <tr>
                <td class="text-left">Phone Number :</td>
                <td class="text-right">{{$user->details->phone_number}}</td>
              </tr>
               <tr>
                <td class="text-left">National ID :</td>
                <td class="text-right">{{$user->details->national_id}}</td>
              </tr>
               <tr>
                <td class="text-left">Passport No :</td>
                <td class="text-right">{{$user->details->passport_no}}</td>
              </tr>
              <tr>
                <td class="text-left">TIN No :</td>
                <td class="text-right">{{$user->details->tin_no}}</td>
              </tr>
              <tr>
                <td class="text-left">Birth Date :</td>
                <td class="text-right">{{$user->details->birth_date}}</td>
              </tr>
              <tr>
                <td class="text-left">Joining Date :</td>
                <td class="text-right">{{$user->details->joining_date}}</td>
              </tr>
               <tr>
                <td class="text-left">Blood Group :</td>
                <td class="text-right">{{$user->details->bloodGroup->blood_namea or ''}}</td>
              </tr>
              <tr>
                <td class="text-left">Gender :</td>
                <td class="text-right">{{$user->details->gender}}</td>
              </tr>
              <tr>
                <td class="text-left">Marital Status :</td>
                <td class="text-right">{{$user->details->marital_status}}</td>
              </tr>
              <tr>
                <td class="text-left">Religion :</td>
                <td class="text-right">{{$user->details->religion->religion_name}}</td>
              </tr>
              <tr>
                <td class="text-left">Nationality :</td>
                <td class="text-right">{{$user->details->nationality}}</td>
              </tr>
              <tr>
                <td class="text-left">Emergency Contact Person :</td>
                <td class="text-right">{{$user->details->emergency_contact_person}}</td>
              </tr>
              <tr>
                <td class="text-left">Emergency Contact Address :</td>
                <td class="text-right">{{$user->details->emergency_contact_address}}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-9">

      <div class="tab-block">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab1" data-toggle="tab">Education</a>
          </li>
          <li>
            <a href="#tab2" data-toggle="tab">Experience</a>
          </li>
          <li>
            <a href="#tab3" data-toggle="tab">Salary</a>
          </li>
          <li>
            <a href="#tab4" data-toggle="tab">Nominee</a>
          </li>
          <li>
            <a href="#tab5" data-toggle="tab">Training</a>
          </li>
          <li>
            <a href="#tab6" data-toggle="tab">Referance</a>
          </li>
          <li>
            <a href="#tab7" data-toggle="tab">Children</a>
          </li>
          <li>
            <a href="#tab8" data-toggle="tab">Language</a>
          </li>
        </ul>


        <div class="tab-content p30" style="height: 730px;">

        <!-- Education tab -->
          <div id="tab1" class="tab-pane active">
            <div class="panel">
              <div class="panel-body pb5">

                @forelse($user->educations as $education)
                <h6>
                  Education Level : {{$education->institute->educationLevel->education_level_name}} 
                  @if($education->certificate)
                  <a target="_blank" href="{{url('files/'.$education->user_id.'/'.$education->certificate)}}" class="pull-right">View Certificate</a>
                  @else
                  <span class="pull-right">No certificate file.</span>
                  @endif
                </h6>

                <h5>Board/Institute : {{$education->institute->institute_name}}</h5>

                <h4>Degree : {{$education->degree->degree_name}}</h4>
                <p class="text-muted">
                @if($education->result_type == 'cgpa') 
                  Result (cgpa) : {{$education->cgpa}}
                @else 
                  Result (division) : @if($education->division == 1) First Division @elseif($education->division == 2) Second Division @elseif($education->division == 3) Third Division @endif
                @endif
                </p>
                <p class="text-muted">Pass Year : {{$education->pass_year}}</p>
                @if(!$loop->last)
                <hr class="short br-lighter">
                @endif

              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>


          <!-- Experience tab -->
          <div id="tab2" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

              @forelse($user->experiences as $experience)
                <h6>
                  Date/Duration : {{$experience->job_start_date}} - {{$experience->job_end_date}} ( {{$experience->job_duration}} )
                </h6>

                <h5>Company : {{$experience->company_name}}</h5>

                <h4>Position : {{$experience->position_held}}</h4>
                <p class="text-muted">Location : {{$experience->job_location}}</p>
                <p class="text-muted">Responsibility : {{$experience->job_responsibility}}</p>
                @if(!$loop->last)
                <hr class="short br-lighter">
                @endif

              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>


          <!-- Salary Tab -->
          <div id="tab3" class="tab-pane">
            <div class="panel">
            <h4>Salary Information :</h4>
              <div class="panel-body pb5">
                <h5><span class="text-muted">Employee Job Type : </span> {{$user->employeeType->type_name}}</h5>
                <h4><span class="text-muted">Basic Salary Amount : </span> {{$user->basic_salary}}</h4>
                <h5><span class="text-muted">Salary Effective Date : </span>{{$user->effective_date_format}}</h5>
              </div>
            </div>

            <div class="panel">
              <h4>Allowance Information :</h4>
              <div class="panel-body pb5">
                 <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">
                        <thead>
                          <tr class="bg-dark">
                              <th>SL No:</th>
                              <th>Allowance Name</th>
                              <th>Allowance Amount</th>
                              <th>Allowance Type</th>
                              <th>Effective Date</th>
                          </tr>
                        </thead>

                        <tfoot>
                          <tr class="bg-dark">
                              <th>SL No:</th>
                              <th>Allowance Name</th>
                              <th>Allowance Amount</th>
                              <th>Allowance Type</th>
                              <th>Effective Date</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        <?php $sl=1; ?>
                        @foreach($user->salaries as $sinfo)
                            <tr>
                              <td>{{$sl}}</td>
                              <td>{{$sinfo->basicSalaryInfo->name}}</td>
                              <td>@if($sinfo->salary_amount_type == 'fixed') $ @endif {{$sinfo->salary_amount}} @if($sinfo->salary_amount_type == 'percent') % @endif</td>
                              <td>{{$sinfo->salary_amount_type}}</td>
                              <td>{{$sinfo->salary_effective_date}}</td>
                            </tr>
                            <?php $sl++; ?>
                        @endforeach
                        </tbody>
                    </table>
              </div>
            </div>
          </div>


          <!-- Nominee Tab -->
          <div id="tab4" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

              @forelse($user->nominees as $nominees)
              <div class="col-md-10">
                <h4>Nominee Name : {{$nominees->nominee_name}}</h4>
                <h5>Relation : {{$nominees->nominee_relation}}</h5>
                <h6>Birth Date : {{$nominees->nominee_birth_date}}</h6>
                <p class="text-muted">Nominee Distribution : {{$nominees->nominee_distribution}}</p>
                <p class="text-muted">Nominee Rest Distribution : {{$nominees->nominee_rest_distribution}}</p>
              </div>
              <div class="col-md-2">
                <img src="@if($nominees->nominee_photo){{url('files/'.$user->id.'/'.$nominees->nominee_photo)}}@else{{url('img/placeholder.png')}}@endif" class="img-responsive">
              </div>
              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>


          <!-- Training tab -->
          <div id="tab5" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

              @forelse($user->trainings as $training)
                <h6>
                  Start : {{$training->training_from_date}} - End : {{$training->training_to_date}} - Pass : {{$training->  training_passed_date}} - Participation : {{$training->training_participation_date}}
                </h6>
                <h5>Training Code : {{$training->training_code}}</h5>
                <h4>Title : {{$training->training_title}}</h4>
                <h6>Institute : {{$training->training_institute}}</h6>
                <p class="text-muted">Remarks : {{$training->training_remarks}}</p>
                @if(!$loop->last)
                <hr class="short br-lighter">
                @endif

              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>


          <!-- Reference tab -->
          <div id="tab6" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

              @forelse($user->references as $reference)
                <h4>Reference Name : {{$reference->reference_name}}</h4>
                <h5>Department : {{$reference->reference_department}}</h5>
                <h5>Organization : {{$reference->reference_organization}}</h5>
                <h6>Email Address: {{$reference->reference_email}}</h6>
                <h6>Phone Number: {{$reference->reference_phone}}</h6>
                <p class="text-muted">Reference Address : {{$reference->reference_address}}</p>
                @if(!$loop->last)
                <hr class="short br-lighter">
                @endif

              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>


          <!-- Children tab -->
          <div id="tab7" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

              @forelse($user->childrens as $children)
                <h4>Children Name: {{$children->children_name}}</h4>
                <h5>Education Level : {{$children->children_education_level}}</h5>
                <h6>Children Birth Date : {{$children->children_birth_date}}</h6>
                <h6>Children Gender : {{$children->children_gender}}</h6>
                <p class="text-muted">Remarks : {{$children->children_remarks}}</p>
                @if(!$loop->last)
                <hr class="short br-lighter">
                @endif

              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>


          <!-- Language tab -->
          <div id="tab8" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

              @forelse($user->languages as $language)
                <h5>Language Name : {{$language->language->language_name}}</h5>
                <h6>speaking : {{$language->speaking}}</h6>
                <h6>reading : {{$language->reading}}</h6>
                <h6>writing : {{$language->writing}}</h6>
                @if(!$loop->last)
                <hr class="short br-lighter">
                @endif

              @empty
                <h5>No Data Available</h5>  
              @endforelse

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  
</section>
<!-- End: Content -->

@endsection