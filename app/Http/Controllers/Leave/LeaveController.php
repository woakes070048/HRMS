<?php

namespace App\Http\Controllers\Leave;

use Auth;
use DB;
use App\Models\LeaveType;
use App\Models\Weekend;
use App\Models\User;
use App\Models\UserLeaveTypeMap;
use App\Models\EmployeeLeave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');
        // $this->middleware('CheckPermissions');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }

    public function index(){

    	// $data['title'] = "HRMS|Leave";
     //    $data['all_leave_types'] = LeaveType::where('leave_type_status', 1)->get();
    	// return view('leave.leave', $data);


        // $mydate = '2016-01-01';
        // echo date('l', strtotime('2016-01-01'))."<br/>";
        // echo date('l', strtotime('2016-01-02'))."<br/>";
        // echo date('l', strtotime('2016-01-03'))."<br/>";
        // echo date('l', strtotime('2016-01-04'))."<br/>";
        // echo date('l', strtotime('2016-01-05'))."<br/>";
        // echo date('l', strtotime('2016-01-06'))."<br/>";
        // echo date('l', strtotime('2016-01-07'))."<br/>";

        $all_weekends = Weekend::orderBY('id', 'DESC')->first();

        $weekends_ary = explode(',', $all_weekends->weekend); 
        $weekends_ary = array_map('trim', $weekends_ary); // triming

        

        $date1 = '28/05/2017';
        $date2 = '2/07/2017';

        function returnDates($fromdate, $todate) {
            $fromdate = \DateTime::createFromFormat('d/m/Y', $fromdate);
            $todate = \DateTime::createFromFormat('d/m/Y', $todate);
            return new \DatePeriod(
                $fromdate,
                new \DateInterval('P1D'),
                $todate->modify('+1 day')
            );
        }

        $datePeriod = returnDates($date1, $date2);
        foreach($datePeriod as $date) {
            $dattt = date('l', strtotime($date->format('d-m-Y')));
            echo $date->format('d-m-Y')."--".$dattt;

            if(in_array($dattt, $weekends_ary)){
                echo "---- Weekend ---";
            }

            echo "<br>";
        }

    }

    public function userTakenLeave($id){

        $data_map = UserLeaveTypeMap::with('leaveType')->where('user_id', $id)->where('status', 1)->get();

        $leave_amount_ary = [];   //leave total amount

        $sl = 0;
        foreach($data_map as $mapInfo){
            $leave_amount_ary[$sl]['id'] = $mapInfo->leave_type_id;
            $leave_amount_ary[$sl]['name'] = $mapInfo->leaveType->leave_type_name;
            $leave_amount_ary[$sl]['days'] = $mapInfo->number_of_days;
            $sl++;
        }

        $data_val = EmployeeLeave::with('leaveType')->where('user_id', $id)->where('employee_leave_status', 2)->get();
        $leave_type_id_ary = [];
        $leave_type_name_ary = [];
        $leave_type_days_ary = [];
        $taken_leave_ary = [];

        //calculate which type leave taken how many days...
        foreach($data_val as $info){
            $date1 = $info->employee_leave_from;
            $date2 = $info->employee_leave_to;
            $date1Timestamp = strtotime($date1);
            $date2Timestamp = strtotime($date2);
            $difference = $date2Timestamp - $date1Timestamp;
            $diff_days = floor($difference / (60*60*24) )+1;

            if(!in_array($info->leave_type_id, $leave_type_id_ary)){
                $leave_type_id_ary[] = $info->leave_type_id;
                $leave_type_name_ary[] = $info->leaveType->leave_type_name;
                $leave_type_days_ary[] = $diff_days;
            }
            else{
                $location = array_search($info->leave_type_id, $leave_type_id_ary);
                $old_days = $leave_type_days_ary[$location];
                $leave_type_days_ary[$location] = $diff_days + $old_days;
            }
        }

        if(count($leave_type_id_ary) > 0){
            for($i=0 ; $i<count($leave_type_id_ary) ; $i++){
                $taken_leave_ary[$i]['id'] = $leave_type_id_ary[$i];
                $taken_leave_ary[$i]['name'] = $leave_type_name_ary[$i];
                $taken_leave_ary[$i]['days'] = $leave_type_days_ary[$i];
            }
        }

        //combined leave amount and taken leave to show leave history
        $leave_amount_taken_combination = [];
        $sl = 0;
        foreach($leave_amount_ary as $info){
            $leave_amount_taken_combination[$sl]['id'] = $info['id'];
            $leave_amount_taken_combination[$sl]['name'] = $info['name'];
            $leave_amount_taken_combination[$sl]['amount_days'] = $info['days'];
            
            if(in_array($info['id'], $leave_type_id_ary)){
                $locId = array_search($info['id'], $leave_type_id_ary);
                $leave_amount_taken_combination[$sl]['taken_days'] = $taken_leave_ary[$locId]['days'];
            }
            else{
                $leave_amount_taken_combination[$sl]['taken_days'] = 0;
            }

            $sl++;
        }

        //calculate remain leave to show leave type
        $leave_type_ary = [];
        $aryIndex = 0;
        foreach($leave_amount_ary as $amountInfo){

            if(in_array($amountInfo['id'], $leave_type_id_ary)){
                //find leave taken days using id from taken leave ary days
                $indexId = array_search($amountInfo['id'], $leave_type_id_ary);
                $leave_type_ary[$aryIndex]['id'] =  $amountInfo['id'];
                $leave_type_ary[$aryIndex]['name'] =  $leave_type_name_ary[$indexId];
                $leave_type_ary[$aryIndex]['days'] =  $amountInfo['days']-$leave_type_days_ary[$indexId];
            }
            else{
                $leave_type_ary[$aryIndex]['id'] =  $amountInfo['id'];
                $leave_type_ary[$aryIndex]['name'] =  $amountInfo['name'];
                $leave_type_ary[$aryIndex]['days'] =  $amountInfo['days'];
            }

            $aryIndex++;
        }
        
        $data['userHaveLeavs'] = $data_map;
        $data['taken_leave_type_id'] = $leave_type_id_ary;
        $data['taken_leave_type_name'] = $leave_type_name_ary;
        $data['taken_leave_type_days'] = $leave_type_days_ary;
        $data['taken_leave_ary'] = $taken_leave_ary; //leave taken
        $data['user_leave_type'] = $leave_type_ary; //leave remain
        $data['show_history'] = $leave_amount_taken_combination;

        session()->put('global_leave_type_ary', $leave_type_ary);

        return $data;
    }

    public function create(Request $request){

        $this->validate($request, [
            'emp_name' => 'required',
            'emp_leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'leave_reason' => 'required',
            'leave_contact_address' => 'required',
            'leave_half_or_full' => 'required',
        ],[
            'emp_name.required' => 'Employee name is required.',
            'emp_leave_type.required' => 'Leave type is required.',
            'from_date.required' => 'Select date(from date) is required.',
            'to_date.required' => 'Select date(to date) is required.',
            'leave_contact_address.required' => 'Contract address is required.',
            'leave_half_or_full.required' => 'Leave status required.',
        ]);

        $emp_name = $request->emp_name;
        $emp_leave_type = $request->emp_leave_type;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $leave_reason = $request->leave_reason;
        $leave_contact_address = $request->leave_contact_address;
        $leave_contact_number = $request->leave_contact_number;
        $passport_no = $request->passport_no;
        $responsible_emp = $request->responsible_emp;
        $leave_half_or_full = $request->leave_half_or_full;

        $leave_type_ary = session()->get('global_leave_type_ary');

        $date1Timestamp = strtotime($from_date);
        $date2Timestamp = strtotime($to_date);
        $difference = $date2Timestamp - $date1Timestamp;
        $diff_days = floor($difference / (60*60*24) )+1;

        if($date2Timestamp >= $date1Timestamp){
            foreach($leave_type_ary as $info){
                if($emp_leave_type == $info['id']){
                    $chk = $info['days'] - $diff_days;

                    if($chk >= 0){
                        
                        $supervisor_id = User::find($emp_name)->supervisor_id;

                        $file_name = '';
                        if(request()->hasFile('file')){
            
                            $file = request()->file('file');
                            $exten = $file->extension();
                            $temp_name = date("Ymd_His");
                            $folder = $emp_name;
                            $file_name = $temp_name.".".$exten;

                            request()->file('file')->storeAs($folder, $file_name);
                        }
                        
                        try{
                            EmployeeLeave::create([
                                'user_id' => $emp_name,
                                'leave_type_id' => $emp_leave_type, 
                                'employee_leave_from' => $from_date, 
                                'employee_leave_to' => $to_date,
                                'employee_leave_user_remarks' => $leave_reason,
                                'employee_leave_half_or_full' => $leave_half_or_full,
                                'employee_leave_contact_address' => $leave_contact_address,
                                'employee_leave_contact_number' => $leave_contact_number,
                                'employee_leave_passport_no' => $passport_no,
                                'employee_leave_responsible_person' => $responsible_emp,
                                'employee_leave_attachment' => $file_name,
                                'employee_leave_recommend_to' => $supervisor_id,
                                'employee_leave_status' => 1,
                            ]);
                        
                            $data['title'] = 'success';
                            $data['message'] = 'data successfully added!';

                        }catch (\Exception $e) {
                            
                           $data['title'] = 'error';
                           $data['message'] = 'data not added!';
                        }
                    }
                    else{
                        $data['title'] = 'error';
                        $data['message'] = "* You can only apply for ".$info['days']." days or below ".$info['days']." days leave.";
                    }
                }
            }
        }
        else{
            $data['title'] = 'error';
            $data['message'] = "* Invalid date entry.";
        }

        // $request->session()->forget('global_leave_type_ary');
        return $data;
    }
}
