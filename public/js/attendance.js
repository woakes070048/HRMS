$(document).on('ready',function(){ 
	$('#formDate').datetimepicker({
      	format: 'YYYY-MM-DD',
      	maxDate:new Date(),
        pickTime: false
  	});
});


new Vue({
	el: '#attendanceID',

	data:{
		uIndex:null,
		aIndex:null,
		hideShowId: '#showAttendance',
		departments:[],
		showAttendance:false,
		attendances:[],
		days:[],
		dayList:[],
		attend:[],
		check:1,
		errors:[]
	},


	mounted(){

		this.getDepartments();
	},


	methods:{

		loadTooltip(name,id){
		  $('[data-toggle="tooltip"]').attr('title', name)
		  .tooltip('fixTitle')
		  .tooltip();
		},

      showMessage(data){
        new PNotify({
            title: data.title,
            text: data.message,
            shadow: true,
            addclass: 'stack_top_right',
            type: data.status,
            width: '290px',
            delay: 2000,
            icon: false,
        });
      },


      loadinShow(id){
        $(id).LoadingOverlay("show",{color:"rgba(0, 0, 0, 0)"});
      },


      loadinHide(id){
        $(id).LoadingOverlay("hide",{color:"rgba(0, 0, 0, 0)"});
      },


      	myTimePicker(){
          $('.myTimePicker').datetimepicker({
          		autoclose:true,
              	pickDate: false,
          });
  		},


      myDatePicker(idClass){
	      $(idClass).datetimepicker({
	          	format: 'YYYY-MM-DD',
	          	maxDate:new Date(),
	            pickTime: false
	      });
      },


      toDate(){
      	var date = $('#formDate').val();
      	$('#toDate').datetimepicker({
	      	format: 'YYYY-MM-DD',
	      	maxDate: new Date(),
	      	minDate: date,
	        pickTime: false
	  	});
      },


      modal_open(form_id) {
        this.errors = [];

        $.magnificPopup.open({
            removalDelay: 300,
            items: {
                src: form_id
            },
            callbacks: {
                beforeOpen: function (e) {
                    var Animation = "mfp-zoomIn";
                    this.st.mainClass = Animation;
                }
            },
            midClick: true
        });
      },


      	getDepartments(){
            axios.get('/get-departments').then(response => {
                this.departments = response.data;
        	});
    	},


      getAttendance(e){
      	this.showAttendance = true;
      	var formData = new FormData(e.target);
      	this.errors = [];
      	
      	this.loadinShow(this.hideShowId);

      	axios.post('/attendance/index',formData).then((response) => {
      		this.errors = [];
          	this.attendances = response.data.attendance;
          	this.days = response.data.days;
          	this.dayList = response.data.dayList;
          	this.loadinHide(this.hideShowId);

        }).catch((error)=>{
        	this.showAttendance = false;
          	this.loadinHide(this.hideShowId);
          	this.errors = [];

          	if(error.response.status == 500 || error.response.data.status == 'danger'){
              	var error = error.response.data;
              	this.showMessage(error);
          	}else if(error.response.status == 422){
              	this.errors = error.response.data;
          	}
        });

      },


      addAttendance(uIndex,aIndex,user_id,timeSheetId,date,fullname,modal_id){
      	this.uIndex = uIndex;
      	this.aIndex = aIndex;
      	this.attend = [];

      	this.loadinShow(modal_id);

      	this.attend = {
      		'user_fullname':fullname,
      		'user_id': user_id,
      		'time_sheet_id': timeSheetId,
      		'date':date,
      		'in_time':null,
      		'out_time': null,
      	};

      	this.modal_open(modal_id);
      	this.loadinHide(modal_id);
      },


      saveAttendance(e){

      	var formData = new FormData(e.target);
      	this.errors = [];
      	
      	this.loadinShow(this.hideShowId);

      	axios.post('/attendance/add',formData).then((response) => {
      		this.errors = [];
      		// console.log(response.data.data);
          	this.attendances[this.uIndex].attendanceTimesheets[this.aIndex] = response.data.data;
          	this.loadinHide(this.hideShowId);
          	jQuery(".mfp-close").trigger("click");
      		this.showMessage(response.data);

        }).catch((error)=>{
          	this.loadinHide(this.hideShowId);
          	this.errors = [];

          	if(error.response.status == 500 || error.response.data.status == 'danger'){
              	var error = error.response.data;
              	this.showMessage(error);
          	}else if(error.response.status == 422){
              	this.errors = error.response.data;
          	}
        });
      }


  	}



});

