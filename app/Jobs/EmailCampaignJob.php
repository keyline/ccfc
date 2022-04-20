<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendInBlueNotification;
use App\Models\User;
use Mail;

class EmailCampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaignid;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($campaignid)
    {
        $this->campaignid= $campaignid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //fetch user list with email not empty
        $query= \App\Models\User::query();
        $query->where('email', '!=', '');
        $query->where('id', '<>', 1);
        $users= $query->limit(100)->get();
        //code...
        foreach ($users as $user) {
            //send email operation
            Mail::to($user->email, $user->name)->send(new SendInBlueNotification($this->campaignid, $user));
        }
    }
}
