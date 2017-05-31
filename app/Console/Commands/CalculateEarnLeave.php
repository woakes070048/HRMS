<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateEarnLeave extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:earnLeave';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Eanr Leave Values';

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
        DB::table('leave_types')->where('id', 4)->update(['leave_type_details' => 'jsdlkslfjls sdlfjsl flsd00']);
        $this->info('Delete All Inactive User');
    }
}
