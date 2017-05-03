<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Attendance;
use App\Models\AttendanceTimesheet;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AttendanceTimesheetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $calculateMonth;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->calculateMonth = \Config::get('hrms.attendance_calculate_month');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to_date = Carbon::now()->format('Y-m-d');
        $end_date = $to_date;
        $start_date = Carbon::now()->subMonths($this->calculateMonth)->format('Y-m-d');
        $attendance  = $this->attendance($start_date, $end_date);

        $attendance = collect($attendance);
        $today_leaves = $attendance->where('observation',2)->where('date', $to_date)->all();
        $prev_leaves = $attendance->where('observation',2)->where('date','!=', $to_date)->all();
        $today_attendance = $attendance->where('date', $to_date)->all();
        $userIds = collect($today_attendance)->pluck('user_id')->toArray();
        AttendanceTimesheet::where('date',$to_date)->whereIn('user_id',$userIds)->delete();
        // dd($today_leaves);
        // dd($all_leaves);
        if(count($today_attendance) > 0)
            AttendanceTimesheet::insert($today_attendance);
        if(count($today_leaves) > 0)
            AttendanceTimesheet::insert($today_leaves);
        
        foreach ($prev_leaves as $info) {
            AttendanceTimesheet::where('user_id',$info['user_id'])->where('date',$info['date'])->update($info);
        }
    }


    protected function attendance($start_date, $end_date)
    {
        
        $days = $this->generateDays($start_date, $end_date);
        // dd($days);

        $users = User::with([
            'attendance' => function($q)use($start_date, $end_date){$q->whereBetween('date',[$start_date, $end_date]);},
            'leaves.leaveType',
            'leaves' => function($q){$q->where('employee_leave_status',1);},
            'workShifts' => function($q)use($start_date, $end_date){
                $q->where(function($qu)use($start_date, $end_date){
                    $qu->whereBetween('start_date',[$start_date, $end_date]);
                })->orWhere(function($qu)use($start_date, $end_date){
                    $qu->whereBetween('end_date',[$start_date, $end_date]);
                })->where('status',1);
            }])->get();
        // dd($users);

        $get_holidays = DB::table('holidays')->where('holiday_status',1)->get();
        $holidays = $this->generateHoliday($get_holidays);
        // dd($holidays);

        $attendanceResult = [];

        foreach ($users as $user) {
            $attendance_array = $user->attendance->pluck('date')->toArray();
            $attendance_list = $user->attendance;
            $leaves = $this->generateLeaves($user->leaves);
            $weekends = $this->generateWeekend($user->workShifts);
            // dd($attendance_list);
            // print_r($weekends);

            foreach($days as $key => $day){
                $leave_type = '';
                
                if(!in_array($day, $attendance_array)){
                    if(array_key_exists($day, $leaves)){
                        $observation = 2;
                        $leave_type = $leaves[$day];
                    }elseif(in_array($day,$holidays)){
                        $observation = 3;
                    }elseif(in_array($day, $weekends)){
                        $observation = 4;
                    }else{
                        $observation = 0;
                    }

                    $attendanceResult[] = [
                        'user_id' => $user->id,
                        'date' => $day,
                        'observation' => $observation,
                        'in_time' => Null,
                        'out_time' => Null,
                        'total_work_hour' => Null,
                        'late_count_time' => Null,
                        'late_hour' => Null,
                        'leave_type' => $leave_type
                    ];

                }else{
                    if(in_array($day, $holidays)){
                        $observation = 5;
                    }elseif(in_array($day,$weekends)){
                        $observation = 6;
                    }else{
                        $observation = 1;
                    }

                    $attendance = $attendance_list->where('date',$day)->first();
                    $attendanceResult[] = [
                        // 'id' => $attendance->id,
                        'user_id' => $attendance->user_id,
                        'date' => $attendance->date,
                        'observation' => $observation,
                        'in_time' => date('H:i',strtotime($attendance->in_time)),
                        'out_time' => date('H:i',strtotime($attendance->out_time)),
                        'total_work_hour' => $attendance->total_work_hour,
                        'late_count_time' => date('H:i',strtotime($attendance->late_count_time)),
                        'late_hour' => $attendance->late_hour,
                        'leave_type' => $leave_type
                    ];
                }
            }
        // print_r($attendanceResult);
        // dd($attendanceResult);
        }

        return $attendanceResult;
    }


    protected function generateDays($from_date, $to_date){

        $toDate = Carbon::parse($to_date);
        $day =  $toDate->diffInDays(Carbon::parse($from_date));

        $dates = [];
        for($i=0; $i<=$day; $i++){
            $dates[] = Carbon::parse($from_date)->format('Y-m-d');
            $from_date = Carbon::parse($from_date)->addDay(1);
        }
        return $dates;
    }


    protected function generateLeaveDays($from_date, $to_date, $leave_type){

        $toDate = Carbon::parse($to_date);
        $day =  $toDate->diffInDays(Carbon::parse($from_date));

        $dates = [];
        for($i=0; $i<=$day; $i++){
            $date = Carbon::parse($from_date)->format('Y-m-d');
            $dates[$date] = $leave_type;
            $from_date = Carbon::parse($from_date)->addDay(1);
        }
        return $dates;
    }


    protected function generateLeaves($leaves){
        // dd($leaves);
        $days = [];
        foreach($leaves as $leave){
            $leaveType = $leave->leaveType->leave_type_name;
            $day = $this->generateLeaveDays($leave->employee_leave_from, $leave->employee_leave_to, $leaveType);
            $days = array_merge($days,$day);
        }
        // dd($days);
        return $days;
    }


    protected function generateHoliday($holidays){
        $days = [];
        foreach($holidays as $holiday){
            $day = $this->generateDays($holiday->employee_leave_from, $holiday->employee_leave_to);
            $days = array_merge($days,$day);
        }
        // dd($days);
        return $days;
    }


    protected function generateWeekend($workShifts){
        $days = [];
        foreach($workShifts as $workShift){
            $dates = $this->generateDays($workShift->start_date, $workShift->end_date);
            $day = $this->calculateWeekend($dates, $workShift->work_days);
            $days = array_merge($days,$day);
        }
        // dd($days);
        return $days;
    }


    protected function calculateWeekend($dates, $days){
        $days = explode(',', $days);
        $weekends = [];

        foreach($dates as $date){
            $day = date('D',strtotime($date));

            if($day == 'Sat'){
                $day_num = 1;
            }elseif($day == 'Sun'){
                $day_num = 2;
            }elseif($day == 'Mon'){
                $day_num = 3;
            }elseif($day == 'Tue'){
                $day_num = 4;
            }elseif($day == 'Wed'){
                $day_num = 5;
            }elseif($day == 'Thu'){
                $day_num = 6;
            }elseif($day == 'Fri'){
                $day_num = 7;
            }

            if(!in_array($day_num,$days)){
                $weekends[] = $date;
            }
        }

        return $weekends;
    }



}
