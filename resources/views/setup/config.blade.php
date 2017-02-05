@extends('layouts.setup')

@section('style')
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hrms.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-tools/admin-forms/css/admin-forms.css')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

    <style>
      
      .wizard .steps .fa,
      .wizard .steps .glyphicon,
      .wizard .steps .glyphicon {
        display: none;
      }
    </style> --}}
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Config Application</div>

                <?php $msgs = ['success','danger']; foreach($msgs as $msg){ if(Session::has($msg)){?>
                <div class="alert alert-{{$msg}} alert-dismissible" role="alert" style="margin-top:10px">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{ucfirst($msg)}}!</strong> {{Session::get($msg)}}
                </div>
                <?php } }?>

                 <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/config') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('package_name') ? ' has-error' : '' }}">
                            <label for="package_name" class="col-md-4 control-label">Select Package</label>

                            <div class="col-md-6">
                                <select id="package_name" name="package_name" class="form-control">
                                    <option value="">Select Package</option>
                                    @foreach($packages as $package)
                                        <option value="{{$package->id}}" @if(old('package_name') == $package->id){{"selected"}}@endif>{{$package->package_name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('package_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('package_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Company Address</label>

                            <div class="col-md-6">
                                <textarea id="name" class="form-control" name="company_address" autofocus>{{ old('company_address') }}</textarea>

                                @if ($errors->has('company_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Setup
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    {{-- <div class="col-md-8">
        <div class="admin-form">
            <form method="post" action="/" id="form-wizard">
              <div class="wizard steps-bg clearfix steps-justified steps-show-icons">
                <!-- Wizard step 1::  steps-left-->
                <h4 class="wizard-section-title">
                  <i class="fa fa-user pr5"></i> User Details</h4>
                <section class="wizard-section">

                  <div class="section">
                    <label for="username" class="field-label">Choose your username</label>
                    <div class="smart-widget sm-right smr-120">
                      <label for="username" class="field prepend-icon">
                        <input type="text" name="username" id="username" class="gui-input" placeholder="john-doe">
                        <label for="username" class="field-icon">
                          <i class="fa fa-user"></i>
                        </label>
                      </label>
                      <label for="username" class="button">.envato.com</label>
                    </div>
                    <!-- end .smart-widget section -->
                  </div>
                  <!-- end section -->
                  <div class="section">
                    <label for="password" class="field-label">Create a password</label>
                    <label for="password" class="field prepend-icon">
                      <input type="password" name="password" id="password" class="gui-input">
                      <label for="password" class="field-icon">
                        <i class="fa fa-lock"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->
                </section>
                <!-- Wizard step 2 -->
                <h4 class="wizard-section-title">
                  <i class="fa fa-dollar pr5"></i> Payment</h4>
                <section class="wizard-section">
                  <div class="section">
                    <label for="firstname" class="field prepend-icon">
                      <input type="text" name="firstname" id="firstname" class="gui-input" placeholder="First name...">
                      <label for="firstname" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->
                  <div class="section">
                    <label for="lastname" class="field prepend-icon">
                      <input type="text" name="lastname" id="lastname" class="gui-input" placeholder="Last name...">
                      <label for="lastname" class="field-icon">
                        <i class="fa fa-user"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->
                </section>
                <!-- Wizard step 3 -->
                <h4 class="wizard-section-title">
                  <i class="fa fa-shopping-cart pr5"></i> Checkout</h4>
                <section class="wizard-section">
                  <div class="section">
                    <label for="email" class="field prepend-icon">
                      <input type="email" name="email" id="email" class="gui-input" placeholder="Email address">
                      <label for="email" class="field-icon">
                        <i class="fa fa-envelope"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->
                  <div class="section">
                    <label for="mobile" class="field prepend-icon">
                      <input type="tel" name="mobile" id="mobile" class="gui-input" placeholder="Telephone / moble number">
                      <label for="mobile" class="field-icon">
                        <i class="fa fa-phone-square"></i>
                      </label>
                    </label>
                  </div>
                  <!-- end section -->
                </section>
              </div>
              <!-- End: Wizard -->
            </form>
            <!-- End Account2 Form -->
        </div>          
    </div>   --}}
</div>

@endsection

@section('script')
    
    {{-- <script src="{{asset('vendor/jquery/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('vendor/jquery/jquery_ui/jquery-ui.min.js')}}"></script> 


    <script src="{{asset('admin-tools/admin-forms/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-tools/admin-forms/js/jquery.steps.min.js')}}"></script>

    <script src="{{asset('js/utility/utility.js')}}"></script>
    <script src="{{asset('js/demo/demo.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>


  <script type="text/javascript">
  jQuery(document).ready(function() {

    "use strict";

    // Init Theme Core    
    Core.init();

    // Init Demo JS     
    Demo.init();

    // Form Wizard 
    var form = $("#form-wizard");
    form.validate({
      errorPlacement: function errorPlacement(error, element) {
        element.before(error);
      },
      rules: {
        confirm: {
          equalTo: "#password"
        }
      }
    });
    form.children(".wizard").steps({
      headerTag: ".wizard-section-title",
      bodyTag: ".wizard-section",
      onStepChanging: function(event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
      },
      onFinishing: function(event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
      },
      onFinished: function(event, currentIndex) {
        alert("Submitted!");
      }
    });

    // Demo Wizard Functionality
    var formWizard = $('.wizard');
    var formSteps = formWizard.find('.steps');

    $('.wizard-options .holder-style').on('click', function(e) {
      e.preventDefault();

      var stepStyle = $(this).data('steps-style');

      var stepRight = $('.holder-style[data-steps-style="steps-right"');
      var stepLeft = $('.holder-style[data-steps-style="steps-left"');
      var stepJustified = $('.holder-style[data-steps-style="steps-justified"');

      if (stepStyle === "steps-left") {
        stepRight.removeClass('holder-active');
        stepJustified.removeClass('holder-active');
        formWizard.removeClass('steps-right steps-justified');
      }
      if (stepStyle === "steps-right") {
        stepLeft.removeClass('holder-active');
        stepJustified.removeClass('holder-active');
        formWizard.removeClass('steps-left steps-justified');
      }
      if (stepStyle === "steps-justified") {
        stepLeft.removeClass('holder-active');
        stepRight.removeClass('holder-active');
        formWizard.removeClass('steps-left steps-right');
      }

      // Assign new style 
      if ($(this).hasClass('holder-active')) {
        formWizard.removeClass(stepStyle);
      } else {
        formWizard.addClass(stepStyle);
      }

      // Assign new active holder
      $(this).toggleClass('holder-active');
    });

  });
  </script> --}}
@endsection