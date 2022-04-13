<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;


    protected $table = 'events';
    
    public $fillable = [
        'day', 'month', 'details_1', 'details_2', 'event_image'
    ];
}