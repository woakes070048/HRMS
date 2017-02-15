<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicSalaryInfo extends Model
{
	protected $table = 'basic_salary_info';
    protected $fillable = ['name','percent'];
}
