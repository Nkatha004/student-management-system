<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Role;
use Auth;

class StudentSubjectsController extends Controller
{
    public function index($id){
        $studentsubjects = StudentSubject::all()->where('student_id', $id)->where('deleted_at', NULL);
        foreach($studentsubjects as $studentsubject){
            $this->authorize('view',  $studentsubject);
        } 
        $student = Student::find($id);

        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $schoolID = Classes::all()->where('id', $student->class_id)->first()->school_id;
            $subjects = Subject::all()->where('deleted_at', NULL)->where('school_id', $schoolID);
        }else{
            $subjects = Subject::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);
        }
        $studentsubjects = StudentSubject::all()->where('student_id', $id)->where('deleted_at', NULL);
    
        return view('students/addStudentSubjects', ['student'=> $student, 'studentsubjects'=> $studentsubjects, 'subjects'=>$subjects]);
    }

    public function store(Request $request){
        $this->authorize('create',  StudentSubject::class);

        $request->validate([
            'student' => 'required',
            'subject' => 'required'
        ]);

        //check if student subject exists
        $studentsubject = StudentSubject::all()->where('deleted_at', NULL)->where('student_id', request('student'))->where('subject_id', request('subject'));

        if(count($studentsubject) > 0){
            //request('student') gives the id of the student and then redirects with id as query parameter
            return redirect("/studentsubjects/".request('student'))->with("message", "Student Subject already exists!");
        }else{
            StudentSubject::create([
                'student_id' => request('student'), 
                'subject_id' => request('subject')
            ]);
            return redirect("/studentsubjects/".request('student'))->with("message", "Student Subject added successfully");
        }
    }

    public function edit($id){
        $studentsubject = StudentSubject::find($id);
        $student = Student::find($studentsubject->student_id);
        
        $this->authorize('update',  $studentsubject);

        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $schoolID = Classes::all()->where('id', $student->class_id)->first()->school_id;
            $subjects = Subject::all()->where('deleted_at', NULL)->where('school_id', $schoolID);
        }else{
            $subjects = Subject::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);
        }

        

        return view('students/editstudentsubject', ['studentsubject'=>$studentsubject, 'subjects'=>$subjects]);
    }

    public function update(Request $request, $id){
        $studentsubject = StudentSubject::find($id);
        
        $this->authorize('update',  $studentsubject);

        $request->validate([
            'subject' => 'required'
        ]);
        
        $studentsubject->subject_id= $request->input('subject');
        $studentsubject->save();

        //request('student') gives the id of the student and then redirects with id as query parameter
        return redirect("/studentsubjects/".request('student'))->with("Student Subject edited successfully");
    }

    public function destroy($id)
    {
        $studentsubject = StudentSubject::find($id);
        $this->authorize('delete',  $studentsubject);
        
        $studentsubject->delete();

        return redirect("/studentsubjects/".$studentsubject->student_id)->with("Student Subject deleted successfully");
    }
    public static function getStudentName($id){
        $student = Student::find($id);
        return $student->first_name. ' '. $student->last_name;
    }
    public static function getSubject($id){
        $subject = Subject::find(StudentSubject::find($id)->subject_id);
        return $subject->subject_name;
    }
    public static function getClass($id){
        $class = Student::find(StudentSubject::find($id)->student_id)->class_id;
        return Classes::find($class)->class_name;
    }

    //softDeletes studentsubjects
    public function trashedStudentSubjects(){
        $this->authorize('restore', StudentSubject::class);

        $studentsubjects = StudentSubject::onlyTrashed()->whereIn('student_id', Student::select('id')->whereIn('class_id', Classes::select('id')->where('school_id', Auth::user()->school_id)))->get();
        return view('students/trashedStudentSubjects', compact('studentsubjects'));
    }

    //restore deleted studentsubject
    public function restoreStudentSubject($id){
        $this->authorize('restore', StudentSubject::class);
        
        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $studentsubjects = StudentSubject::whereId($id)->whereIn('student_id', Student::select('id')->whereIn('class_id', Classes::select('id')->where('school_id', Auth::user()->school_id)))->restore();
        }else{
            StudentSubject::whereId($id)->restore();
        }
        
        return back();
    }

    //restore all deleted studentsubjects
    public function restoreStudentSubjects(){
        $this->authorize('restore', StudentSubject::class);
        
        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            StudentSubject::onlyTrashed()->whereIn('student_id', Student::select('id')->whereIn('class_id', Classes::select('id')->where('school_id', Auth::user()->school_id)))->restore();
            Subject::onlyTrashed()->where('school_id', Auth::user()->school_id)->restore();
        }else{
            StudentSubject::onlyTrashed()->restore();
        }

        return back();
    }
}
