new Vue({
	el: "#mainDiv",
	data:{
		msg: 'testing',
		weekend_status: '1',
		weekends: [],
		edit_weekends: [],
		edit_weekend_status: '',
		hdn_id: '',
	},
	mounted(){

    	axios.get('/weekend/getAllData').then(response => this.weekends = response.data);
    },
	methods:{
		saveData(formId){
    		var formData = $('#'+formId).serialize();

            axios.post('/weekend/add', formData)
            .then((response) => { 
                
                swal({
	                title: response.data.title+"!",
	                text: response.data.message,
	                type: response.data.title,
	                showCancelButton: false,
	                confirmButtonColor: "#DD6B55",
	                confirmButtonText: "Done",
	                closeOnConfirm: false
	            },
	            function(){
	                location.href=location.href;
	            });
            })
            .catch((error) => {
                
                if(error.response.status != 200){ //error 422
                
                    var errors = error.response.data;

                    var errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each( errors , function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    errorsHtml += '</ul></di>';
                    $( '#create-form-errors' ).html( errorsHtml );
                }
            });
    	},
    	editData(id, index){

    		axios.get("/weekend/edit/"+id,{
            
            })
            .then((response) => {

            	this.hdn_id =	response.data.hdn_id;
            	this.edit_weekend_status = response.data.weekend_status;
                var weekendAry = response.data.weekend_name.split(',');

                if(weekendAry.length > 0){
		            jQuery.each(weekendAry, function(index, item) {
		                $('input[value='+item+']').prop("checked", true);
		            });
		        }else{
		            $('input:checkbox').removeAttr('checked');
		        }
            })
            .catch(function (error) {
                
                swal('Error:','Edit function not working','error');
            });
        },
        updateData: function(updateFormId){
            
            var formData = $('#'+updateFormId).serialize();

            axios.post('/weekend/edit', formData)
            .then(response => { 
               
                swal({
	                title: response.data.title+"!",
	                text: response.data.message,
	                type: response.data.title,
	                showCancelButton: false,
	                confirmButtonColor: "#DD6B55",
	                confirmButtonText: "Done",
	                closeOnConfirm: false
	            },
	            function(){
	                location.href=location.href;
	            });
            })
            .catch( (error) => {
                var errors = error.response.data;

                var errorsHtml = '<div class="alert alert-danger"><ul>';
                $.each( errors , function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                errorsHtml += '</ul></di>';
                $( '#edit-form-errors' ).html( errorsHtml );
            });
        },
	}
});