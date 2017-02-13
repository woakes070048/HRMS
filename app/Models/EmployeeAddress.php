<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{

    protected $table = 'employee_address';

    protected $fillable = ['user_id','present_division_id','present_district_id','present_policestation_id','present_postoffice','present_address',
        'permanent_division_id','permanent_district_id','permanent_policestation_id','permanent_postoffice','permanent_address'
    ];
}
