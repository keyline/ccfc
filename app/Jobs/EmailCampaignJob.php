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
use Illuminate\Support\Facades\Redis;
use Mail;
use Log;

class EmailCampaignJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $campaignid;

    protected $user;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 20;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($campaignid, $user)
    {
        $this->campaignid= $campaignid;
        $this->user= $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //code...

        //send email operation
        try {
            //code...
            Mail::to($this->user->email, $this->user->name)->send(new SendInBlueNotification($this->campaignid, $this->user));
            //Mail::to("subhomoy@keylines.net", "Subhomoy Samanta")->send(new SendInBlueNotification($this->campaignid, $this->user));
        } catch (\Exception $ex) {
            //throw $th;
            //dd($ex);
        }
        //Mail::to("shuvadeep@keylines.net", $this->user->name)->send(new SendInBlueNotification($this->campaignid, $this->user));
    }
}
