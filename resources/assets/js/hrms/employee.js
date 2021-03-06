// import Other_Allowance from "./../components/employee/other_allowance.vue";
// Vue.component('other-allowance', Other_Allowance);


// $('body').LoadingOverlay("show");

Vue.component('select2', {
   props: ['value'],
   template: '<select><slot></slot></select>',
   mounted: function() {
     var vm = this
     $(this.$el)
       .val(this.value).select2()
       .on('change', function() {
         vm.$emit('input', this.value)
       })
   },
   watch: {
     value: function(value) {
       $(this.$el).select2('val', value)
     }
   },
   destroyed: function() {
     $(this.$el).off().select2('destroy')
   }
 });


// $(document).ready(function(){

// $('body').LoadingOverlay("hide");

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

        employeeTypes:[],
        branches:[],
        designation_id:0,
        designations: [],
        units: [],
        supervisor_id:0,
        supervisors: [],
        allUnits:[],

        divisions: [],
        districts: [],
        permanentDistricts: [],
        policeStations: [],
        permanentPoliceStations: [],

        blood_group : [],
        religions : [],
        personals: [],

        education_level_id: null,
        education_levels : [],
        institutes: [],
        degrees: [],
        departments: [],
        levels: [],

        basics: [],
        experiences: [],
        educations: [],

        showDivision:false,
        showCgpa: true,
        job_duration: null,

        basic_salary:null,
        salary_in_cache:null,
        levelSalaryNotinLevels:[],
        levelSalaryInfos: [],
        salaries:[],
        banks: [],
        nominees: [],
        nominee_distribution:0,
        nominee_rest_distribution:0,
        trainings: [],
        references: [],
        childrens: [],
        language: [],
        languages: [],

        submit_button:null,
        errors: [],
        otherAllowance:[],
        allow: [],

        singleEducation: [],
        singleExperience: [],
        singleTraining: [],
        singleReference: [],
        singleChildren: [],
        singleLanguage: [],
        singleNominee: [],
    },

    mounted(){
        // $('body').LoadingOverlay("hide");
        this.getTabData();
        // $('#startDate').datepicker().on('changeDate', () => { this.startDate = $('#startDate').val() });
    },

    // computed:{

    // },


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

        education_level_id: function(){
            this.getInstituteAndDegreeByEducationLevelId();
        },

        designation_id: function(id){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            this.getUnitByDesignationId(id);
            this.getSupervisorByDesignationId(id);
            $('#employee > .panel > .panel-body').LoadingOverlay("hide");
        }

    },


    methods : {

        theDuration(){
            var diff = Math.abs(new Date($('#job_start_date').val()) - new Date($('#job_end_date').val()));
            var year = 1000 * 60 * 60 * 24 * 30 * 12;
            var years = Math.abs(diff/year);
            this.job_duration =  years.toFixed(1);
        },

        theDuration2(){
            var diff = Math.abs(new Date($('#job_start_date2').val()) - new Date($('#job_end_date2').val()));
            var year = 1000 * 60 * 60 * 24 * 30 * 12;
            var years = Math.abs(diff/year);
            this.job_duration =  years.toFixed(1);
        },

        theDuration3(){
            var diff = Math.abs(new Date($('#job_start_date3').val()) - new Date($('#job_end_date3').val()));
            var year = 1000 * 60 * 60 * 24 * 30 * 12;
            var years = Math.abs(diff/year);

            this.singleExperience.job_start_date = $('#job_start_date3').val();
            this.singleExperience.job_end_date = $('#job_end_date3').val();
            this.singleExperience.job_duration =  years.toFixed(1);
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

        datePickerYear(){
            $('.date').datetimepicker({
                format: 'YYYY',
                viewMode: 'years',
                minViewMode: "years",
                pickTime: false
            });
        },

        datePicker(){
            $('.datepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                pickTime: false
            });
        },

        myDatePicker(){
            $('.mydatepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                pickTime: false
            });
        },

        getTabData(){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");

            this.urlChange(this.tab);
            this.errors = [];

            if(this.tab == ''){
                
                this.getBranches();
                this.getEmployeeType();
                this.getDesignations();
                this.getDivisions();
                this.getBasic();
                
            }

            if(this.tab == 'personal'){
                this.getPersonals();
                this.getBloodGroups();
                this.getReligions();
            }

            if(this.tab == 'education'){
                this.getEducationLevels();
                this.getEducations();
            }

            if(this.tab == 'experience'){
                this.getExperience();
            }
            if(this.tab == 'salary'){
                this.getSalary(); // employee salaries info
                this.getLevelSalaryInfo();
                this.getBanks();
            }

            if(this.tab == 'nominee'){
                this.getNominees();
            }

            if(this.tab == 'training'){
                this.getTrainings();
            }

            if(this.tab == 'reference'){
                this.getReferences();
            }

            if(this.tab == 'children'){
                this.getChildrens();
            }

            if(this.tab == 'language'){
                this.getLanguage();
                this.getLanguages();
            }
            $('#employee > .panel > .panel-body').LoadingOverlay("hide");
        },


        makeUrl(){
            if(this.user_id && this.tab){
                return '/employee/'+add_edit+'/'+this.user_id+'/'+this.tab;
            }else if(this.user_id){
                return '/employee/'+add_edit+'/'+this.user_id;
            }else{
                return '/employee/'+add_edit;
            }
        },


        urlChange(tab){
            var url = this.makeUrl();
            window.history.pushState('obj', tab, base_url+url);
        },


        getBasic(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.basics = response.data;
            console.log(this.basics);
        });
        },


        getPersonals(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.personals = response.data;
            // console.log(this.personals);
        });
        },


        getEducations(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.educations = response.data;
        });
        },


        getExperience(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.experiences = response.data;
        });
        },


        getSalary(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.salaries = response.data;
        });
        },


        getNominees(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
            this.nominees = response.data;
                console.log(this.nominees);
        });
        },


        getTrainings(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.trainings = response.data;
            // console.log(this.trainings);
        });
        },


        getReferences(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.references = response.data;
            // console.log(this.references);
        });
        },


        getChildrens(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.childrens = response.data;
            // console.log(this.childrens);
            });
        },


        getLanguages(){
            var url = this.makeUrl();
            axios.get(url).then(response => {
                this.languages = response.data;
                console.log(this.languages);
            });
        },


        getBranches(){
            axios.get('/get-branches').then(response => {
                this.branches = response.data;
                console.log(this.branches);
            });
        },


        getEmployeeType(){
            axios.get('/get-employee-type').then(response => {
                this.employeeTypes = response.data;
            console.log(this.employeeTypes);
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


        getDesignations(){
            axios.get('/get-designations').then(response => {
                this.designations = response.data;
                console.log(this.designations);
            });
        },


        getAllUnit(){
             axios.get('/get-units').then(response => {
                this.allUnits = response.data;
                console.log(this.allUnits);
            });
        },


        getUnitByDesignationId(id){
            // var id = this.designation_id;
             axios.get('/get-unit-by-designation-id/'+id).then(response => {
                this.units = response.data;
                console.log(this.units);
            });
        },


        getSupervisorByDesignationId(id){
             axios.get('/get-supervisor-by-designation-id/'+id).then(response => {
                this.supervisors = response.data;
                console.log(this.supervisors);
            });
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

         getReligions(){
            axios.get('/get-religions').then(
                response => this.religions = response.data
        );
        },


        getEducationLevels(){
            axios.get('/get-education-levels').then(
                response => this.education_levels = response.data
        );
        },


        getInstituteAndDegreeByEducationLevelId(){
            var education_level_id = this.education_level_id;
            this.institutes = [];
            this.degrees = [];
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


        getBanks(){
            axios.get('/get-banks').then(response => {
                this.banks = response.data;
            console.log(this.banks);
        });
        },


        getLevelSalaryInfo(){
            axios.get('/get-level-salary-info/'+this.user_id).then(response => {
                this.levelSalaryInfos = response.data.designation.level;
            console.log(this.levelSalaryInfos);
        });
        },


        getAllowanceNotinLevel(modal_id){
            axios.get('/get-allowance-notin-level/'+this.allow).then(response => {
                this.levelSalaryNotinLevels = response.data;
                setTimeout(this.modal_open(modal_id),5);
            });
        },


        addMoreAllowance(id){
            var formData = $('#'+id).serializeArray();
            var data;
            var allowance_ids = [];

            for(data in formData){
                this.allow.push(formData[data].value);
                allowance_ids.push(formData[data].value);
            }

            axios.get('/get-allowance-by-ids/'+allowance_ids).then(response => {
                for(var data in response.data){
                    this.otherAllowance.push(response.data[data]);
                }
                jQuery(".mfp-close").trigger("click");
            });
        },

        getLanguage(){
            axios.get('/get-language').then(response => {
                this.language = response.data;
            // console.log(this.language);
        });
        },


        showMessage(data){
            new PNotify({
                title: data.title,
                text: data.message,
                shadow: true,
                addclass: 'stack_top_right',
                type: data.status,
                width: '290px',
                delay: 1500
            });
        },


        addLanguage(id){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            var formData = $('#'+id).serialize();
            axios.post('/add-language',formData)
                .then((response) => {
                // console.log(response);
                    var data = response.data;
                this.errors = [];
                this.language.push(response.data.data);
                jQuery(".mfp-close").trigger("click");
                this.showMessage(data);
                 $('#employee > .panel > .panel-body').LoadingOverlay("hide");
            })
            .catch(error => {
                console.log(error);
                 $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addNewDesignation(id){
            var formData = $('#'+id).serialize();
            axios.post('/add-designation',formData)
                .then((response) => {
                console.log(response);
            var data = response.data;
            this.errors = [];
            // this.designations.push(response.data.data);
            this.designations = response.data.data;
            jQuery(".mfp-close").trigger("click");
            this.showMessage(data);
        })
        .catch(error => {
                console.log(error);
            if(error.response.status == 500 || error.response.data.status == 'danger'){
                var error = error.response.data;
                this.showMessage(error);
            }else if(error.response.status == 422){
                this.errors = error.response.data;
            }

        });
        },


        addEmployeeBasicInfo(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");

            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.user_id = data.data.id;
                this.errors = [];
                this.basics = data.data;
                this.showMessage(data);
                console.log(data);
                if(data.type){
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }
            })
            .catch(error => {
                    console.log(error);
                    $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addPersonalInfo(e){
            // var form = document.querySelector("#"+id);
             $('#employee > .panel > .panel-body').LoadingOverlay("show");
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                 $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.errors = [];
                this.personals = data.data;
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }
            })
            .catch(error => {
                console.log(error);
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addNewEducation(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var form = document.querySelector("#"+id);
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                // console.log(response);
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.errors = [];

                jQuery(".mfp-close").trigger("click");
                // console.log(this.educations);
                this.educations = data.data;
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }
            })
            .catch(error => {
                console.log(error);
                 $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addNewExperience(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                // console.log(response.data.data);
                var data = response.data;
                this.errors = [];
                jQuery(".mfp-close").trigger("click");
                this.experiences = data.data;
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }

            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addSalary(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                    $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                // console.log(response);
                var data = response.data;
                this.errors = [];
                this.salaries = data.data;
                this.otherAllowance = [];
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }

            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                this.errors = [];
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        nomineeDistribution(e){
            var rest_dis = e.target.value;
            if(rest_dis <= 100){
                this.nominee_rest_distribution = 100 - rest_dis;
            }else{
                alert("The value must less then 100.");
                this.nominee_distribution = 100;
                this.nominee_rest_distribution = 0.0;
            }
        },


        addNomineeInfo(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.errors = [];
                jQuery(".mfp-close").trigger("click");
                this.nominees = data.data;
                console.log(this.nominees);

                this.showMessage(data);
                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }
            })
            .catch((error)=>{
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }
            });
        },


        addNewTraining(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                // console.log(response);
                var data = response.data;
                this.errors = [];
                jQuery(".mfp-close").trigger("click");
                this.trainings = data.data;
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }

            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addNewReference(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                // console.log(response);
                var data = response.data;
                this.errors = [];
                jQuery(".mfp-close").trigger("click");
                this.references = data.data;
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }

            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addNewChildren(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);
            formData.append(this.submit_button,this.submit_button);
            this.submit_button = null;

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.errors = [];
                jQuery(".mfp-close").trigger("click");
                this.childrens = data.data;
                this.showMessage(data);

                if(data.type){
                    // this.urlChange(data.type);
                    // jQuery("#"+data.type).trigger("click");
                    setTimeout(function(){document.getElementById(data.type).click();},5);
                }

            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        addNewLanguage(e){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            // var formData = $('#'+id).serialize();
            var formData = new FormData(e.target);

            var url = this.makeUrl();

            axios.post(url,formData)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.errors = [];
                jQuery(".mfp-close").trigger("click");
                this.languages = data.data;
                this.showMessage(data);
            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },


        deleteEmployeeData(id,tab){
            var ck = confirm("Are you sure delete this?");
            if(ck == false){
                return false;
            }
            $('#employee > .panel > .panel-body').LoadingOverlay("show");

            axios.delete('/employee/delete/'+id+'/'+tab)
                .then((response) => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                var data = response.data;
                this.showMessage(data);
                this.getTabData();
            })
            .catch(error => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                console.log(error);
                if(error.response.status == 500 || error.response.data.status == 'danger'){
                    var error = error.response.data;
                    this.showMessage(error);
                }else if(error.response.status == 422){
                    this.errors = error.response.data;
                }

            });
        },

        modal_open(form_id) {
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


        getDataByTabAndId(data_tab,data_id,form_id){
            $('#employee > .panel > .panel-body').LoadingOverlay("show");
            axios.get('/employee/'+add_edit+'/tab/'+data_tab+'/'+data_id).then(response => {
                $('#employee > .panel > .panel-body').LoadingOverlay("hide");
                if(data_tab == 'education'){
                    this.singleEducation = response.data;
                }
                if(data_tab == 'experience'){
                    this.singleExperience = response.data;
                }
                if(data_tab == 'training'){
                    this.singleTraining = response.data;
                }
                if(data_tab == 'reference'){
                    this.singleReference = response.data;
                }
                if(data_tab == 'children'){
                    this.singleChildren = response.data;
                }
                if(data_tab == 'language'){
                    this.singleLanguage = response.data;
                }
                if(data_tab == 'nominee'){
                    this.singleNominee = response.data;
                }
                setTimeout(this.modal_open(form_id),5);
                
            });
        },

    },
});




// });



