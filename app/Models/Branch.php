<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['branch_name','branch_email','branch_mobile','branch_phone','branch_location','branch_status'];
}
