<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model
{
    protected $table = "employee_experience";

    protected $fillable = ['user_id','company_name','position_held','job_start_date','job_end_date','job_duration','job_responsibility','job_location','created_by'];
}
