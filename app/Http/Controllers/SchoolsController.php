<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Classes;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Validation\Rules\Password;
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
        //Insert school records first
        School::create([
            'school_name' => request('schoolname'),
            'email' => request('school_email'),
            'phone_number' => request('school_telNo')
        ]);

        //select the inserted school
        $school = School::select('id')->where('school_name', '=', request('schoolname'))->get()->first();
        $role = Role::select('id')->where('role_name', '=', 'Principal')->get()->first();

       // create an employee whose school id is the inserted school above
        Employee::create([
            'first_name' => request('principal_fname'), 
            'last_name' => request('principal_lname'),
            'tsc_number' => request('principal_tscNo'),
            'email' => request('principal_email'),
            'password' => Hash::make(request('password')),
            'telephone_number' => request('principal_telNo'),
            'school_id' => $school->id,
            'role_id' => $role->id
        ]);
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            return redirect('/viewschools')->with('message', 'School registered successfully!');
        }else{
            return redirect('/login')->with('messageLogin', 'School registered successfully!');
        }
    }
    public function viewSchools(){
        $this->authorize('viewAny',  School::class);

        $schools = School::where('deleted_at', NULL)->where('id', '!=', '1')->get();

        return view('schools/viewschools', ['schools'=> $schools]);
    }

    public function edit($id){
        $school = School::find($id);

        return view('schools/editSchool', ['school'=>$school]);
    }

    public function update(Request $request, $id, School $school){
        $this->authorize('update',  $school);

        $request->validate([
            'schoolname' => 'required',
            'email' => 'required | email',
            'telNo' => 'required | min:9'
        ]);

        $school = School::find($id);
        
        $school->school_name= $request->input('schoolname');
        $school->email = $request->input('email');
        $school->phone_number= $request->input('telNo');
        $school->save();

        return redirect('/viewschools')->with('message', 'School updated successfully!');
    }

    public function destroy($id)
    {
        $this->authorize('delete',  $school);

        $school = School::find($id)->delete();
        
        return redirect('/viewschools')->with('message', 'School deleted successfully!');
    }

    public static function getSchoolName($id){
        if($id == NULL){
            return "Not found";
        }
        $school = School::find($id);

        return $school->school_name;
    }
    public static function getSchoolNameByClassID($id){
        if($id == NULL){
            return "Not found";
        }
        $school = School::select('*')->whereIn('id', Classes::select('school_id')->where('id', $id)->get())->get()->first();

        return $school->school_name;
    }

    //softDeletes schools
    public function trashedSchools(){
        $this->authorize('restore',  School::class);

        $schools = School::onlyTrashed()->get();
        return view('schools/trashedSchools', compact('schools'));
    }

    //restore deleted schools
    public function restoreSchool($id){
        $this->authorize('restore',  School::class);

        School::whereId($id)->restore();
        return back();
    }

    //restore all deleted schools
    public function restoreSchools(){
        $this->authorize('restore',  School::class);

        School::onlyTrashed()->restore();
        return back();
    }
}