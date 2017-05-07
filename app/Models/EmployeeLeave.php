<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    protected $table = 'employee_leaves';
    protected $fillable = ['user_id', 'leave_type_id', 'employee_leave_from', 'employee_leave_to', 'employee_leave_user_remarks', 'employee_leave_half_or_full', 'employee_leave_contact_address', 'employee_leave_contact_number', 'employee_leave_passport_no', 'employee_leave_responsible_person', 'employee_leave_attachment', 'employee_leave_recommend_to', 'employee_leave_approved_by', '	employee_leave_approval_remarks', 'employee_leave_status'];

    public function leaveType(){
        return $this->belongsTo('App\Models\LeaveType');
    }
}
