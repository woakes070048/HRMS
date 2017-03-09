import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

new Vue({
	el: "#mainDiv",
	data:{
		branches: [],
		branch_name: '',
		branch_email: '',
		branch_mobile: '',
		branch_phone: '',
		branch_location: '',
		branch_status: '1',
	},
	mounted(){
    	
    	axios.get('/branch/getBranch').then(response => this.branches = response.data);
    },
    methods:{
    	saveBranch(formId){
    		var formData = $('#'+formId).serialize();

            axios.post('/branch/add', formData)
            .then((response) => { 

                // axios.get('/unit/getUnits').then(response => this.units = response.data);
                //this.getAllUnit();  //call method
                $('#create-form-errors').html('');
                document.getElementById("modal-close-btn").click();
                // console.log(response.data);

                new PNotify({
                    title: response.data.title+' Message',
                    text: response.data.message,
                    shadow: true,
                    addclass: 'stack_top_right',
                    type: response.data.title,
                    width: '290px',
                    delay: 1500
                });
            })
            .catch((error) => {
                //console.log("Errorrr: "+error);
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
    	}
    }
});