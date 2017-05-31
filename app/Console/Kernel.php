<?php

namespace App\Console;

use App\Console\Commands\ServiceCommand;
use App\Console\Commands\SalaryIncrementCommand;
use App\Console\Commands\AttendanceTimesheetCommand;
use App\Console\Commands\ArchiveAttendanceTimesheetCommand;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ServiceCommand::class,
        SalaryIncrementCommand::class,
        AttendanceTimesheetCommand::class,
        ArchiveAttendanceTimesheetCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        // \Config::set('database.connections.mysql_hrms.strict',false);
        // \Artisan::call("db:connect", ['database' => '1489485338_afc_health']);
        // $schedule->command('attendance:timesheet')->cron('* * * * * *');
        // $schedule->command('attendance:archive')->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
