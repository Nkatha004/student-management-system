<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\Classes;

class StudentsController extends Controller
{
    public function index(){
        $schools = School::all()->where('status', 'Active');
        $classes = Classes::all()->where('status', 'Active');

        return view('students/addStudent', ['schools'=>$schools, 'classes'=>$classes]);
    }
    public function store(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'guardianname' => 'required',
            'email' => 'required | email',
            'phoneNo' => 'required',
            'admNo' => 'required'
        ]);

        Student::create([
            'admission_number' => request('admNo'),
            'first_name' => request('fname'), 
            'last_name' => request('lname'),
            'guardian_name' => request('guardianname'),
            'guardian_email' => request('email'),
            'guardian_phone_number' => request('phoneNo'),
            'class_id' => request('class')
        ]);

        return redirect('/viewstudents')->with('message', 'Student added successfully!');

    }
    public function viewStudents(){
        $students = Student::all();
       
        return view('students/viewStudents', ['students'=> $students]);
    }
    public function edit($id){
        $student = Student::find($id);
        $classes = Classes::all()->where('status', 'Active');

        return view('students/editstudent', ['student'=>$student, 'classes' => $classes]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'guardianname' => 'required',
            'email' => 'required | email',
            'phoneNo' => 'required',
            'admNo' => 'required',
            'status'=>'required'
        ]);


        $student = Student::find($id);
        
        $student->first_name= $request->input('fname');
        $student->last_name= $request->input('lname');
        $student->guardian_name = $request->input('guardianname');
        $student->guardian_email = $request->input('email');
        $student->guardian_phone_number = $request->input('phoneNo');
        $student->admission_number = $request->input('admNo');
        $student->class_id = $request->input('class');
        $student->status= $request->input('status');

        $student->save();

        return redirect('/viewstudents')->with('message', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        $student->status = "Deleted";
        $student->save();

        return redirect('/viewstudents')->with('message', 'Student deleted successfully!');
    }
    
}