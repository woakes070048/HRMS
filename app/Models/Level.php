<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['level_name','description'];

    public function salaryInfo(){
    	return $this->hasMany('App\Models\LevelSalaryInfoMap', 'level_id', 'id');
    }


    public function parent(){
    	return $this->belongsTo('App\Models\Level','parent_id');
    }


    public function designation(){
    	return $this->hasMany('App\Models\Designation');
    }
}
