<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailCampaign;
use App\Models\UserDetail;
use App\Mail\SendInBlueNotification;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Mail;
use DB;
class SendInBlueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDetail     = new UserDetail;
        $memberTypes    = DB::table('user_details')->select('member_type')->distinct()->orderBy('member_type','ASC')->get();
        $campaigns      = EmailCampaign::latest()->paginate(5);
        return view('admin.campaigns.create', ['campaigns' => $campaigns, 'memberTypes' => $memberTypes])
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
    **/
    public function store(Request $request)
    {
        ini_set('upload_max_filesize', '50M');
        ini_set('post_max_size', '50M');
        $request->validate([
            'ec_type' => 'required',
            'ec_member_type' => 'required',
            'ec_title' => 'required',
            'ec_body' => 'required',
            'file' => 'mimes:csv,mp4,txt,xlsx,xls,pdf,jpg,png,gif|max:51200',
            'ec_is_despatched'=> 'required',
        ]);

        $emailCampaign = new EmailCampaign;
        $emailCampaign->ec_type             = $request->input('ec_type');
        $emailCampaign->ec_member_type      = json_encode($request->input('ec_member_type'));
        $emailCampaign->ec_title            = $request->input('ec_title');
        $emailCampaign->ec_body             = $request->input('ec_body');
        $emailCampaign->ec_is_despatched    = $request->input('ec_is_despatched');
        if ($request->file()) {
            $originalExtension = $request->file->getClientOriginalExtension();
            $extensionParts = explode('.', $originalExtension);
            if (count($extensionParts) > 2) {
                // The file has a double extension
                return response()->json(['error' => 'File has a double extension'], 400);
            }
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('campaign_attachments', $fileName, 'local');
            $filepathWithName = $filePath;            
            //$request->merge(['ec_attachment' => $filepathWithName]);
            $emailCampaign->ec_attachment = $filepathWithName;
        }
        //echo '<pre>';print_r($emailCampaign);die;
        $emailCampaign->save();
        //EmailCampaign::create($request->all());
        return redirect()->route('admin.list-campaign')->with('success', 'Campaign created successfully.');
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
        $userDetail     = new UserDetail;
        $memberTypes    = DB::table('user_details')->select('member_type')->distinct()->orderBy('member_type','ASC')->get();
        $emailcampaign  = EmailCampaign::find($id);
        return view('admin.campaigns.edit', compact('emailcampaign', 'memberTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(Request $request, EmailCampaign $campaign)
    public function update(Request $request, $id)
    {
        $request->validate([
            'ec_type' => 'required',
            'ec_member_type' => 'required',
            'ec_title' => 'required',
            'ec_body' => 'required',
            'ec_attachment' => '',
            'ec_is_despatched'=> 'required',
        ]);
        $emailCampaign = EmailCampaign::find($id);
        $emailCampaign->ec_type             = $request->input('ec_type');
        $emailCampaign->ec_member_type      = json_encode($request->input('ec_member_type'));
        $emailCampaign->ec_title            = $request->input('ec_title');
        $emailCampaign->ec_body             = $request->input('ec_body');
        $emailCampaign->ec_is_despatched    = $request->input('ec_is_despatched');
        if ($request->file()) {            
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('campaign_attachments', $fileName, 'local');
            $filepathWithName = $filePath;            
            //$request->merge(['ec_attachment' => $filepathWithName]);
            $emailCampaign->ec_attachment = $filepathWithName;
        }        
        $emailCampaign->update();
        //$campaign->update($request->all());
        return redirect()->route('admin.list-campaign')->with('success', 'Campaign updated successfully');
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
            $campaign = \App\Models\EmailCampaign::findOrFail($request->campaign);
            $ec_member_type = (($campaign)?json_decode($campaign->ec_member_type):[]);
            //$member_type = "'" . implode("','", $ec_member_type) . "'";

            // $query= \App\Models\User::query();
            // $query->where('email', '!=', '');
            // $query->where('email', '!=', 'admin@admin.com');
            // $query->where('status', 'LIKE', '%ACTIVE%');

            //$query->orWhere('status', '=', 'INACTIVE');
            //$query->where('id', '=', 6178);            
            
            //DB::enableQueryLog();            
            if(count($ec_member_type)>0){
                $userData = DB::table('users')
                ->join('user_details', 'users.id', '=', 'user_details.user_code_id')
                ->where('users.email', '!=', '')
                ->where('users.email', '!=', 'admin@admin.com')
                ->where('users.status', 'LIKE', '%ACTIVE%')
                ->whereIn('user_details.member_type',$ec_member_type)
                ->select('users.*', 'user_details.member_type')
                ->get();
            } else {
                $userData = DB::table('users')
                ->join('user_details', 'users.id', '=', 'user_details.user_code_id')
                ->where('users.email', '!=', '')
                ->where('users.email', '!=', 'admin@admin.com')
                ->where('users.status', 'LIKE', '%ACTIVE%')
                ->select('users.*', 'user_details.member_type')
                ->get();
            }            
            //$lastquery = DB::getQueryLog();
            //echo '<pre>';print_r($lastquery);
            //$users= $query->get();
            //echo '<pre>';print_r($userData);die;
            
            foreach ($userData as $user) {
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
                if (Storage::disk('local')->exists($campaign["ec_attachment"])) {
                    $path = Storage::disk('local')->getAdapter()->getPathPrefix();

                    Storage::delete($path . $campaign["ec_attachment"]);
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
