import Vue from 'vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

var showData = new Vue({
    el: '#showData',
    data: {
        message: 'Hello Vue!',
        salaryInfo:[]
    },
    mounted(){
        //this.fetchData();
    },
    methods:{
        fetchData: function(event){
            axios.get('/salaryInfo/getAllInfo').then(response => this.salaryInfo = response.data);
        }
    }
});


new Vue({
    el: "#modalSalaryInfoAdd",
    data: {
        info_name: '',
        info_status: 0,
        info_amount: '',
        errorsHtml: '',
        close_modal: 1,
    },
    mounted(){
        showData.fetchData();  //call function from el:showData
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
                        // router.go({
                        //     path: '/salaryInfo/index',
                        //     force: true
                        // })  
                        showData.salaryInfo.push(response.data.data);
                    })
                    .catch(function (response) {
                         console.log(response);
                        var errors = response.response.data;

                        var errorsHtml = '<div class="alert alert-danger"><ul>';
                        $.each( errors , function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        errorsHtml += '</ul></di>';
                        $( '#create-form-errors' ).html( errorsHtml );
                    });
                }
            });
        }
    }
});