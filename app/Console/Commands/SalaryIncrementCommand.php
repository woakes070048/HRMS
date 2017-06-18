<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Increment;
use Illuminate\Console\Command;

class SalaryIncrementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment basic salary by effective date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $toDate = Carbon::now()->format('Y-m-d');

        \Config::set('database.connections.mysql_hrms.strict',false);
        \Artisan::call("db:connect", ['database' => '1489485338_afc_health']);

        $increments = Increment::select('increments.id','user_id', \DB::raw('(SUM(increment_amount) + basic_salary) as total_increments'))
                        ->where('approved_by','!=',0)
                        ->where('increment_status',0)
                        ->where('increment_effective_date',$toDate)
                        ->join('users','users.id','=','increments.user_id')
                        ->groupBy('user_id')
                        ->get();
        // dd($increments);
        // \Config::set('database.connections.mysql_hrms.strict',true);
        // \Artisan::call("db:connect", ['database' => '1489485338_afc_health']);

        $increments_id = [];
        foreach($increments as $info){  
            $increments_id[] = $info->id; 
            $updateData = ['basic_salary' => $info->total_increments];
            User::where('id',$info->user_id)->update($updateData);
        }
        Increment::whereIn('id',$increments_id)->update(['increment_status'=>1]);
       
    }




}
