<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['field_name','field_value'];


    public function getFieldNameFormatAttribute($value){
    	return ucfirst(str_replace('_',' ',$value));
    }
}
