<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;
    protected $table = 'user_devices';
    public $fillable = [
        'user_id', 'device_type', 'device_token', 'fcm_token', 'app_access_token'
    ];
}