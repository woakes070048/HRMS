<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id','loan_type_id','loan_aganist','loan_start_date','loan_end_date','loan_duration','loan_duration','loan_amount','loan_deduct_amount','loan_status','loan_remarks','approved_by','created_by','updated_by'];


 	public function user(){
    	return $this->belongsTo('App\Models\User');
    }


    public function loanType(){
    	return $this->belongsTo('App\Models\BonusType');
    }


    public function approvedBy(){
    	return $this->belongsTo('App\Models\User','approved_by','id');
    }


    public function createdBy(){
    	return $this->belongsTo('App\Models\User','created_by','id');
    }


    public function updatedBy(){
    	return $this->belongsTo('App\Models\User','updated_by','id');
    }

    
}
