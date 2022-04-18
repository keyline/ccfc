<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    use HasFactory;

    protected $table= "email_campaigns";

    protected $fillable = ['ec_title', 'ec_body', 'ec_attachment', 'ec_is_despatched','created_at'];
}
