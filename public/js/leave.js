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
    emp_name: '',
    emp_leave_type: '',
    from_date: '',
    to_date: '',
    date_diff: 0,
    leave_reason: '',
    leave_contact_address: '',
    leave_contact_number: '',
    responsible_emp: '',
    passport_no: '',
    leave_half_or_full: 1,
    options: [],
    users: [],
    leaveType: [],
    userLeaveType: [],
    userHaveLeavs: [],
    userTakenLeave: [],
    userTakenLeaveId: [],
    userTakenLeaveName: [],
    userTakenLeaveDays: [],
    show_history: [],
  },
  mounted(){
    axios.get('/get-employee').then(response => this.users = response.data);
    axios.get('/get-employee').then(response => this.options = response.data);
  },
  watch:{
    emp_name: function(id){

      if(id > 0){
        axios.get('/leave/user-taken-leave/'+id).then(response => {
          this.userLeaveType = response.data.user_leave_type;
          this.userHaveLeavs = response.data.userHaveLeavs;
          this.userTakenLeaveId = response.data.taken_leave_type_id;
          this.userTakenLeaveName = response.data.taken_leave_type_name;
          this.userTakenLeaveDays = response.data.taken_leave_type_days;
          this.userTakenLeave = response.data.taken_leave_ary;
          this.show_history = response.data.show_history;

          console.log(this.show_history);
        });
      }
      else{
        this.userLeaveType = [];
        this.userHaveLeavs = [];
        this.userTakenLeave = [];
      }
    }
  },
  methods:{
    date_diff_cal: function(){
      var emp_leave_type_js = this.emp_leave_type;
      
      if(this.emp_leave_type > 0){
        this.from_date = $('#from_date').val();
        this.to_date = $('#to_date').val();
        var date1 = new Date($('#from_date').val());
        var date2 = new Date($('#to_date').val());
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        this.date_diff = Math.ceil((timeDiff / (1000 * 3600 * 24))+1);
        var date_diff_js = this.date_diff;

        if(Date.parse($('#to_date').val()) < Date.parse($('#from_date').val()))
        {
          $('#show_date_diff').html('Invalid');
          this.date_diff = "";
        }
        else{
          $('#show_date_diff').html(this.date_diff);

            $.each( this.userLeaveType, function( key, value ) {
                if(emp_leave_type_js == value.id){
                  var chk_day = value.days - date_diff_js;
                
                  if(chk_day < 0 && value.days != null){
                    $('#show_date_diff_msg').html("* You can only apply for "+value.days+" days or below "+value.days+" days leave.");
                  }
                  else{
                    $('#show_date_diff_msg').html("");
                  }
                }
            });
        }
      }
      else{
        swal("Try again!", "Please select leave type first ...", "error");
      } 
    },
    saveData(e){

        var formData = new FormData(e.target);

        formData.append('file', document.getElementById('file').files[0]);

        axios.post('/leave/add', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
        })
        .then((response) => { 
            $( '#create-form-errors' ).html('');

            if(response.data.title == 'error'){
              swal({
                title: response.data.title+"!",
                text: response.data.message,
                type: response.data.title,
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Done",
                closeOnConfirm: true
              });
            }
            else{
              swal({
                  title: response.data.title+"!",
                  text: response.data.message,
                  type: response.data.title,
                  showCancelButton: false,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Done",
                  closeOnConfirm: false
              },
              function(){
                  location.href=location.href;
              });
            }
              
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
})