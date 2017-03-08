
var employee = new Vue({
    el : '#employee',
    data : {
        tempData:null,
        tab: current_tab,
        user_id:user_id,

        present_division_id:null,
        present_district_id:null,
        permanent_division_id:null,
        permanent_district_id:null,
        designations: [],
        divisions: [],
        districts:[],
        permanentDistricts:[],
        policeStations: [],
        permanentPoliceStations: [],

        blood_group : [],
        personals:[],

        education_level_id: null,
        education_levels : [],
        institutes: [],
        degrees:[],
        departments:[],
        levels:[],

        basics: [],
        experiences:[],
        educations: [],

        showDivision:false,
        showCgpa: true,
        job_duration: null,
        submit_button:null,

        errors: [],
    },

    mounted(){
        this.getTabData();

        // $('#startDate').datepicker().on('changeDate', () => { this.startDate = $('#startDate').val() })
    },

    watch : {
        tab: 'getTabData',
        present_division_id: function(id){
            this.getDistrictByDivisionId(id,'present');
        },

        present_district_id: function(id){
            this.getPoliceStationByDistrictId(id,'present');
        },

        permanent_division_id: function(id){
            this.getDistrictByDivisionId(id,'permanent');
        },

        permanent_district_id: function(id){
            this.getPoliceStationByDistrictId(id,'permanent');
        },

    },

    methods : {

        theDuration(){
            var diff = Math.abs(new Date($('#job_start_date').val()) - new Date($('#job_end_date').val()));
            var year = 1000 * 60 * 60 * 24 * 30 * 12;
            var years = Math.abs(diff/year);
            this.job_duration =  years.toFixed(1);
        },

        // validateBeforeSubmit(){
        //     var bindThis = this;
        //     return this.$validator.validateAll().then(success => {
        //         if (!success) {
        //             bindThis.formValidation = false;
        //         }else{
        //             bindThis.formValidation = true;
        //         }
        //     });
        // },

        getTabData(){

            this.urlChange(this.tab);

            if(this.tab == ''){
                this.getDesignations();
                this.getDivisions();
                this.getBasic();
            }
            if(this.tab == 'personal'){
                this.getPersonals();
                this.getBloodGroups();
            }
            if(this.tab == 'education'){
                this.getEducationLevels();
                this.getEducations();
            }
            if(this.tab == 'experience'){
                this.getExperience();
            }
        },

        urlChange(tab){
            window.history.pushState('obj', tab, base_url+'/employee/add/'+id+tab);
        },

        getBasic(){
            axios.get('/employee/add/'+id+this.tab).then(response => {
                this.basics = response.data;
                // console.log(this.basics);
            });
        },


        getPersonals(){
             axios.get('/employee/add/'+id+this.tab).then(response => {
                this.personals = response.data;
                // console.log(this.personals);
            });
        },


        getDepartmentsAndLevels(){
            this.getDepartments();
            this.getLevels();
        },

        getDepartments(){
            axios.get('/get-departments').then(response => {
                this.departments = response.data;
            });
        },


        getLevels(){
            axios.get('/get-levels').then(response => {
                this.levels = response.data;
            });
        },


        getEducations(){
            axios.get('/employee/add/'+id+this.tab).then(response => {
                this.educations = response.data;
                // console.log(this.educations);
            });
        },

        getExperience(){
            axios.get('/employee/add/'+id+this.tab).then(response => {
                this.experiences = response.data;
                // console.log(this.experiences);
            });
        },

        getDesignations(){
            axios.get('/get-designations').then(response => this.designations = response.data);
        },

        getDivisions(){
            axios.get('/get-divisions').then(response => this.divisions = response.data);
        },

        getDistrictByDivisionId(id,tempData){
            axios.get('/get-district-by-division/'+id)
                .then((response)=>{
                    if(tempData == 'permanent'){
                    this.permanentDistricts = response.data;
                }
                if(tempData == 'present'){
                    this.districts = response.data;
                }
            });
        },

        getPoliceStationByDistrictId(id,tempData){
            axios.get('/get-police-station-by-district/'+id)
                .then((response) => {
                if(tempData == 'permanent'){
                    this.permanentPoliceStations = response.data;
                }
                if(tempData == 'present'){
                    this.policeStations = response.data;
                }
            });
        },

        getBloodGroups(){
            axios.get('/get-blood-groups').then(
                response => this.blood_group = response.data
            );
        },

        getEducationLevels(){
            axios.get('/get-education-levels').then(
                response => this.education_levels = response.data
            );
        },

        getInstituteAndDegreeByEducationLevelId(){
            var education_level_id = this.education_level_id;
            this.getInstituteByEducationLevelId(education_level_id);
            this.getDegreeByEducationLevelId(education_level_id);
        },

        getInstituteByEducationLevelId(id){
            axios.get('/get-institute-by-education-level/'+id).then(
                response => this.institutes = response.data
            );
        },

        getDegreeByEducationLevelId(id){
            axios.get('/get-degree-by-education-level/'+id).then(
                response => this.degrees = response.data
            );
        },

        addNewDesignation(id){
            var formData = $('#'+id).serialize();
            axios.post('/employee/add/designation',formData)
                .then((response) => {
                    // console.log(response);
                    var data = response.data;
                    this.errors = [];
                    this.designations.push(response.data.data);
                    jQuery(".mfp-close").trigger("click");

                    new PNotify({
                        title: data.title,
                        text: data.message,
                        shadow: true,
                        addclass: 'stack_top_right',
                        type: data.status,
                        width: '290px',
                        delay: 1500
                    });
                })
                .catch(error => {
                    console.log(error);
                    if(error.response.status == 500 || error.response.data.status == 'danger'){
                        var error = error.response.data;
 
                        new PNotify({
                            title: error.title,
                            text: error.message,
                            shadow: true,
                            addclass: 'stack_top_right',
                            type: error.status,
                            width: '290px',
                            delay: 1500
                        });
                    }else if(error.response.status == 422){
                        this.errors = error.response.data;
                    }

            });
        },
        
        addNewEducation(e){
            // var form = document.querySelector("#"+id);
            var formData = new FormData(e.target);
            axios.post('/employee/add/'+user_id+'/education',formData)
                .then((response) => {
                    // console.log(response);
                    var data = response.data;
                    this.errors = [];
                    this.job_duration = null;

                    jQuery(".mfp-close").trigger("click");
                    // console.log(this.educations);
                    this.educations = data.data;

                    new PNotify({
                        title: data.title,
                        text: data.message,
                        shadow: true,
                        addclass: 'stack_top_right',
                        type: data.status,
                        width: '290px',
                        delay: 1500
                    });

                    if(data.type){
                        jQuery("#"+data.type).trigger("click");
                    }
                })
                .catch(error => {
                    console.log(error);
                    if(error.response.status == 500 || error.response.data.status == 'danger'){
                        var error = error.response.data;
 
                        new PNotify({
                            title: error.title,
                            text: error.message,
                            shadow: true,
                            addclass: 'stack_top_right',
                            type: error.status,
                            width: '290px',
                            delay: 1500
                        });
                    }else if(error.response.status == 422){
                        this.errors = error.response.data;
                    }

            });
        },

        addNewExperience(e){
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            // console.log(formData);
            this.submit_button = null;

            axios.post('/employee/add/'+user_id+'/experience',formData)
                .then((response) => {
                    // console.log(response);
                    var data = response.data;
                    this.errors = [];

                    jQuery(".mfp-close").trigger("click");

                    this.experiences.push(data.data);

                    new PNotify({
                        title: data.title,
                        text: data.message,
                        shadow: true,
                        addclass: 'stack_top_right',
                        type: data.status,
                        width: '290px',
                        delay: 1500
                    });

                    if(data.type){
                        this.urlChange(data.type);
                        jQuery("#"+data.type).trigger("click");
                    }

                })
                .catch(error => {
                    console.log(error);
                    if(error.response.status == 500 || error.response.data.status == 'danger'){
                        var error = error.response.data;
 
                        new PNotify({
                            title: error.title,
                            text: error.message,
                            shadow: true,
                            addclass: 'stack_top_right',
                            type: error.status,
                            width: '290px',
                            delay: 1500
                        });
                    }else if(error.response.status == 422){
                        this.errors = error.response.data;
                    }

            });
        },

    },
});