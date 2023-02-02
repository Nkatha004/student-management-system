<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\Classes;
use App\Models\EmployeeSubject;
use App\Models\StudentSubject;
use Auth;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function index(){
        $schools = School::all()->where('status', 'Active');
        if(Auth::user()->role_id != 4){
            $classes = Classes::all()->where('status', 'Active')->where('school_id', Auth::user()->school_id);
        }else{
            //allow class teacher to add students belonging to their class only
            $classes = Classes::all()->where('status', 'Active')->where('school_id', Auth::user()->school_id)->where('class_teacher', Auth::user()->id);
        }
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
        //display all students only when admin is logged in
        if(Auth::user()->role_id == 1){
            $students = Student::all()->where('status', 'Active');
            //find the school id in which student's class is in... to display school name when admin is logged in
            $schoolID = Classes::select('school_id')->where('id','=', $students->first->class_id)->get();
            return view('students/viewStudents', ['students'=> $students, 'schoolID'=> $schoolID]);
        }
        //display students in the class where the logged in teacher is a classteacher only
        elseif(Auth::user()->role_id == 4){
            $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')->where('status', 'Active')->where('class_teacher', Auth::user()->id)->get())
                    ->get();
                    
            if(count($students) == 0){
                return view('students/viewStudents', ['message'=>'No students found!']);
            }else{
                //return list of students in the school
                return view('students/viewStudents', ['students'=> $students]);
            }
            
        }
        else{
            //display students specific to school of logged in user
            $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')
                    ->where('status', 'Active')
                    ->where('school_id', Auth::user()->school_id)->get())
                    ->get();
    
            if(count($students) == 0){
                return view('students/viewStudents', ['message'=>'No students found!']);
            }else{
                //return list of students in the school
                return view('students/viewStudents', ['students'=> $students]);
            }
        }
    }
    public function viewStudentsTaughtByEmployee($id){
        //select all students who are in the class and do the subject taught by the teacher
        $students = Student::select('*')->where('class_id', EmployeeSubject::find($id)->class_id)->whereIn('id', StudentSubject::select('student_id')->where('subject_id', EmployeeSubject::find($id)->subject_id)->get())->get();
        return view('students/viewStudents', ['students'=>$students]);
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