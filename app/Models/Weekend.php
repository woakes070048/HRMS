<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weekend extends Model
{
    protected $table = 'weekends';
    protected $fillable = ['weekend', 'created_by', 'updated_by', 'status'];
}
