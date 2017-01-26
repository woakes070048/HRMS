<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{

    protected $fillable = [
    	'company_name','company_address','database_name','application_key'
    ];
    
}
