<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentOrganizer extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ccfc_document_organizer';

    // Define the primary key if it's not named 'id'
    protected $primaryKey = 'cdo_id';

    // Specify custom column names for timestamps
    const CREATED_AT = 'cdo_created_at';
    const UPDATED_AT = 'cdo_updated_at';

    // Specify custom column name for soft delete
    const DELETED_AT = 'cdo_deleted_at';

    protected $fillable = [
        'cdo_name',
        'cdo_parent_id',
    ];

    public function documents()
    {
        //return $this->morphMany(TenderDocument::class, 'fileable');
        return $this->hasMany(TenderDocument::class, 'ctd_cdo_id', 'cdo_id');
    }

    
}
