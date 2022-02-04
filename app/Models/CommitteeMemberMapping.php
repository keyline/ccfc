<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeMemberMapping extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'committee_member_mappings';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'committee_id',
        'member_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function committee()
    {
        return $this->belongsTo(CommitteeName::class, 'committee_id');
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
