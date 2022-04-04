<?php

namespace App\Http\Controllers;

use App\Models\Contact;

use App\Http\Controllers\Controller;
// use App\Mail\ContactMail;

use Illuminate\Http\Request;

use Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contact.index')->with('ContactArr', Contact::all());
    }
    
    public function contact()
    {
        
        // return view('index');
    }


    public function contactForm()
    {
        return view('contact-us');
    }



    public function storeContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();

        Contact::create($input);

        //  Send mail to admin
        \Mail::send('contactMail', array(
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'subject' => $input['subject'],
            'message' => $input['message'],
        ), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('pranoy@keylines.net', 'Admin')->subject($request->get('subject'));
        });

        return redirect()->back()->with(['success' => 'Contact Form Submit Successfully']);
    }


    // public function sendEmail(Request $request){
        
    //     $details=[
            
    //         'name'=>$request->name,
    //         'email'=>$request->email,
    //         'phone'=>$request->phone,
    //         'msg'=>$request->msg
    //     ];

    //     Mail::to('pranoy@keylines.net')->send(new ContactMail($details));
        
    //     return back()->with('message_sent','Your message has been sent succssfully.');
    // }
}