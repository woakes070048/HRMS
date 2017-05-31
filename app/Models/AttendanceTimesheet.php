<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AttendanceTimesheet extends Model
{

    protected $fillable = ['user_id','date','observation','in_time','out_time','total_work_hour','leave_type'];


    public function setInTimeAttribute($value){
        return $this->attributes['in_time'] = date('h:i',strtotime($value));
    }


    public function setOutTimeAttribute($value){
        return $this->attributes['out_time'] = date('h:i',strtotime($value));
    }
    

    public function getInTimeAttribute($value){
    	return date('h:i A',strtotime($value));
    }


    public function getOutTimeAttribute($value){
    	return date('h:i A',strtotime($value));
    }


    public function get_attendance_timesheet($from_date, $to_date, $department_id=0, $timesheet_observation){
    	
    	if($timesheet_observation == 'present'){
	    	return $this->get_attendance_timesheet_present($from_date, $to_date, $department_id);
    	}

    	if($timesheet_observation == 'archive'){
	    	return $this->get_attendance_timesheet_archive($from_date, $to_date, $department_id);
    	}

        if($timesheet_observation == 'both'){
            return $this->get_attendance_timesheet_both($from_date, $to_date, $department_id);
        }
    }


    public function get_attendance_timesheet_present($from_date, $to_date, $department_id=0){
    	$attendance = User::select('users.*')->with(['attendanceTimesheet'=>function($q)use($from_date,$to_date){
	    				$q->whereBetween('date',[$from_date,$to_date]);
	    			}])->where('users.status','1');

		if($department_id !=0){
			$attendance->join('designations','designations.id','=','users.designation_id')
				->join('departments','departments.id','=','designations.department_id')
				->where('departments.id',$department_id);
		}

    	return $attendance->get();
    }


    public function get_attendance_timesheet_archive($from_date, $to_date, $department_id=0){
    	$attendance = User::select('users.*')->with(['attendanceTimesheetArchive'=>function($q)use($from_date,$to_date){
	    				$q->whereBetween('date',[$from_date,$to_date]);
	    			}])->where('users.status','1');

		if($department_id !=0){
			$attendance->join('designations','designations.id','=','users.designation_id')
				->join('departments','departments.id','=','designations.department_id')
				->where('departments.id',$department_id);
		}

    	return $attendance->get();
    }


    public function get_attendance_timesheet_both($from_date, $to_date, $department_id=0){

        // $attendance = User::select('users.*')->with(['attendanceTimesheet'=>function($q)use($from_date,$to_date){
        //                 $q->select('*',\DB::raw('"present" as timesheet_observation'))->whereBetween('date',[$from_date,$to_date]);
        //             }])->with(['attendanceTimesheetArchive'=>function($q)use($from_date,$to_date){
        //                 $q->select('*',\DB::raw('"archive" as timesheet_observation'))->whereBetween('date',[$from_date,$to_date]);
        //             }])->where('users.status','1');

        $attendance = User::select('users.*')->with(['attendanceTimesheet'=>function($q)use($from_date,$to_date){
                        $q->whereBetween('date',[$from_date,$to_date]);
                    }])->with(['attendanceTimesheetArchive'=>function($q)use($from_date,$to_date){
                        $q->whereBetween('date',[$from_date,$to_date]);
                    }])->where('users.status','1');

        if($department_id !=0){
            $attendance->join('designations','designations.id','=','users.designation_id')
                ->join('departments','departments.id','=','designations.department_id')
                ->where('departments.id',$department_id);
        }

        return $attendance->get();
    }


}
