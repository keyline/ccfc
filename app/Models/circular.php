<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class circular extends Model
{
    use HasFactory;

    protected $table = 'circulars';
    
    public $fillable = [
        'day', 'month', 'details_1', 'details_2', 'circular_image'
    ];
}