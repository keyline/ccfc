<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class TenderDocument extends Model
{
    use HasFactory;
    //use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ccfc_tender_document';

    // Define the primary key if it's not named 'id'
    protected $primaryKey = 'ctd_id';

    protected $fillable = ['ctd_title', 'ctd_description', 'ctd_cdo_id','ctd_archive_status', 'ctd_deleted_at'];

    // Specify custom column names for timestamps
    const CREATED_AT = 'ctd_created_at';
    const UPDATED_AT = 'ctd_updated_at';

    // Specify custom column name for soft delete
    const DELETED_AT = 'ctd_deleted_at';

    //protected $dates = ['ctd_deleted_at'];

    public function files()
    {
        return $this->morphMany(TenderFile::class, 'fileable');
    }

    public function folder()
    {
        return $this->belongsTo(DocumentOrganizer::class, 'ctd_cdo_id');
    }

    public function addTenderFile(TenderFile $file)
    {
        
        $this->files()->save($file);

    }

    public function removeTenderFile(TenderFile $file)
    {
        $file->fileable()->dissociate();
        $file->save();

    }

    public function getFiles()
    {
        return $this->files; //collection with TenderFile models
    }


}
