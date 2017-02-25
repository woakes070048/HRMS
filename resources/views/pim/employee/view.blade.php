@extends('layouts.hrms')
@section('content')

@section('style')
<style>
table.tc-med-2 tbody td:first-child{
  font-size:14px;
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
          <small> - Profile (@if($user->status ==1) active @else inactive @endif account)</small>
        </h2>
        <p class="lead">{{$user->designation->designation_name}} ( Joining Date - {{$user->details->joining_date or ''}}, Profile Opening Date - {{$user->created_at}})</p>
        <div class="media-links">
          <ul class="list-inline list-unstyled">
            <li>
              <a href="#" title="facebook link">
                <span class="fa fa-facebook-square fs35 text-primary"></span>
              </a>
            </li>
            <li>
              <a href="#" title="twitter link">
                <span class="fa fa-twitter-square fs35 text-info"></span>
              </a>
            </li>
            <li>
              <a href="#" title="google plus link">
                <span class="fa fa-google-plus-square fs35 text-danger"></span>
              </a>
            </li>
            <li class="hidden">
              <a href="#" title="behance link">
                <span class="fa fa-behance-square fs35 text-primary"></span>
              </a>
            </li>
            <li class="hidden">
              <a href="#" title="pinterest link">
                <span class="fa fa-pinterest-square fs35 text-danger-light"></span>
              </a>
            </li>
            <li class="hidden">
              <a href="#" title="linkedin link">
                <span class="fa fa-linkedin-square fs35 text-info"></span>
              </a>
            </li>
            <li class="hidden">
              <a href="#" title="github link">
                <span class="fa fa-github-square fs35 text-dark"></span>
              </a>
            </li>
            <li class="">
              <a href="#" title="phone link">
                <span class="fa fa-phone-square fs35 text-system"></span>
              </a>
            </li>
            <li>
              <a href="#" title="email link">
                <span class="fa fa-envelope-square fs35 text-muted"></span>
              </a>
            </li>
            <li class="hidden">
              <a href="#" title="external link">
                <span class="fa fa-external-link-square fs35 text-muted"></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
      <div class="panel">
        <div class="panel-heading bg-dark">
          <span class="panel-icon">
            <i class="fa fa-star"></i>
          </span>
          <span class="panel-title">Basic Information</span>
        </div>
        <div class="panel-body pn">
          <table class="table mbn tc-icon-1 tc-med-2 tc-bold-last">
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
            </tbody>
          </table>
        </div>
      </div>

      <div class="panel">
        <div class="panel-heading bg-dark">
          <span class="panel-icon">
            <i class="fa fa-star"></i>
          </span>
          <span class="panel-title">Personal Information</span>
        </div>
        <div class="panel-body pn">
          <table class="table mbn tc-icon-1 tc-med-2 tc-bold-last">
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
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-8">

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
        </ul>


        <div class="tab-content p30" style="height: 730px;">
          <div id="tab1" class="tab-pane active">
            <div class="panel">
              <div class="panel-body pb5">



              @forelse($user->educations as $education)
                <h6>Education Level : {{$education->institute->educationLevel->education_level_name}}</h6>

                <h5>Board/Institute : {{$education->institute->institute_name}}</h5>

                <h4>Degree : {{$education->degree->degree_name}}</h4>
                <p class="text-muted">@if($education->result_type == 'cgpa') Result (cgpa) : {{$education->cgpa}}@else Result (division) : {{$education->division}}@endif</p>
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

          <div id="tab2" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

                <h6>Experience</h6>

                <h4>Facebook Internship</h4>
                <p class="text-muted"> University of Missouri, Columbia
                  <br> Student Health Center, June 2010 - 2012
                </p>

                <hr class="short br-lighter">

              </div>
            </div>
          </div>

          <div id="tab3" class="tab-pane">
            <div class="panel">
              <div class="panel-body pb5">

                <h6>Experience</h6>

                <h4>Facebook Internship</h4>
                <p class="text-muted"> University of Missouri, Columbia
                  <br> Student Health Center, June 2010 - 2012
                </p>

                <hr class="short br-lighter">

                <h6>Education</h6>

                <h4>Bachelor of Science, PhD</h4>
                <p class="text-muted"> University of Missouri, Columbia
                  <br> Student Health Center, June 2010 through Aug 2011
                </p>

                <hr class="short br-lighter">

                <h6>Accomplishments</h6>

                <h4>Successful Business</h4>
                <p class="text-muted pb10"> University of Missouri, Columbia
                  <br> Student Health Center, June 2010 through Aug 2011
                </p>

              </div>
            </div>
          </div>

          <div id="tab4" class="tab-pane">
            
          </div>

        </div>
      </div>
    </div>
  </div>
  
</section>
<!-- End: Content -->

@endsection