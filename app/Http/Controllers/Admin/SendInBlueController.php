<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;

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
        ;
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
    public function show(EmailCampaign $campaign)
    {
        return view('admin.campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmailCampaign $emailcampaign)
    {
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
}
