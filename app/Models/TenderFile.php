<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TenderFile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ccfc_file_master';

    // Define the primary key if it's not named 'id'
    protected $primaryKey = 'cfm_id';

    // Specify custom column names for timestamps
    const CREATED_AT = 'cfm_created_at';
    const UPDATED_AT = 'cfm_updated_at';

    // Specify custom column name for soft delete
    const DELETED_AT = 'cfm_deleted_at';

    protected $fillable = [
        'cfm_original_name',
        'cfm_unique_name',
        'cfm_physical_path',
        'cfm_published_datetime',
        'cfm_file_size',
        'cfm_mime_type',
        'cfm_uploaded_by',
       
    ];

    public function fileable(): MorphTo
    {
        return $this->morphTo('fileable', 'fileable_type', 'fileable_id');
    }

    public function connectWithDocument(TenderDocument $document)
    {
        $this->fileable()->associate($document);

        $this->save();
    }

    public function connectWithFolder(DocumentOrganizer $folder)
    {
        $this->fileable()->associate($folder);

        $this->save();

    }

    public function disconnectFromDocument()
    {
        $this->fileable()->dissociate();
        $this->save();
    }

    public function disconnectFromFolder()
    {
        $this->fileable()->dissociate();

        $this->save();
    }

    public function getRelatedModel()
    {
        return $TenderFile->filable;
    }
}
