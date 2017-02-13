<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = ['department_id','level_id','designation_name','designation_description'];

    public function department(){

    	return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    public function level(){

    	return $this->hasOne('App\Models\Level', 'id', 'level_id');
    }
}
