<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['department_name'];


    public function units(){
    	return $this->hasMany('App\Models\Units','unit_departments_id','id')->where('unit_status',1);
    }
}
