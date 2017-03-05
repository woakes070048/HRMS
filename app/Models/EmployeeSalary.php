<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{

    protected $fillable = [];


    public function getSalaryEffectiveDateAttribute($value){
        return Carbon::parse($value)->format('M d Y');
    }

    public function basicSalaryInfo(){
        return $this->belongsTo('App\Models\BasicSalaryInfo');
    }


}
