<?php

namespace App\Http\Controllers\Leave;

use Auth;
use DB;
use App\Models\LeaveType;
use App\Models\Weekend;
use App\Models\Holiday;
use App\Models\User;
use App\Models\UserLeaveTypeMap;
use App\Models\EmployeeLeave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');
        $this->middleware('CheckPermissions', ['except' => ['changeStatus', 'getWeekendHolidays', 'view', 'details']]);

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }

    public function index(){

    	$data['title'] = "HRMS|Leave";
        $data['all_leave_types'] = LeaveType::where('leave_type_status', 1)->get();
        $data['leaves'] = EmployeeLeave::with('leaveType', 'userName.designation', 'responsibleUser', 'approvedByUser')->orderBy('employee_leave_status')->get();

    	return view('leave.leave', $data);
    }

    public function getWeekendHolidays($fromDate, $toDate){

        $weekendsData  = Weekend::orderBY('id', 'DESC')->first();
        $weekends_ary = explode(',', $weekendsData->weekend); 
        $weekends_ary = array_map('trim', $weekends_ary); // triming

        $fromDateAry = explode('-', $fromDate);

        //holiday calculation start
        $holidays_info = Holiday::whereBetween('holiday_from', ["$fromDateAry[0]-1-1", "$fromDateAry[0]-12-31"])->where('holiday_status', 1)->get();

        $holidayAry = [];

        foreach($holidays_info as $info){
            if($info->holiday_from == $info->holiday_to){
                $holiDays = date("l", strtotime($info->holiday_from));
                
                if(!in_array($holiDays, $weekends_ary)){
                    $holidayAry[] = $info->holiday_from;
                }
            }
            else{
                $day = 86400; 
                $format = 'Y-m-d'; 
                $sTime = strtotime($info->holiday_from);
                $eTime = strtotime($info->holiday_to); 
                $numDays = round(($eTime - $sTime) / $day) + 1;  
                $days = array();  

                for ($d = 0; $d < $numDays; $d++) {  
                    $days_value = date($format, ($sTime + ($d * $day)));
                    $holiDays = date("l", strtotime($days_value));
                    
                    if(!in_array($holiDays, $weekends_ary)){
                        $holidayAry[] = $days_value;
                    } 
                } 
            }
        }

        $applyAry = [];
        $count_weekend = 0;

        if($fromDate == $toDate){
            $applyAry[] = $fromDate;
        }
        else{
            $day = 86400;  
            $format = 'Y-m-d';  
            $sTime = strtotime($fromDate); 
            $eTime = strtotime($toDate); 
            $numDays = round(($eTime - $sTime) / $day) + 1;  
            $days = array();  

            for ($d = 0; $d < $numDays; $d++) {  
                $apply_days_value = date($format, ($sTime + ($d * $day)));
                $apply_holiDays = date("l", strtotime($apply_days_value));
                $applyAry[] = date($format, ($sTime + ($d * $day)));  
                
                if(in_array($apply_holiDays, $weekends_ary)){
                    $count_weekend++;
                }
            } 
        }

        $compare_apply_n_holiday = array_intersect($holidayAry, $applyAry);
        
        //holiday calculation finished

        $data['holidays'] = count($compare_apply_n_holiday);
        $data['weekend'] = $count_weekend;
        return $data;
    }

    public function userTakenLeave($id){

        $currentYear = date('Y');
        $data_map = UserLeaveTypeMap::with('leaveType')->where('user_id', $id)
                    ->where('active_from_year', '<=', $currentYear)
                    ->where('active_to_year', '>=', $currentYear)->where('status', 1)->get();

        $leave_amount_ary = [];   //leave total amount

        $sl = 0;
        foreach($data_map as $mapInfo){
            $leave_amount_ary[$sl]['id'] = $mapInfo->leave_type_id;
            $leave_amount_ary[$sl]['name'] = $mapInfo->leaveType->leave_type_name;
            $leave_amount_ary[$sl]['days'] = $mapInfo->number_of_days;
            $sl++;
        }

        $data_val = EmployeeLeave::with('leaveType')->where('user_id', $id)->whereIn('employee_leave_status', [1,2,3])->get();
        $leave_type_id_ary = [];
        $leave_type_name_ary = [];
        $leave_type_days_ary = [];
        $taken_leave_ary = [];

        //calculate which type leave taken how many days...
        foreach($data_val as $info){
            
            $diff_days = $info->employee_leave_total_days;

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

        $weekend_holiday_info = $this->getWeekendHolidays($from_date, $to_date);
        $leave_type_info = LeaveType::find($emp_leave_type);
        $chk_include_holiday = $leave_type_info->leave_type_include_holiday;

        $leave_type_ary = session()->get('global_leave_type_ary');

        $date1Timestamp = strtotime($from_date);
        $date2Timestamp = strtotime($to_date);
        $difference = $date2Timestamp - $date1Timestamp;
        $diff_days = floor($difference / (60*60*24) )+1;

        if($chk_include_holiday != 1){
            $diff_days = $diff_days - ($weekend_holiday_info['holidays'] + $weekend_holiday_info['weekend']);
        }

        //check half day or full day start
        if($leave_half_or_full == 2){
            //half day leave
            if($diff_days > 1){
                $data['title'] = 'error';
                $data['message'] = "* For half day leave applicable for only one day.";

                return $data;
            }else{
                $diff_days = 0.50;
            }
        }

        //half day full day end

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
                            $folder = "/leave_doc/$emp_name";

                            //storage/app/public
                            $file_name = $temp_name.".".$exten;

                            request()->file('file')->storeAs($folder, $file_name);
                        }
                        
                        try{
                            EmployeeLeave::create([
                                'user_id' => $emp_name,
                                'leave_type_id' => $emp_leave_type, 
                                'employee_leave_from' => $from_date, 
                                'employee_leave_to' => $to_date,
                                'employee_leave_total_days' => $diff_days,
                                'employee_leave_user_remarks' => $leave_reason,
                                'employee_leave_half_or_full' => $leave_half_or_full,
                                'employee_leave_contact_address' => $leave_contact_address,
                                'employee_leave_contact_number' => $leave_contact_number,
                                'employee_leave_passport_no' => $passport_no,
                                'employee_leave_responsible_person' => $responsible_emp,
                                'employee_leave_attachment' => $file_name,
                                'employee_leave_supervisor' => $supervisor_id,
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

        return $data;
    }

    public function edit($id){

        $value = EmployeeLeave::find($id); 
        $data['hdn_id'] = $id;
        $data['user_id'] = $value->user_id;
        $data['leave_type_id'] = $value->leave_type_id; 
        $data['employee_leave_from'] = $value->employee_leave_from; 
        $data['employee_leave_to'] = $value->employee_leave_to;
        $data['employee_leave_total_days'] = $value->employee_leave_total_days;
        $data['employee_leave_user_remarks'] = $value->employee_leave_user_remarks;
        $data['employee_leave_half_or_full'] = $value->employee_leave_half_or_full;
        $data['employee_leave_contact_address'] = $value->employee_leave_contact_address;
        $data['employee_leave_contact_number'] = $value->employee_leave_contact_number;
        $data['employee_leave_passport_no'] = $value->employee_leave_passport_no;
        $data['employee_leave_responsible_person'] = $value->employee_leave_responsible_person;
        $data['employee_leave_attachment'] = $value->employee_leave_attachment;
        $data['employee_leave_supervisor'] = $value->employee_leave_supervisor;
        $data['employee_leave_status'] = $value->employee_leave_status;
        $data['employee_leave_recommend_to'] = $value->employee_leave_recommend_to;

        $currentYear = date('Y');
        $data_map = UserLeaveTypeMap::with('leaveType')->where('user_id', $value->user_id)
                    ->where('active_from_year', '<=', $currentYear)
                    ->where('active_to_year', '>=', $currentYear)->where('status', 1)->get();

        $leave_amount_ary = [];   //leave total amount

        $sl = 0;
        foreach($data_map as $mapInfo){
            $leave_amount_ary[$sl]['id'] = $mapInfo->leave_type_id;
            $leave_amount_ary[$sl]['name'] = $mapInfo->leaveType->leave_type_name;
            $leave_amount_ary[$sl]['days'] = $mapInfo->number_of_days;
            $sl++;
        }

        $data_val = EmployeeLeave::with('leaveType')->where('user_id', $value->user_id)->whereIn('employee_leave_status', [1,2,3])->get();
        $leave_type_id_ary = [];
        $leave_type_name_ary = [];
        $leave_type_days_ary = [];
        $taken_leave_ary = [];

        //calculate which type leave taken how many days...
        foreach($data_val as $info){
            
            $diff_days = $info->employee_leave_total_days;

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

        //only for edit ... start
        $sl = 0;
        foreach($leave_type_ary as $eInfo){
            
            if($eInfo['id'] == $data['leave_type_id']){
                break;
            }else{
                $sl++;  
            }
        }    

            //add old total days with this
        $leave_type_ary[$sl]['days'] = $leave_type_ary[$sl]['days'] + $data['employee_leave_total_days'];
        
        //only for edit ... end

        $data['userHaveLeavs'] = $data_map;
        $data['taken_leave_type_id'] = $leave_type_id_ary;
        $data['taken_leave_type_name'] = $leave_type_name_ary;
        $data['taken_leave_type_days'] = $leave_type_days_ary;
        $data['taken_leave_ary'] = $taken_leave_ary; //leave taken
        $data['user_leave_type'] = $leave_type_ary; //leave remain
        $data['show_history'] = $leave_amount_taken_combination;

        session()->put('global_leave_type_ary', $leave_type_ary);

        return $data;
        // return response()->json($data);
    }

    public function details($emp_no=null){

        if(!empty($emp_no)){
            $user_val = User::where('employee_no', $emp_no)->first();
            $user_id = $user_val->id;
        }else{
            $user_id = Auth::user()->id;
        }

        $data['title'] = "HRMS|Leave Details";
        $data['user_id'] = $user_id;
        $data['all_leave_types'] = LeaveType::where('leave_type_status', 1)->get();
        $data['leaves'] = EmployeeLeave::where('user_id', $user_id)->with('leaveType', 'userName.designation', 'responsibleUser', 'approvedByUser')->orderBy('employee_leave_status')->get();
        $data['forwards'] = EmployeeLeave::where('employee_leave_recommend_to', $user_id)->with('leaveType', 'userName.designation', 'responsibleUser', 'approvedByUser')->orderBy('employee_leave_status')->get();

        return view('leave.details', $data);
    }

    public function update(Request $request){

        $date = new \DateTime(null, new \DateTimeZone('Asia/Dhaka'));
        $current_date = $date->format('Y-m-d'); 

        $this->validate($request, [
            'hdn_id' => 'required',
            'edit_leave_type_id' => 'required',
            'edit_from_date' => 'required',
            'edit_to_date' => 'required',
            'edit_leave_reason' => 'required',
            'edit_leave_contact_address' => 'required',
            'want_to_forward' => 'nullable',
            'edit_forward_to' => 'required_if:want_to_forward,1',
            'edit_leave_half_or_full' => 'required',
        ],[
            'edit_leave_type_id.required' => 'Leave type is required.',
            'edit_from_date.required' => 'Select date(from date) is required.',
            'edit_to_date.required' => 'Select date(to date) is required.',
            'edit_leave_reason.required' => 'Leave reason field is required.',
            'edit_leave_contact_address.required' => 'Contract address is required.',
            'edit_leave_half_or_full.required' => 'Leave status required.',
            'edit_forward_to.required_if' => 'Select employee for forward.',
        ]);

        $emp_leave_type = $request->edit_leave_type_id;
        $from_date = $request->edit_from_date;
        $to_date = $request->edit_to_date;
        $leave_reason = $request->edit_leave_reason;
        $leave_contact_address = $request->edit_leave_contact_address;
        $leave_contact_number = $request->edit_leave_contact_number;
        $passport_no = $request->edit_passport_no;
        $responsible_emp = $request->edit_responsible_emp;
        $leave_half_or_full = $request->edit_leave_half_or_full;

        if($request->want_to_forward > 0){
            $forward_to = $request->edit_forward_to;
        }
        else{
            $forward_to = '';
        }

        //check .... 
        $weekend_holiday_info = $this->getWeekendHolidays($from_date, $to_date);
        $leave_type_info = LeaveType::find($emp_leave_type);
        $chk_include_holiday = $leave_type_info->leave_type_include_holiday;

        $leave_type_ary = session()->get('global_leave_type_ary');

        $date1Timestamp = strtotime($from_date);
        $date2Timestamp = strtotime($to_date);
        $difference = $date2Timestamp - $date1Timestamp;
        $diff_days = floor($difference / (60*60*24) )+1;

        if($chk_include_holiday != 1){
            $diff_days = $diff_days - ($weekend_holiday_info['holidays'] + $weekend_holiday_info['weekend']);
        }

        //check half day or full day start
        if($leave_half_or_full == 2){
            //half day leave
            if($diff_days > 1){
                $data['title'] = 'error';
                $data['message'] = "* For half day leave applicable for only one day.";

                return $data;
            }else{
                $diff_days = 0.50;
            }
        }

        //half day full day end

        if($date2Timestamp >= $date1Timestamp){
            foreach($leave_type_ary as $info){
                if($emp_leave_type == $info['id']){
                    $chk = $info['days'] - $diff_days;

                    if($chk >= 0){

                        $file_name = '';
                        if(request()->hasFile('file')){
            
                            //delete old file
                            $oldFileInfo = EmployeeLeave::find($request->hdn_id);

                            $file = request()->file('file');
                            $exten = $file->extension();
                            $temp_name = date("Ymd_His");
                            $folder = "/leave_doc/$oldFileInfo->user_id";

                            //storage/app/public
                            $file_name = $temp_name.".".$exten;
                            request()->file('file')->storeAs($folder, $file_name);
                            
                            if(!empty($oldFileInfo->employee_leave_attachment)){
                                $old_file_folder = "/leave_doc/".$oldFileInfo->user_id."/".$oldFileInfo->employee_leave_attachment;
                                if(Storage::exists($old_file_folder)){
                                    Storage::delete($old_file_folder);
                                }
                            }
                        }
                        
                        try{
                            $update_ary = [
                                'leave_type_id' => $emp_leave_type, 
                                'employee_leave_from' => $from_date, 
                                'employee_leave_to' => $to_date,
                                'employee_leave_total_days' => $diff_days,
                                'employee_leave_user_remarks' => $leave_reason,
                                'employee_leave_half_or_full' => $leave_half_or_full,
                                'employee_leave_contact_address' => $leave_contact_address,
                                'employee_leave_contact_number' => $leave_contact_number,
                                'employee_leave_passport_no' => $passport_no,
                                'employee_leave_responsible_person' => $responsible_emp,
                                'employee_leave_attachment' => $file_name,
                            ];
                             if(!empty($forward_to)){
                                $update_ary['employee_leave_recommend_to'] = $forward_to;
                                $update_ary['employee_leave_status'] = 2;
                            }

                            EmployeeLeave::where('id',$request->hdn_id)->update($update_ary);
                        
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
        //end check


        return response()->json($data);
    }

    public function changeStatus($id, $stat){

        $date = new \DateTime(null, new \DateTimeZone('Asia/Dhaka'));

        $val = EmployeeLeave::find($id);
        $val->employee_leave_status = $stat;
        $val->employee_leave_approved_by = Auth::user()->id; 
        //approval_date use for only both Approve or Cancel
        $val->employee_leaves_approval_date = $date->format('Y-m-d'); 
        $val->save();
    }

    // public function showIndiReport($id){

    //     $data['title'] = "Leave|Individual Report";
    //     $data['info'] = EmployeeLeave::with('leaveType', 'userName.designation.department', 'responsibleUser.designation.department', 'approvedByUser.designation.department', 'supervisorUser.designation.department', 'forwardUser.designation.department')->find($id);

    //     return view('leave.showIndiReport', $data);
    // }
}
