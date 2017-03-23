<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = ['level_name','description'];

    public function salaryInfo(){
    	return $this->hasMany('App\Models\LevelSalaryInfoMap', 'level_id', 'id');
    }


    // public function parent(){
    // 	return $this->belongsTo('App\Models\Level')->with('sibling');
    // }

    // public function sibling(){
    //     return $this->hasMany('App\Models\Level','parent_id','parent_id');
    // }

    public function parent(){
        return $this->belongsTo('App\Models\Level');
    }

    public function parentRecursive(){
        return $this->parent()->with('parentRecursive');
    }


    public function designation(){
    	return $this->hasMany('App\Models\Designation');
    }
}
