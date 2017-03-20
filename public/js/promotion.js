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
		from_designation: null,
		to_designation: null,
	    users: [],
	},
	mounted(){
		axios.get('/promotion/getPromotionsData').then(response => this.allData = response.data);
		axios.get('/get-employee').then(response => {
                this.users = response.data;
            });
	},
	watch:{
		user_id: function(id){
			axios.get('/promotion/getSingelUser/'+id).then(response => {
                // console.log(' Response Dsataa >>> ' + response.data.first_name);
                this.from_designation = response.data.designation.designation_name+'-('+response.data.designation.level.level_name+')-('+response.data.designation.department.department_name+')';
            });
		}
	}
});

	