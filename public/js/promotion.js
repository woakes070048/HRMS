<<<<<<< HEAD
Vue.component('select2', {
    props: ['options', 'value'],
    template: '<select><slot></slot></select>',
    mounted: function () {
        var vm = this
        $(this.$el)
          .val(this.value)
          // init select2
          .select2({ data: this.options })
          // emit event on change.
          .on('change', function () {
            vm.$emit('input', this.value)
          })
    },
    watch: {
        value: function (value) {
          // update value
          $(this.$el).val(value)
        },
        options: function (options) {
          // update options
          $(this.$el).select2({ data: options })
        }
    },
    destroyed: function () {
        $(this.$el).off().select2('destroy')
    }
})

new Vue({
	el: '#mainDiv',
	data:{
		hdn_id: '',
		formType: "",
		allData: [],
		user_id: 0,
		from_designation: '',
		from_designation_id: '',
		to_designation_id: '',
	    users: [],
	    designation_select2: [],
	    from_unit: '',
	    from_unit_id: '',
	    unit_select2: [],
	    from_branch: '',
	    from_branch_id: '',
	    branch_select2: [],
	    from_supervisor: '',
	    from_supervisor_id: 0,
	    supervisor_select2: [],
	    to_supervisor_id: '',

	    edit_user_id:'',
	    edit_formType: "",
		edit_from_designation: '',
		edit_from_designation_id: '',
		edit_to_designation_id: '',
		edit_designation_select2: [],
		edit_from_unit: '',
		edit_from_unit_id: '',
		edit_unit_select2: [],
		edit_from_branch: '',
		edit_from_branch_id: '',
		edit_branch_select2: [],
		edit_from_supervisor: '',
		edit_from_supervisor_id: 0,
		edit_supervisor_select2: [],
		edit_to_supervisor_id: '',
		edit_effective_date: '',
		edit_remarks: '',
	},
	mounted(){
		this.getAllData();  //call method
	},
	watch:{
		user_id: function(id){
			axios.get('/promotion/getSingelUser/'+id).then(response => {
                this.from_designation = response.data.multi_values.designation.designation_name+'-('+response.data.multi_values.designation.level.level_name+')-('+response.data.multi_values.designation.department.department_name+')';
                this.from_designation_id = response.data.multi_values.designation.id;
            	this.designation_select2 = response.data.to_designation;
            	this.from_unit = (response.data.multi_values.unit)?(response.data.multi_values.unit.unit_name+'-('+response.data.multi_values.unit.department.department_name+')'):'';
            	this.from_unit_id = (response.data.multi_values.unit)?(response.data.multi_values.unit.id):'';
            	this.from_branch = (response.data.multi_values.branch)?(response.data.multi_values.branch.branch_name):'';
            	this.from_branch_id = (response.data.multi_values.branch)?(response.data.multi_values.branch.id):'';
            	this.from_supervisor = (response.data.multi_values.supervisor)?(response.data.multi_values.supervisor.first_name+' '+response.data.multi_values.supervisor.last_name):'';
            	this.from_supervisor_id = (response.data.multi_values.supervisor)?(response.data.multi_values.supervisor.id):'0';
            	this.supervisor_select2 = response.data.to_supervisor;
            });
		},
		to_designation_id: function(id){
			axios.get('/get-unit-by-designation-id/'+id).then(response => {
                this.unit_select2 = response.data;
            });
		},
		edit_to_designation_id: function(id){
			axios.get('/get-unit-by-designation-id/'+id).then(response => {
                this.edit_unit_select2 = response.data;
            });
		}
	},
	methods:{
		getAllData(){
			axios.get('/promotion/getPromotionsData').then(response => this.allData = response.data);
			axios.get('/get-branches').then(response => this.branch_select2 = response.data);
			axios.get('/get-employee').then(response => this.users = response.data);
		},
		savePromotion: function(formId){

    		var formData = $('#'+formId).serialize();

            axios.post('/promotion/add', formData)
            .then((response) => { 

                this.getAllData();  //call method

                $('#create-form-errors').html('');
                document.getElementById("modal-close-btn").click();

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
        editData: function(id, index){

        	this.unitIndex = index;
            this.hdn_id = id;

            var userId = this.allData[index].user.id;
            this.edit_user_id = this.allData[index].user.first_name+' '+this.allData[index].user.last_name;

            this.edit_formType = this.allData[index].promotion_type;
            this.edit_from_designation = this.allData[index].prev_designation.designation_name+'-('+this.allData[index].prev_designation.department.department_name+')-('+this.allData[index].prev_designation.level.level_name+')';
			this.edit_from_unit = (this.allData[index].prev_unit)?this.allData[index].prev_unit.unit_name:'';
			this.edit_from_branch = (this.allData[index].prev_branch)?this.allData[index].prev_branch.branch_name:'';
			this.edit_from_supervisor = (this.allData[index].prev_supervisor)?this.allData[index].prev_supervisor.first_name:'';
			this.edit_effective_date = this.allData[index].transfer_effective_date;
			this.edit_remarks = this.allData[index].remarks;

            // this.edit_to_designation_id = this.allData[index].current_designation.id;
            // this.edit_to_designation_id = this.allData[index].current_designation.id;
            

            axios.get('/promotion/getSingelUser/'+userId).then(response => {
                this.edit_designation_select2 = response.data.to_designation;
            	this.edit_supervisor_select2 = response.data.to_supervisor;
            });
        }
	}
});

	
=======
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

(function webpackMissingModule() { throw new Error("Cannot find module \"/var/www/html/hrms/resources/assets/js/hrms/promotion.js\""); }());


/***/ })

/******/ });
>>>>>>> f824d22b91a56a441b3941e757afb71654cbc85e
