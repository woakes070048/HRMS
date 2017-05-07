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
  data: {
    emp_name: 0,
    from_date: '',
    to_date: '',
    date_diff: 0,
    responsible_emp: 0,
    passport_no: '00',
    options: [],
    users: [],
    leaveType: [],
    userLeaveType: [],
    userHaveLeavs: [],
    userTakenLeave: [],
    userTakenLeaveId: [],
    userTakenLeaveName: [],
    userTakenLeaveDays: [],
  },
  mounted(){
    axios.get('/get-employee').then(response => this.users = response.data);
    axios.get('/get-employee').then(response => this.options = response.data);
  },
  watch:{
    emp_name: function(id){

      axios.get('/leave/user-taken-leave/'+id).then(response => {
        this.userLeaveType = response.data.user_leave_type;
        this.userHaveLeavs = response.data.userHaveLeavs;
        this.userTakenLeaveId = response.data.taken_leave_type_id;
        this.userTakenLeaveName = response.data.taken_leave_type_name;
        this.userTakenLeaveDays = response.data.taken_leave_type_days;
        this.userTakenLeave = response.data.taken_leave_ary;

        console.log(this.userTakenLeave);
      });
    }
  },
  methods:{
    date_diff_cal: function(){
      alert('te');
    }
  }
})