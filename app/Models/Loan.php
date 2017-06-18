<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_id','loan_type_id','loan_aganist','loan_start_date','loan_end_date','loan_duration','loan_duration','loan_amount','loan_deduct_amount','loan_status','loan_remarks','approved_by','created_by','updated_by'];


    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d');
    }


    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->format('Y-m-d');
    }


    public function getLoanDurationAttribute($value){
        if(stristr($value,'.')){
            $duration = explode('.', $value);
            $month = end($duration);

            if($month > 10){
                $month = str_replace('0','',$month);
            }
            if($duration[0] > 0){
                return $duration[0].' years, '.$month.' months.';
            }else{
                return $month.' months.';
            }
        }else{
            return $value.' years, 0 months.';
        }       
    }


    public static function cal_loan_duration($start, $end){
        $loan_start_date = Carbon::parse($start);
        $years = $loan_start_date->diffInYears(Carbon::parse($end));
        $months = $loan_start_date->diffInMonths(Carbon::parse($end));
        return $duration = $years.'.'.$months;
    }


 	public function user(){
    	return $this->belongsTo('App\Models\User');
    }


    public function loanType(){
    	return $this->belongsTo('App\Models\LoanType');
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
