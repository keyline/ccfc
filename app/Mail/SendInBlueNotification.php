<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\EmailCampaign;
use Illuminate\Support\Facades\File;

class SendInBlueNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $campaignId;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $user)
    {
        $this->campaignId= $id;
        $this->user= $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $targetCampaign= EmailCampaign::findOrFail($this->campaignId);

            $this
            ->subject($targetCampaign->ec_title)
            ->markdown('admin.campaigns.notification')
            ->with('body', $targetCampaign->ec_body);

            
            if (isset($targetCampaign->ec_attachment) && Storage::disk('local')->exists($targetCampaign->ec_attachment)) {
                $path = Storage::disk('local')->getAdapter()->getPathPrefix();
                $this->attach($path . $targetCampaign->ec_attachment, [
                         'as' => 'sample.pdf',
                         'mime' => 'application/pdf',
            ]);
            }
            return $this;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
