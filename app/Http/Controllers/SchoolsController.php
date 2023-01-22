<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolsController extends Controller
{
    public function index(){
        return view('schools/addSchool');
    }
    public function store(Request $request){
        $request->validate([
            'schoolname' => 'required',
            'email' => 'required | email | unique:schools',
            'telNo' => 'required'

        ]);
        School::create([
            'school_name' => request('schoolname'),
            'email' => request('email'),
            'phone_number' => request('telNo')
        ]);

        return redirect('/viewschools')->with('message', 'School added successfully!');
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
