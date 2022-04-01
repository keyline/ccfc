<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserDetail extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const SEX_RADIO = [
        'male'   => 'Male',
        'female' => 'Female',
        'Others' => 'Others',
    ];

    public const SPOUSE_SEX_RADIO = [
        'male'   => 'Male',
        'female' => 'Female',
        'others' => 'Others',
    ];

    public $table = 'user_details';

    protected $appends = [
        'member_image',
        'spouse_image',
    ];

    protected $dates = [
        'date_of_birth',
        'spouse_dob',
        'anniversary_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_code_id',
        'member_type_code',
        'member_type',
        'date_of_birth',
        'member_since',
        'sex',
        'address_1',
        'address_2',
        'address_3',
        'city',
        'state',
        'pin',
        'phone_1',
        'phone_2',
        'mobile_no',
        'email',
        'current_status',
        'represented_club_in',
        'hobbies_interest',
        'business_profession',
        'category',
        'business_address_1',
        'business_address_2',
        'business_address_3',
        'business_city',
        'business_state',
        'business_pin',
        'business_phone_1',
        'business_phone_2',
        'business_email',
        'spouse_name',
        'spouse_dob',
        'spouse_sex',
        'spouse_phone_1',
        'spouse_phone_2',
        'spouse_mobile_no',
        'spouse_email',
        'anniversary_date',
        'spouse_business_profession',
        'spouse_business_category',
        'spouse_business_address_1',
        'spouse_business_address_2',
        'spouse_business_address_3',
        'spouse_business_city',
        'spouse_business_state',
        'spouse_business_pin',
        'spouse_business_phone_1',
        'spouse_business_phone_2',
        'spouse_business_email',
        'member_image',
        'spouse_image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function user_code()
    {
        return $this->belongsTo(User::class, 'user_code_id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getSpouseDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSpouseDobAttribute($value)
    {
        $this->attributes['spouse_dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getAnniversaryDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setAnniversaryDateAttribute($value)
    {
        $this->attributes['anniversary_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    // public function getMemberImageAttribute()
    // {
    //     $file = $this->getMedia('member_image')->last();
    //     if ($file) {
    //         $file->url       = $file->getUrl();
    //         $file->thumbnail = $file->getUrl('thumb');
    //         $file->preview   = $file->getUrl('preview');
    //     }

    //     return $file;
    // }

    // public function getSpouseImageAttribute()
    // {
    //     $file = $this->getMedia('spouse_image')->last();
    //     if ($file) {
    //         $file->url       = $file->getUrl();
    //         $file->thumbnail = $file->getUrl('thumb');
    //         $file->preview   = $file->getUrl('preview');
    //     }

    //     return $file;
    // }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}