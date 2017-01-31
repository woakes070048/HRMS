<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{

    protected $fillable = [
    	'user_id','company_name','company_address','database_name','package_end_date'
    ];
    
}
