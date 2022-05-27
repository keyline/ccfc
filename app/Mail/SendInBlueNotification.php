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
    public $theme;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $user)
    {
        $this->campaignId= $id;
        $this->user= $user;
        $this->theme= "custom";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $targetCampaign = EmailCampaign::findOrFail($this->campaignId);
            //echo '<pre>';print_r($targetCampaign);die;
            
            $this
            ->subject($targetCampaign->ec_title)
            ->view('admin.campaigns.notification')
            ->with('body', $targetCampaign->ec_body);

            // 'as' => 'MemberGuide.pdf',
            // 'mime' => 'application/pdf',
            $ec_type = $targetCampaign->ec_type;
            if ($ec_type == 'Notice and Circulars Emails') {
                $fromName       = 'Notice';
                $fromEmail      = 'notice@ccfc1792.com';
                $replyToName    = 'Secretary';
                $replyToEmail   = 'ccfcsecretary@ccfc1792.com';
            } else {
                $fromName       = 'Accounts';
                $fromEmail      = 'accounts@ccfc1792.com';
                $replyToName    = 'Accounts';
                $replyToEmail   = 'accounts@ccfc1792.com';
            }

            $this->from($fromEmail, $fromName);
            $this->replyTo($replyToEmail, $replyToName);

            
            if (isset($targetCampaign->ec_attachment) && Storage::disk('local')->exists($targetCampaign->ec_attachment)) {
                //get correct mime type
                $attachment1    = explode("campaign_attachments/", $targetCampaign->ec_attachment);
                $filename       = $attachment1[1];
                $fileTypeArr    = explode(".", $filename);
                $fileType       = $fileTypeArr[1];
                if ($fileType == 'jpg') {
                    $mime = 'application/image';
                } elseif ($fileType == 'png') {
                    $mime = 'application/image';
                } elseif ($fileType == 'gif') {
                    $mime = 'application/image';
                } elseif ($fileType == 'pdf') {
                    $mime = 'application/pdf';
                } elseif ($fileType == 'xls') {
                    $mime = 'application/vnd.ms-excel';
                } elseif ($fileType == 'xlsx') {
                    $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
                } elseif ($fileType == 'txt') {
                    $mime = 'text/plain';
                } elseif ($fileType == 'csv') {
                    $mime = 'text/csv';
                }

                $path = Storage::disk('local')->getAdapter()->getPathPrefix();
                $this->attach($path . $targetCampaign->ec_attachment, [
                         'as' => $filename,
                         'mime' => $mime,
                ]);
            }
            return $this;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
