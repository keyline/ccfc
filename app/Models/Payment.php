<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tzsk\Payu\Models\HasTransactions;

class Payment extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasTransactions;


    public $table = 'payments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'member_id',
        'amount_paid',
        'gateway_name',
        'comment',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
