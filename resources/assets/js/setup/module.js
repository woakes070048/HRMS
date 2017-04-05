new Vue({
    el: "#mainDiv",
    data:{
        msg: "tesign",
        module_name: '',
        module_details: '',
        module_status: 1,
    },
    mounted(){
        //alert('test vue alert');
    },
    methods:{
        saveData(formId){
            var formData = $('#'+formId).serialize();

            axios.post('/modules/add', formData)
            .then((response) => { 

                $('#create-form-errors').html('');
                document.getElementById("modal-close-btn").click();

                //empty text field after save data             

                swal('success',' Data added successfully!');
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
    }
});