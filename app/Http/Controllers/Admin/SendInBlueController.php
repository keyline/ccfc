<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use App\Mail\SendInBlueNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


use Mail;

class SendInBlueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns= EmailCampaign::latest()->paginate(5);
        

        return view('admin.campaigns.create', ['campaigns' => $campaigns])
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ec_title' => 'required',
            'ec_body' => 'required',
            'file' => 'mimes:csv,txt,xlx,xls,pdf|max:2048',
            'ec_is_despatched'=> 'required',
        ]);

        if ($request->file()) {
            //$filepath = $request->file('ec_attachment')->store('campaign_attachments');
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('campaign_attachments', $fileName, 'local');
            $filepathWithName = '/storage/' . $filePath;
            
            $request->merge(['ec_attachment' => $filepathWithName]);
        }

        EmailCampaign::create($request->all());

        return redirect()->route('admin.list-campaign')
            ->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emailcampaign= EmailCampaign::find($id);
        return view('admin.campaigns.show', compact('emailcampaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emailcampaign= EmailCampaign::find($id);
        return view('admin.campaigns.edit', compact('emailcampaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmailCampaign $campaign)
    {
        $request->validate([
            'ec_title' => 'required',
            'ec_body' => 'required',
            'ec_attachment' => '',
            'ec_is_despatched'=> 'required',
        ]);

        if ($request->file()) {
            //$filepath = $request->file('ec_attachment')->store('campaign_attachments');
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('campaign_attachments', $fileName, 'local');
            $filepathWithName = '/storage/' . $filePath;
            
            $request->merge(['ec_attachment' => $filepathWithName]);
        }


        $campaign->update($request->all());

        return redirect()->route('admin.list-campaign')
            ->with('success', 'Campaign updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmailCampaign $emailcampaign)
    {
        $emailcampaign->delete();

        return redirect()->route('admin.list-campaign')
            ->with('success', 'Campaign deleted successfully');
    }

    /**
     *
     */
    public function startCampaign(Request $request)
    {

        //check request has campaign id
        if (!empty($request->campaign) && is_numeric($request->campaign)) {
            //Dispatching the Job here
            //fetch user list with email not empty
            $campaign= \App\Models\EmailCampaign::findOrFail($request->campaign);

            $query= \App\Models\User::query();
            $query->where('email', '!=', '');
            $query->where('id', '>', 36);
            $users= $query->get();

            foreach ($users as $user) {
                \App\Jobs\EmailCampaignJob::dispatch($request->campaign, $user)->onQueue('sendinblueemail');
            }
            $campaign->update(['ec_is_despatched' => '0']);
            
            return redirect()->back()->with('success', 'Campaign started successfully');
        }
    }

    public function rmAttachment(Request $request)
    {
        $input = $request->all();

        $response = array(

            'status' => 0,

            'error' => array(

                'message' => 'Invalid Request!'

            )

        );
        $error="";


        if (!empty($input['_token']) && is_numeric($input['forid'])) {
            $campaign= EmailCampaign::findOrFail($input['forid']);


            if (!empty($campaign)) {
                //delete the file physically and update model
                if (File::exists(storage_path('app\\' . $campaign['ec_attachment']))) {
                    Storage::delete(storage_path($campaign['ec_attachment']));
                    //Update model
                    $campaign->update(['ec_attachment' => ""]);
                    $response=array(
                    'status' => 1,
                    'error'  => null,
                    'message'=> 'Operation done successfully',
                );
                } else {
                    # code...
                    $error="File does not exists";
                    $response=array(
                    'status' => 0,
                    'error'  => array(
                        'message' => $error
                    )
                );
                }
            } else {
                # code...
                $error= "could not find data";
                $response=array(
                    'status' => 0,
                    'error'  => array(
                        'message' => $error
                    )
                );
            }
            return response()->json($response);
        } else {
            return response()->json($response);
        }
    }
}
