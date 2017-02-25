<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_no','designation_id','first_name','middle_name','last_name','nick_name','email', 'password','mobile_number','photo','created_by','update_by',

    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getFirstNameAttribute($value){
        return ucfirst($value);
    }


    public function getMiddleNameAttribute($value){
        return ucfirst($value);
    }


    public function getLastNameAttribute($value){
        return ucfirst($value);
    }

    public function getNickNameAttribute($value){
        return ucfirst($value);
    }


    public function getFullNameAttribute(){
        return ucfirst($this->first_name). ' ' .ucfirst($this->last_name);
    }


    public function getFullImageAttribute(){
        return Storage::disk('public')->url($this->id.'/'.$this->photo);
    }


    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('d M Y');
    }


    public function createdBy(){
        return $this->belongsTo('App\Models\User','created_by','id');
    }


    public function designation(){
        return $this->belongsTo('App\Models\Designation');
    }
    

    public function address(){
        return $this->hasOne('App\Models\EmployeeAddress');
    }


    public function details(){
        return $this->hasOne('App\Models\EmployeeDetail');
    }


    public function educations(){
        return $this->hasMany('App\Models\EmployeeEducation');
    }


    public function experiences(){
        return $this->hasMany('App\Models\EmployeeExperience');
    }


}
