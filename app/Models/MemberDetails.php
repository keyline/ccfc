<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\MemberDetails as Authenticatable;
use Illuminate\Notifications\Notifiable;


class MemberDetails extends Model
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;


    public $table = 'member_details';

    protected $hidden = [
        'remember_token', 'two_factor_code',
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        
    ];

    protected $fillable = [
        'user_code',
        'details',
        'status',
        'created_at',
        'updated_at',        
    ];

    public function generateTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(15)->format(config('panel.date_format') . ' ' . config('panel.time_format'));
        $this->save();
    }

    public function resetTwoFactorCode()
    {
        $this->timestamps            = false;
        $this->two_factor_code       = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    // public function getIsAdminAttribute()
    // {
    //     return $this->roles()->where('id', 1)->exists();
    // }

    // public function userCodeUserDetails()
    // {
    //     return $this->hasMany(UserDetail::class, 'user_code_id', 'id');
    // }

    // public function getEmailVerifiedAtAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setEmailVerifiedAtAttribute($value)
    // {
    //     $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    // public function setPasswordAttribute($input)
    // {
    //     if ($input) {
    //         $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    //     }
    // }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPassword($token));
    // }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }

    // public function getTwoFactorExpiresAtAttribute($value)
    // {
    //     return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    // }

    // public function setTwoFactorExpiresAtAttribute($value)
    // {
    //     $this->attributes['two_factor_expires_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }
}