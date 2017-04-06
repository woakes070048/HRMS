<?php

namespace App\Models\Setup;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $table = "modules";
    protected $fillable = [
    	'id', 'module_name', 'module_details', 'module_status'
    ];
}
