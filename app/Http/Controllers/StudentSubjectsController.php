<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;

class StudentSubjectsController extends Controller
{
    public function index($id){
        $student = Student::find($id);
        $studentsubjects = StudentSubject::all()->where('student_id', $id)->where('status', 'Active');
        $subjects = Subject::all()->where('status', 'Active');
    
        return view('students/addStudentSubjects', ['student'=> $student, 'studentsubjects'=> $studentsubjects, 'subjects'=>$subjects]);
    }

    public function store(Request $request){
        $request->validate([
            'student' => 'required',
            'subject' => 'required'
        ]);

        StudentSubject::create([
            'student_id' => request('student'), 
            'subject_id' => request('subject')
        ]);

        //request('student') gives the id of the student and then redirects with id as query parameter
        return redirect("/studentsubjects/".request('student'))->with("message", "Student Subject added successfully");
    }

    public function edit($id){
        $studentsubject = StudentSubject::find($id);
        $subjects = Subject::all()->where('status', 'Active');

        return view('students/editstudentsubject', ['studentsubject'=>$studentsubject, 'subjects'=>$subjects]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'subject' => 'required'
        ]);

        $studentsubject = StudentSubject::find($id);
        
        $studentsubject->subject_id= $request->input('subject');
        $studentsubject->status= $request->input('status');

        $studentsubject->save();

        //request('student') gives the id of the student and then redirects with id as query parameter
        return redirect("/studentsubjects/".request('student'))->with("Student Subject edited successfully");
    }

    public function destroy($id)
    {
        $studentsubject = StudentSubject::find($id);

        $studentsubject->status = "Deleted";
        $studentsubject->save();

        return redirect("/studentsubjects/".$studentsubject->student_id)->with("Student Subject deleted successfully");
    }
}
