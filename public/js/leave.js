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
    responsible_emp: 0,
    passport_no: '00',
    options: [],
    users: [],
    leaveType: [],
  },
  mounted(){
    axios.get('/get-employee').then(response => this.users = response.data);
    axios.get('/get-employee').then(response => this.options = response.data);
  }
})