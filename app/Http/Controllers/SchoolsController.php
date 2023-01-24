<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Role;
use App\Models\Employee;
use Hash;

class SchoolsController extends Controller
{
    public function index(){
        return view('schools/addSchool');
    }
    public function store(Request $request){
        $request->validate([
            'schoolname' => 'required',
            'school_email' => 'required | email',
            'school_telNo' => 'required',
            'principal_fname' => 'required',
            'principal_lname' => 'required',
            'principal_tscNo' => 'required',
            'principal_telNo' => 'required',
            'principal_email' => 'required | email',
            'password' => 'required | min:6',
            'password_confirmation' => 'required | min:6 | same:password'
        ]);
        School::create([
            'school_name' => request('schoolname'),
            'email' => request('school_email'),
            'phone_number' => request('school_telNo')
        ]);

        $school = School::select('id')->where('school_name', '=', request('schoolname'))->get();
        $role = Role::select('id')->where('role_name', '=', 'Principal')->get();

        // return $school[0]['id'];
        Employee::create([
            'first_name' => request('principal_fname'), 
            'last_name' => request('principal_lname'),
            'tsc_number' => request('principal_tscNo'),
            'email' => request('principal_email'),
            'password' => Hash::make(request('password')),
            'telephone_number' => request('principal_telNo'),
            'school_id' => $school[0]['id'],
            'role_id' => $role[0]['id']
        ]);

        return redirect('/login')->with('message', 'School registered successfully!');
    }
    public function viewSchools(){
        $schools = School::all();

        return view('schools/viewschools', ['schools'=> $schools]);
    }

    public function edit($id){
        $school = School::find($id);

        return view('schools/editSchool', ['school'=>$school]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'schoolname' => 'required',
            'email' => 'required | email',
            'telNo' => 'required',
            'status' => 'required'
        ]);

        $school = School::find($id);
        
        $school->school_name= $request->input('schoolname');
        $school->email = $request->input('email');
        $school->phone_number= $request->input('telNo');
        $school->status= $request->input('status');
        $school->save();

        return redirect('/viewschools')->with('message', 'School updated successfully!');
    }

    public function destroy($id)
    {
        $school = School::find($id);

        $school->status = "Deleted";
        $school->save();

        return redirect('/viewschools')->with('message', 'School deleted successfully!');
    }

    public static function getSchoolName($id){
        $school = School::find($id);

        return $school->school_name;
    }
    
}
