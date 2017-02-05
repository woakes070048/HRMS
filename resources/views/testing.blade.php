<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/hrms.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('admin-tools/admin-forms/css/admin-forms.css')}}">
	<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
</head>

<body class="">
	       
	<div class="col-md-8">
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
	</div>			
		
			
  <!-- End: Main -->

  <style>
  /*page demo styles*/
  .wizard .steps .fa,
  .wizard .steps .glyphicon,
  .wizard .steps .glyphicon {
    display: none;
  }
  </style>

  <!-- BEGIN: PAGE SCRIPTS -->
  <!-- jQuery -->

  	<script src="{{asset('vendor/jquery/jquery-1.11.1.min.js')}}"></script>
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
  </script>
  <!-- END: PAGE SCRIPTS -->

</body>

</html>
