<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Contact;

class ContactUsController extends Controller
{
    public function index(){
        return view('contactus/contact');
    }
    public function store(Request $request){
        $input = $request->all();

        $rules = [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required | email',
            'message' => 'required'
        ];

        $messages = [
            'firstName.required' => 'First name is required',
            'lastName.required' => 'Last name is required',
            'email.required'=>'Email address is required',
            'email.email'=>'Please input a valid email address',
            'email.required'=>'The message field is required',
        ];

        $validator = Validator::make($input, $rules, $messages);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        Contact::create([
            'first_name' => request('firstName'),
            'last_name' => request('lastName'),
            'email' => request('email'),
            'message' => request('message')
        ]);

        $body = "<p>Hello ".$request->firstName.",</p>
                <p>We have received your message and we are glad you reached out to us. A member of our team will respond to your query soonest possible</p>";

        \Mail::send('contactus/sendReceiptEmail', ['body'=>$body], function($message) use ($request){
            $message->from('nkatha.dev@gmail.com', 'School Management System');
            $message->to($request->email)
            ->subject('School Management System: Message Received');
        });

        return redirect('/#section3')->with('message', 'Message successfully sent');
    }
    public function viewMessages(){
        $contacts = Contact::where('deleted_at', NULL)->get();

        return view('contactus/viewMessages', ['contacts'=> $contacts]);
    }

    public function pendingMessages(){
        $contacts = Contact::where('deleted_at', NULL)->where('responded_to', 0)->get();

        return view('contactus/viewMessages', ['contacts'=> $contacts]);
    }

    public function respondedMessages(){
        $contacts = Contact::where('deleted_at', NULL)->where('responded_to', 1)->get();

        return view('contactus/viewMessages', ['contacts'=> $contacts]);
    }

    public function respondMessage($id, Request $request){
        $contact = Contact::find($id);
        return view('contactus/draftEmailResponse', ['contact' => $contact]);
    }

    public function sendEmailResponse(Request $request){
        $request->validate([
            'responseBody' => 'required'
        ]);
        $contact = Contact::find(request('contactID'));
        $body = $request->responseBody;

        \Mail::send('contactus/responseEmail', ['body'=>$body, 'contact'=>$contact], function($message) use ($contact){
            $message->from('nkatha.dev@gmail.com', 'School Management System');
            $message->to($contact->email)
            ->subject('School Management System: Message Received');
        });

        $contact->responded_to = 1;
        $contact->save();

        return redirect()->back()->with('message', 'Email sent successfully');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id)->delete();
        return redirect('/viewmessages')->with('message', 'Role deleted successfully!');
    }

    //softDeletes messages
    public function trashedMessages(){
        $contacts = Contact::onlyTrashed()->get();
        return view('contactus/trashedMessages', compact('contacts'));
    }

    //restore deleted message
    public function restoreMessage($id){
        Contact::whereId($id)->restore();
        return back();
    }

    //restore all deleted messages
    public function restoreMessages(){
        Contact::onlyTrashed()->restore();
        return back();
    }
}
