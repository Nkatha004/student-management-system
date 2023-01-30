<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\School;

class HomeController extends Controller
{
    public function index(){
        return view('index');
    }
    public function login(){
        return view('login');
    }
    public function editPassword(){
        return view('changePassword');
    }
    public function updatePassword(){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
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
            if(Auth::user()->role_id == 1){
                return redirect('/admindashboard')->with('message', 'Admin Login successful');
            }else if(Auth::user()->role_id == 2){
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
    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/login');
    }
}
