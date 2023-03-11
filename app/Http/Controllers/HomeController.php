<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\School;
use App\Models\Employee;
use App\Models\Role;
use Carbon\Carbon;
use App\Models\Contact;
use Hash;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function login(){
        return view('login');
    }
    
    public function register(){
        return view('register');
    }

    public function processLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => [
                'required'
            ]
        ]);

        // Password::min(8)
        //         ->letters()
        //         ->mixedCase()
        //         ->numbers()
        //         ->symbols()
        //         ->uncompromised(3)

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

        return redirect()->back()->with('messageLogin', 'Invalid login credentials');
    }

    public function forgotPassword(){
        return view('forgotPassword');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email' => 'required | email | exists:employees,email'
        ]);

        //generate an access token for resetting the password
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

        //send an email to user to help reset the password
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

        //confirm that the sent token matches with the received token
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

    public function showProfilePage(){
        return view('updateProfile');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'telNo' => 'required',
            'email' => 'required | email'
        ]);

        $employee = Employee::find(Auth::user()->id);
        
        $employee->first_name= $request->input('fname');
        $employee->last_name= $request->input('lname');
        $employee->email = $request->input('email');
        $employee->telephone_number = $request->input('telNo');

        if(Auth::user()->role_id != Role::IS_SUPERADMIN){
            $employee->tsc_number = $request->input('tscNo');
        }

        if($image = $request->file('image')){
            //store profile images by the time stamp and file extension
            $destination = "profileImages/";
            $profileImage = time().'.'.$request->file('image')->getClientOriginalExtension();

            //store profile images in public/profileImages folder
            $image->move($destination, $profileImage);

            //store image in db
            $employee->profile_image =  $profileImage;
        }
        $employee->save();

        return redirect('/updateprofile')->with('messageprofile', 'Profile updated successfully!');
    }

    public function changePassword(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => [
                'required',
                Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(3)
            ],
            'password_confirmation' => 'required | same:password'
        ]);

        //check if stored password is equivalent to the given old password
        $dbPassword = Hash::check(request('currentPassword'), Auth::user()->password);

        if($dbPassword){
            $employee = Employee::find(Auth::user()->id);
        
            $employee->password= Hash::make($request->input('password'));
            $employee->save();

            return redirect('/updateprofile')->with('message', 'Password changed successfully');
        }else{
            return redirect('/updateprofile')->with('message', 'Current password is incorrect for '.Auth::user()->first_name);
        }
    }
}
