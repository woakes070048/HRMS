<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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


    public function getLastNameAttribute($value){
        return ucfirst($value);
    }


    public function getFullNameAttribute(){
        return ucfirst($this->first_name). ' ' .ucfirst($this->last_name);
    }


    public function getNickNameAttribute($value){
        return ucfirst($value);
    }


    public function getFullImageAttribute(){
//        return $this->photo;
        return \Storage::disk('public')->url($this->id.'/'.$this->photo);
    }


    public function designation(){
        return $this->belongsTo('App\Models\Designation');
    }
}
