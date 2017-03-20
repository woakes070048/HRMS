<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserEmailUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $requestData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($requestData)
    {
        $this->requestData = $requestData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(User $user)
    {

        if(Session('sisterConcern')){
            $sisterConcern = Session('sisterConcern');
            // dd($this->requestData);
            // dd($sisterConcern);
            foreach($sisterConcern as $sinfo){
                Artisan::call("db:connect", ['database' => $sinfo['database_name']]);
                // $check_user_exists = User::where('email',$this->requestData->old_email)->first();
                $user->where('email',$this->requestData['old_email'])
                                        ->update(['email' => $this->requestData['email']]);
            }
        }


        if(Session('motherConcern')){
            $motherConcern = Session('motherConcern');
            // dd($this->requestData);
            // dd($sisterConcern);
            // dd($this->requestData->old_email);
            foreach($motherConcern as $minfo){
                Artisan::call("db:connect", ['database' => $minfo['database_name']]);
                // $check_user_exists = User::where('email',$this->requestData->old_email)->first();
                $user->where('email',$this->requestData['old_email'])->update(['email' => $this->requestData['email']]);
            }
        }


    }



}
