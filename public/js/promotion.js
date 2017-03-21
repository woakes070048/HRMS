// import Vue from 'vue';
// import VeeValidate from 'vee-validate';

// Vue.use(VeeValidate);

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
		allData: [],
		user_id: 0,
		from_designation_id: null,
		from_designation: null,
		to_designation_id: null,
	    users: [],
	    designation_select2: [],
	    from_unit: null,
	    from_unit_id: null,
	    unit_select2: [],
	    from_branch: null,
	    from_branch_id: null,
	    branch_select2: [],
	    from_supervisor: null,
	    supervisor_select2: [],
	    to_supervisor_id: null,
	    chk_supervisor_old_id: 0,
	},
	mounted(){
		axios.get('/promotion/getPromotionsData').then(response => this.allData = response.data);
		axios.get('/get-branches').then(response => this.branch_select2 = response.data);
		axios.get('/get-employee').then(response => this.users = response.data);
	},
	watch:{
		user_id: function(id){
			axios.get('/promotion/getSingelUser/'+id).then(response => {
                // console.log(' Response Dsataa >>> ' + response.data.to_designation);
                this.from_designation = response.data.multi_values.designation.designation_name+'-('+response.data.multi_values.designation.level.level_name+')-('+response.data.multi_values.designation.department.department_name+')';
            	this.designation_select2 = response.data.to_designation;
            	this.from_unit = (response.data.multi_values.unit)?(response.data.multi_values.unit.unit_name+'-('+response.data.multi_values.unit.department.department_name+')'):'';
            	this.from_branch = (response.data.multi_values.branch)?(response.data.multi_values.branch.branch_name):'';
            	this.from_supervisor = (response.data.multi_values.supervisor)?(response.data.multi_values.supervisor.first_name+' '+response.data.multi_values.supervisor.last_name):'';
            	this.chk_supervisor_old_id = (response.data.multi_values.supervisor)?(response.data.multi_values.supervisor.id):'0';
            	this.supervisor_select2 = response.data.to_supervisor;
            });
		},
		to_designation_id: function(id){
			axios.get('/get-unit-by-designation-id/'+id).then(response => {
                // console.log(' Response Dsataa >>> ' + response.data);
                this.unit_select2 = response.data;
            });
		}
	}
});

	