<?php

namespace App\Console\Commands;

use App\Jobs\ArchiveAttendanceTimesheetJob;
use Illuminate\Console\Command;

class ArchiveAttendanceTimesheetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archive attendance timesheet';

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
        dispatch(new ArchiveAttendanceTimesheetJob());
    }
}
