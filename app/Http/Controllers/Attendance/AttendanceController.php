<?php

namespace App\Http\Controllers\Attendance;

use App\Models\User;
use App\Models\AttendanceTimesheet;
use App\Models\AttendanceTimesheetArchive;
use App\Models\WorkShiftEmployeeMap;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    protected $auth;

    protected $attendanceTimesheet;

    /**
     * AttendanceController constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth,AttendanceTimesheet $attendanceTimesheet)
    {
        $this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });

        $this->attendanceTimesheet = $attendanceTimesheet;
    }


    public function index(){
    	$data['sidevar_hide'] = true;
    	return view('attendance.attendance')->with($data);
    }


    public function addAttendance(Request $request){
    	$this->validate($request,[
            'date' => 'required',
            'in_time' => 'required',
            'out_time' => 'required',
        ]);

        $total_work_hour = date('H.i',strtotime($request->out_time) - strtotime($request->in_time));
        $request->offsetSet('total_work_hour',$total_work_hour);

        try{
            $observation = $this->attendanceObservation($request->date);

            if($observation == 'present'){

                if($attend = AttendanceTimesheet::find($request->time_sheet_id)){
                    $attendance = $attend->update($request->all());
                }else{
                    $attendance = AttendanceTimesheet::create($request->all());
                }
            }

            if($observation == 'archive'){

                if($attend = AttendanceTimesheetArchive::find($request->time_sheet_id)){
                    $attendance = $attend->update($request->all());
                }else{
                    $attendance = AttendanceTimesheetArchive::create($request->all());
                }
            }

            if($request->ajax()){
                $data['data'] = $attendance;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['title'] = 'Success!';
                $data['message'] = 'Attendance Added!';
                return response()->json($data,200);
            }

            $request->session()->flash('danger','Attendance Added!');

        }catch(\Exception $e){
            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['title'] = 'Error!';
                $data['message'] = 'Attendance Not Added.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Attendance Not Added!');
        }

        return redirect()->back()->withInput();
    }


    protected function attendanceObservation($date){

        $last_row = $this->attendanceTimesheet->orderBy('date','asc')->first();
        $last_date = date('Y-m-d',strtotime($last_row->date));

        if($date >= $last_date){
            return 'present';
        }elseif($date < $last_date){
            return 'archive';
        }
    }


    public function attendanceTimesheet(Request $request){

    	$this->validate($request,[
			'from_date' => 'required',
			'to_date' => 'required',
		]);

    	$from_date = $request->from_date;
    	$to_date = $request->to_date;
    	$department_id = $request->department_id;

        $timesheet_observation = $this->timesheetObservation($from_date, $to_date);
		$attendance = $this->attendanceTimesheet->get_attendance_timesheet($from_date, $to_date, $department_id, $timesheet_observation);
		$dateData = $this->generateDays($from_date, $to_date);

    	$attendances = ['days' => $dateData['dates'], 'dayList'=> $dateData['date_list'], 'attendance' => $attendance];

    	$attendanceTimesheet = $this->generateAttendanceTimesheet($attendances, $timesheet_observation);
    	return $attendanceTimesheet;
    }


    protected function timesheetObservation($from_date, $to_date){

        $last_row = $this->attendanceTimesheet->orderBy('date','asc')->first();
        $last_date = date('Y-m-d',strtotime($last_row->date));

        if($from_date >= $last_date){
            return 'present';
        }elseif(($from_date < $last_date) && ($to_date < $last_date)){
            return 'archive';
        }else{
            return 'both';
        }
    }


    protected function generateDays($from_date, $to_date){

    	$toDate = Carbon::parse($to_date);
    	$day =  $toDate->diffInDays(Carbon::parse($from_date));

    	$dates = [];
    	$dateList = [];
    	for($i=0; $i<=$day; $i++){
    		$dates[] = Carbon::parse($from_date)->format('M d Y');
    		$dateList[] = Carbon::parse($from_date)->format('Y-m-d');
    		$from_date = Carbon::parse($from_date)->addDay(1);
    	}

    	$dateData = ['dates' => $dates, 'date_list' => $dateList];
    	return $dateData;
    }


    protected function generateAttendanceTimesheet($attendances, $timesheet_observation){
      // dd($attendances['attendance']);
    	foreach($attendances['attendance'] as $attendanceUser){

    		$timeSheet = [];

            if($timesheet_observation == 'present'){
                $attendanceTimesheet = $attendanceUser->attendanceTimesheet->toArray();
            }elseif($timesheet_observation == 'archive'){
                $attendanceTimesheet = $attendanceUser->attendanceTimesheetArchive->toArray();
            }else{
                $attendanceTimesheet = array_merge($attendanceUser->attendanceTimesheet->toArray(),$attendanceUser->attendanceTimesheetArchive->toArray());
            }
    		

    		foreach($attendances['dayList'] as $date){
    			$ck = 0;

    			if(count($attendanceTimesheet)>0){
	    			foreach($attendanceTimesheet as $key => $attendance){
		    			if($attendance['date'] == $date){
		    				$ck = 1;
		    				$timeSheet[] = $attendance;
		    				unset($attendanceTimesheet[$key]);
		    			}
		    		}
		    	}

		    	if($ck==0){
		    		$attend = new \stdClass;
    				$attend->id = 0;
    				$attend->user_id = $attendanceUser->id;
    				$attend->date = $date;
    				$attend->observation = 0;
    				$attend->in_time = null;
    				$attend->out_time = null;
    				$attend->leave_type = null;
    				$attend->created_at = $date;
    				$timeSheet[] = $attend;
		    	}
    		}
    		
            $attendanceUser->attendanceTimesheets = $timeSheet;
    		unset($attendanceUser['attendanceTimesheet']);
    	}

    	return $attendances;
    }



}
