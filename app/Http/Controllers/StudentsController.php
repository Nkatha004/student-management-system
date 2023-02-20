<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use App\Models\Classes;
use App\Models\Role;
use App\Models\EmployeeSubject;
use App\Models\StudentSubject;
use Auth;

class StudentsController extends Controller
{
    public function index(){
        $this->authorize('create',  Student::class);

        $schools = School::all()->where('deleted_at', NULL);
        if(Auth::user()->role_id != Role::IS_CLASSTEACHER){
            $classes = Classes::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);
        }else{
            //allow class teacher to add students belonging to their class only
            $classes = Classes::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id)->where('class_teacher', Auth::user()->id);
        }
        return view('students/addStudent', ['schools'=>$schools, 'classes'=>$classes]);
    }
    public function store(Request $request){
        $this->authorize('create',  Student::class);

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
        $this->authorize('viewAny',  Student::class);

        //display all students only when admin is logged in        
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $students = Student::where('deleted_at', NULL)->get();
           
            return view('students/viewStudents', ['students'=> $students]);
        }
        //display students in the class where the logged in teacher is a classteacher only
        elseif(Auth::user()->role_id == Role::IS_CLASSTEACHER){
            $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')->where('deleted_at', NULL)->where('class_teacher', Auth::user()->id)->get())
                    ->get();
                    
           
            return view('students/viewStudents', ['students'=> $students]);
        }
        else{
            //display students specific to school of logged in user
            $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')
                    ->where('deleted_at', NULL)
                    ->where('school_id', Auth::user()->school_id)->get())
                    ->get();
    
            if(count($students) == 0){
                return view('students/viewStudents', ['students'=> $students]);
            }else{
                //return list of students in the school
                return view('students/viewStudents', ['students'=> $students]);
            }
        }
    }
    public function viewStudentsTaughtByEmployee($id){
        $this->authorize('viewAny',  Student::class);

        //select all students who are in the class and do the subject taught by the teacher
        $students = Student::select('*')->where('class_id', EmployeeSubject::find($id)->class_id)->whereIn('id', StudentSubject::select('student_id')->where('subject_id', EmployeeSubject::find($id)->subject_id)->get())->get();
        return view('students/viewStudentsToAddMarks', ['students'=>$students, 'subject'=>EmployeeSubject::find($id)->subject_id]);
    }
    public function viewStudentsToAddMarks($id){
        $this->authorize('viewAny',  Student::class);

        //display all students only when admin is logged in
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $students = Student::where('deleted_at', NULL)->get();
           
            return view('students/viewStudents', ['students'=> $students]);
        }
        //display students in the class where the logged in teacher is a classteacher only
        elseif(Auth::user()->role_id == Role::IS_CLASSTEACHER){
            $students = Student::select("*")
                    ->whereIn('class_id', Classes::select('id')->where('deleted_at', NULL)->where('class_teacher', Auth::user()->id)->get())
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
                    ->where('deleted_at', NULL)
                    ->where('school_id', Auth::user()->school_id)->get())
                    ->get();
    
            if(count($students) == 0){
                return view('students/viewStudents', ['message'=>'No students found!']);
            }else{
                //return list of students in the school
                return view('students/viewStudents', ['students'=> $students]);
            }
        }
        return view('students/viewStudentstoAddMarks', ['students'=>$students, 'subject'=>EmployeeSubject::find($id)->subject_id]);
    }
    
    public function edit($id, Student $editStudent){
        $this->authorize('update',  $editStudent);

        $student = Student::find($id);
        $classes = Classes::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);

        return view('students/editstudent', ['student'=>$student, 'classes' => $classes]);
    }

    public function update(Request $request, $id, Student $editStudent){
        $this->authorize('update',  $editStudent);

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

        $student->save();

        return redirect('/viewstudents')->with('message', 'Student updated successfully!');
    }

    public function destroy($id, Student $deleteStudent)
    {
        $this->authorize('delete',  $deleteStudent);

        $student = Student::find($id)->delete();
        return redirect('/viewstudents')->with('message', 'Student deleted successfully!');
    }

    public static function getStudentName($id){

        if($id == NULL){
            return "Not found";
        }
        
        $student = Student::find($id);
        return $student->first_name.' '.$student->last_name;
    }

    //softDeletes students
    public function trashedStudents(){
        $this->authorize('restore',  Student::class);

        $students = Student::onlyTrashed()->get();
        return view('students/trashedStudents', compact('students'));
    }

    //restore deleted students
    public function restoreStudent($id){
        $this->authorize('restore',  Student::class);

        Student::whereId($id)->restore();
        return back();
    }

    //restore all deleted students
    public function restoreStudents(){
        $this->authorize('restore',  Student::class);

        Student::onlyTrashed()->restore();
        return back();
    }
    
}