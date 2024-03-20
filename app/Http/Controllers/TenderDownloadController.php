<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;
use App\Models\TenderFile;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class TenderDownloadController extends Controller
{
    public function download($file)
    {
        try {
            $document = TenderFile::where('cfm_id', $file)
                             ->where('fileable_type', 'App\Models\TenderDocument')
                             ->first();

    
        //dd($document->cfm_physical_path);
        // Assuming the file is stored in the 'local' disk
        //$filePath = Storage::disk('local')->get($document->cfm_physical_path);
        $filePath= storage_path('app/' . $document->cfm_physical_path);
        
        $mimeType = Storage::disk('local')->mimeType($document->cfm_physical_path);
        if (!file_exists($filePath)) {
        throw new FileNotFoundException($filePath);
    }
        //dd($mimeType);
        return response()->file($filePath);
        /*return response($file, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $document->cfm_original_name . '"',
        ]);*/
        } catch (FileNotFoundException $th) {
            //throw $th;
            return response()->view('errors.404', [], 404);

        }
        
    }
}
