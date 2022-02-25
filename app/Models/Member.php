<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'members';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'select_member_id',
        'select_title_id',
        'select_sport_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function select_member()
    {
        return $this->belongsTo(User::class, 'select_member_id');
    }

    public function select_title()
    {
        return $this->belongsTo(Title::class, 'select_title_id');
    }

    public function select_sport()
    {
        return $this->belongsTo(Sportstype::class, 'select_sport_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}