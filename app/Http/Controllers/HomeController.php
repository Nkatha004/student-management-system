<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

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

        if(Auth::attempt($credentials)){
            return redirect('/')->with('message', 'Login successful');
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
