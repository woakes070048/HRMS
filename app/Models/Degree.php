<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    public function educationLevel(){
    	return $this->belongsTo('App\Models\EducationLevel');
    }
}
