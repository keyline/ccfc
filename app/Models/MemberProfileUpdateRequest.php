<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProfileUpdateRequest extends Model
{
    use HasFactory;


    // protected $table = 'events';
    
    public $fillable = [
        'member_profile_update_requests'
    ];
}