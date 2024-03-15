<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\DocumentOrganizer;
use App\Models\TenderDocument;
use App\Models\TenderFile;
use App\Http\Requests\StoreTenderuploadsRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
Use \Carbon\Carbon;
use App\Http\Requests\UpdateTenderuploadsRequest;



class TenderFileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('tenderupload_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$uploadedTenders = Sportstype::with(['media'])->get();
        $uploadedTenders= DocumentOrganizer::find(1)->documents;

        return view('admin.tendersupload.index', compact('uploadedTenders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('tenderupload_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tendersupload.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTenderuploadsRequest $request)
    {
        //Get the folder for current Year
        $folder= DocumentOrganizer::find(1);
        if($request->input('tender_files', false))
        {
            // Check if the 'pdfs' directory exists, if not, create it
            if (!Storage::exists('tender_documents')) {
                Storage::makeDirectory('tender_documents');
            }
            
            if (!Storage::exists("tender_documents/{$folder->cdo_name}")) {
                Storage::makeDirectory("tender_documents/{$folder->cdo_name}");
            }

            $title = $request->input('tender_title');
            $description = $request->input('tender_description');

        
        // Attach a document to the folder
        $document = TenderDocument::create([
            'ctd_title' => $title,
            'ctd_description' => $description,
            'ctd_cdo_id' => $folder->cdo_id,
        ]);
        //$newFileStorePath= storage_path("tender_documents/{$folder->cdo_name}");
        foreach ($request->input('tender_files') as $filename) {
            $tempPath= storage_path('tmp/uploads/' . $filename);
            $file= $this->createFileObject($tempPath);
            $hashedName= $file->hashName();
            $originaName= $file->getClientOriginalName();
            $mimeType = $file->getClientMimeType();
            $extension= $file->getExtension();
            // Get the size of the uploaded file in bytes
            $sizeInBytes = $file->getSize();
            // Convert bytes to kilobytes or megabytes for display
            $sizeInKB = $sizeInBytes / 1024; // Convert bytes to kilobytes
            $sizeInMB = $sizeInKB / 1024; // Convert kilobytes to megabytes
            // Handle each file individually, e.g., store in storage
            
            // Move the file to the desired location within storage
            $path = $file->storeAs("tender_documents/{$folder->cdo_name}", $hashedName);
            //Storage::move($tempPath, $newFileStorePath);
            $myTime = Carbon::now();

            $document->files()->create([
                'cfm_original_name' => $originaName,
                'cfm_unique_name'   => $hashedName,
                'cfm_physical_path' => $path,
                'cfm_published_datetime'    => $myTime->toDateTimeString(),
                'cfm_file_size'             => $sizeInKB,
                'cfm_mime_type'     => $mimeType,
                'cfm_uploaded_by'   => 1,

            ]);
        }

        //return back()->with('success', 'Files has been uploaded.');
        return redirect()->route('admin.tenderuploads.index');

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('tenderupload_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $document= TenderDocument::find($id);
        return view('admin.tendersupload.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTenderuploadsRequest $request, $id)
    {
        //$document= TenderDocument::find($id);
        //dd($request->all());
        $folders = DocumentOrganizer::all();
        $folders->load(['documents' => function ($query) use ($id) {
                    $query->where('ctd_id', $id);
        }]);
        
        //$folderName= $folderWithDocuments[0]->cdo_name;
        //$document= $folderWithDocuments->documents()->get();
        //$documentWithFiles= TenderDocument::find($document->ctd_id);
        
        $document= $folders[0]->documents->first();
        
        $documentWithFiles= TenderDocument::find($document->ctd_id);

        //dd($documentWithFiles->files);
        //dd($folders[0]->cdo_name);
        if (count($documentWithFiles->files) > 0) {
            foreach ($documentWithFiles->getFiles() as $media) {
                if (!in_array($media->cfm_original_name, $request->input('tender_files', []))) {
                    $media->disconnectFromDocument($document);
                }
            }
        }

        $media = $documentWithFiles->files->pluck('cfm_original_name')->toArray();

        foreach ($request->input('tender_files', []) as $file) {
        if (count($media) === 0 || !in_array($file, $media)) {
            //$document->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('document');
            $tempPath= storage_path('tmp/uploads/' . $file);
            $file= $this->createFileObject($tempPath);
            $hashedName= $file->hashName();
            $originaName= $file->getClientOriginalName();
            $mimeType = $file->getClientMimeType();
            $extension= $file->getExtension();
            // Get the size of the uploaded file in bytes
            $sizeInBytes = $file->getSize();
            // Convert bytes to kilobytes or megabytes for display
            $sizeInKB = $sizeInBytes / 1024; // Convert bytes to kilobytes
            $sizeInMB = $sizeInKB / 1024; // Convert kilobytes to megabytes
            // Handle each file individually, e.g., store in storage
            // Move the file to the desired location within storage
            $path = $file->storeAs("tender_documents/{$folders[0]->cdo_name}", $hashedName);
            $myTime = Carbon::now();

            $documentWithFiles->files()->create([
                'cfm_original_name' => $originaName,
                'cfm_unique_name'   => $hashedName,
                'cfm_physical_path' => $path,
                'cfm_published_datetime'    => $myTime->toDateTimeString(),
                'cfm_file_size'             => $sizeInKB,
                'cfm_mime_type'     => $mimeType,
                'cfm_uploaded_by'   => 1,

            ]);
        }

        
    }

    //Checking archived status
    $myTime = Carbon::now();
        if($request->input('tender_archive', []))
        {
            
            $documentWithFiles->update([
            'ctd_archive_status' => '0',
            'ctd_deleted_at'    => $myTime->toDateTimeString()
            ]);
        }
        

        return redirect()->route('admin.tenderuploads.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function massDestroy(Request $request)
    {
        Sportstype::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function createFileObject($path)
    {
        $file = new UploadedFile(
            $path,
            basename($path),
            'application/pdf', // Assuming the file is a PDF
            null,
            true
        );

        return $file;
    }

}
