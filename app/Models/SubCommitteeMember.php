<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCommitteeMember extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'sub_committee_members';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'comittee_name_id',
        'member_id',
        'head_of_the_committee',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function comittee_name()
    {
        return $this->belongsTo(CommitteeName::class, 'comittee_name_id');
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
