<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\School;
use App\Models\Employee;
use App\Models\Role;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
    public function login(){
        return view('login');
    }
    
    public function processLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        //Login user
        if(Auth::attempt($credentials)){
            //Check the roles of users and redirect to the appropriate dashboard
            if(Auth::user()->role_id == Role::IS_SUPERADMIN){
                return redirect('/admindashboard')->with('message', 'Admin Login successful');
            }else if(Auth::user()->role_id == Role::IS_PRINCIPAL){
                $school = School::find(Auth::user()->school_id);
                if($school->payment_status == 'Payment Complete'){
                    return redirect('/principaldashboard')->with('message', 'Principal Login successful');
                }
                return redirect('/payments')->with('message', 'Login successful');
            }else{
                return redirect('/teacherdashboard')->with('message', 'Teacher Login successful');
            }
            
        }

        return redirect()->back()->with('message', 'Invalid login credentials');
    }

    public function forgotPassword(){
        return view('forgotPassword');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email' => 'required | email | exists:employees,email'
        ]);

        $token = \Str::random(64);
        \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $action_link = route('resetPasswordForm', ['token' => $token, 'email' => $request->email]);

        $body = "<p>We have received a request to reset the password for <b>School Management System</b> account associated with ".$request->email."</p>
            <p>If you did not authorise this, simply ignore this email.</p>
            <p>If you did, you can now reset your password by clicking the link below.</p>";

        \Mail::send('emailForgot', ['action_link'=>$action_link, 'body'=>$body], function($message) use ($request){
            $message->from('nkatha.dev@gmail.com', 'School Management System');
            $message->to($request->email)
            ->subject('Password Reset');
        });

        return back()->with('message', 'We have emailed your reset password link');
    }

    public function resetPassword(Request $request, $token = null){
        return view('resetPassword')->with(['token'=>$token, 'email'=>$request->email]);
    }

    public function saveResetPassword(Request $request){
        $request->validate([
            'email' => 'required | email | exists:employees,email',
            'password' => 'required | min:6',
            'confirm_password' => 'required | min:6 | same:password'
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token, 
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('message', 'Invalid Token');
        }else{
            Employee::where('email', $request->email)->update([
                'password' => \Hash::make($request->password)
            ]);
            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('login')->with('message', 'Your password has been changed! Login with new password');
        }
    }

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/login');
    }
}
