<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'cdo_name',
    ];

    public function documents()
    {
        //return $this->morphMany(TenderDocument::class, 'fileable');
        return $this->hasMany(TenderDocument::class, 'ctd_cdo_id', 'cdo_id');
    }

    // Method to check if folder name represents the current financial year
    public function isCurrentFinancialYear(): bool
    {
        // Get the current date
        $currentDate = Carbon::now();

        // Extract the year from the folder name
        $folderYear = (int) substr($this->cdo_name, 0, 4);

        // Get the start and end dates of the financial year
        $financialYearStart = Carbon::create($folderYear, 4, 1); // Assuming financial year starts from April
        $financialYearEnd = $financialYearStart->copy()->addYear()->subDay(); // Ends on March 31 of next year

        // Check if the current date falls within the financial year
        return $currentDate->between($financialYearStart, $financialYearEnd);

        /*// Calender year calculation
        $currentYear = Carbon::now()->year;

        // Extract the year from the folder name
        $folderYear = (int) substr($this->cdo_name, 0, 4);

        // Check if the folder year matches the current year
        return $folderYear === $currentYear;*/
    }

    // Define a local scope to filter documents based on ctd_archive_status
    public function scopeWithCtdArchiveStatus($query, $statuses)
    {
        return $query->whereHas('documents', function ($query) use ($statuses) {
            $query->whereIn('ctd_archive_status', $statuses);
        });
    }

    
}
