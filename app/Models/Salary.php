<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
   protected $fillable = [
   	'user_id','basic_salary','salary_in_cash','salary_month','salary_days','salary_pay_type','overtime_hour','overtime_amount','attendance_info','total_allowance','total_deduction','total_salary','gross_salary','created_by','updated_by'
   ];
}
