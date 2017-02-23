import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);


// new Vue({
//     el: '#app',
//     data() {
//         return {
//             email: '',
//             name: '',
//             phone: '',
//             url: '',
//         };
//     },
//     methods: {
//         validateBeforeSubmit() {
//             // Validate All returns a promise and provides the validation result.
//             this.$validator.validateAll().then(success => {
//                 if (! success) {
//                     // handle error
//                     return;
//                 }
//                 alert('From Submitted!');
//             });
//         }
//     }
// });

new Vue({
        el: "#modalSalaryInfoAdd",
        data: {
            info_name: '',
            info_status: 0,
            info_amount: '00.00',
            errorsHtml: '',
        },
        methods: {
            saveSalaryInfo: function(event){

                this.$validator.validateAll().then(success => {
                    if (! success) {
                        // handle error
                        return;
                    }
                    else{
                        axios.post('/salaryInfo/add', {
                            info_name: this.info_name,
                            info_status: this.info_status,
                            info_amount: this.info_amount,
                        })
                        .then(function (response) {
                            
                            alert('Success');
                        })
                        .catch(function (response) {
                            
                            var errors = response.response.data;

                            var errorsHtml = '<div class="alert alert-danger"><ul>';
                            $.each( errors , function( key, value ) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            errorsHtml += '</ul></di>';
                            $( '#create-form-errors' ).html( errorsHtml );
                            // $( '#create-form-errors' ).html(error.responseJSON);
                            // console.log("ERRORfffffff: "+);
                        });
                    }
                });
            }
        }
    });