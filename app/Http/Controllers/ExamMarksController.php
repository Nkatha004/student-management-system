<?php

namespace App\Http\Controllers;
use App\Http\Controllers\StudentSubjectsController;
use App\Http\Controllers\SubjectsController;
use App\Models\ExamMark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\School;
use App\Models\StudentSubject;
use Auth;

use Illuminate\Http\Request;

class ExamMarksController extends Controller
{
    public function index($studentID, $subjectID){
        //find the student subject done by the student
        $studentsubjects = StudentSubject::select('*')->where('status', 'Active')
                                                ->where('student_id', Student::find($studentID)->id)
                                                ->where('subject_id', Subject::find($subjectID)->id)
                                                ->get()
                                                ->first();

        return view('exams.addExamMarks', ['student'=>Student::find($studentID),'subject'=>Subject::find($subjectID), 'studentsubjects'=>$studentsubjects]);
    }
    public function store(Request $request){
        $request->validate([
            'term' => 'required',
            'mark' => 'required'
        ]);
        
        $year = date('Y');

        //get the exam marks so that you can validate the results for the specific term and student do not already exist
        $exams = ExamMark::all()->where('student_subject_id', request('studentSubject'));

        foreach($exams as $exam){
            if($year == $exam->year && request('term') == $exam->term){
                $studentName = StudentSubjectsController::getStudentName(request('studentSubject'));
                return redirect('/marks/'.StudentSubject::find(request('studentSubject'))->student_id.'/'.StudentSubject::find(request('studentSubject'))->subject_id)->with('message', 'Marks for '.$studentName.' for '.$request->term.' '.$year.' '.' already exist!'); 
            }
        }
        ExamMark::create([
            'student_subject_id' => request('studentSubject'),
            'mark' => request('mark'), 
            'year' => $year,
            'term' => request('term'),
            'added_by' => Auth::user()->id
        ]);
        return redirect('/viewmarks/'.request('subjectID'));

    }
    public function viewMarks($id){
        
        $subject = SubjectsController::getSubjectName($id);
        $marks = ExamMark::all()->where('status', 'Active')->where('added_by', Auth::user()->id);
    
        return view('exams/viewMarks', ['marks'=>$marks, 'subject'=>$subject]);
    }

    public function viewClassMarks(){
        if(Auth::user()->role_id == 4){
            //marks of all students in the class
            $marks = ExamMark::select('*')->whereIn('student_subject_id', StudentSubject::select('id')
                                        ->whereIn('student_id', Student::select("id")
                                        ->whereIn('class_id', Classes::select('id')
                                        ->where('status', 'Active')
                                        ->where('class_teacher', Auth::user()->id)->get())))
                                        ->get();
        }else{
            $marks = ExamMark::select('*')->whereIn('student_subject_id', StudentSubject::select('id')
                                        ->whereIn('student_id', Student::select("id")
                                        ->whereIn('class_id', Classes::select('id')
                                        ->where('status', 'Active')->get())))
                                        ->get();
        }

        return view('exams/viewAllMarks', ['marks'=>$marks]);
    }
    public function viewSchoolMarks(){
        if(Auth::user()->role_id == 2){
            //marks of all students in the class
            $marks = ExamMark::select('*')->whereIn('student_subject_id', StudentSubject::select('id')
                                        ->whereIn('student_id', Student::select("id")
                                        ->whereIn('class_id', Classes::select('id')
                                        ->where('status', 'Active')
                                        ->whereIn('school_id', School::select('id')->where('id', Auth::user()->school_id)->get())
                                        ->get())))
                                        ->get();
        }

        return view('exams/viewAllMarks', ['marks'=>$marks]);
    }

    public function edit($id){
        $marks = ExamMark::find($id);
        $studentsubject = StudentSubject::find($marks->student_subject_id);
        $student = Student::find($studentsubject->student_id);

        return view('exams/editExamMark', ['marks'=>$marks, 'student'=>$student, 'studentsubject'=>$studentsubject]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'mark' => 'required',
            'status' => 'required'
        ]);
        
        $mark = ExamMark::find($id);
        $mark->mark= $request->input('mark');
        $mark->status= $request->input('status');

        $mark->save();

        return redirect('/viewclassmarks')->with('message', 'Marks updated successfully!');
    }

    public function delete(){
        $mark = ExamMark::find($id);

        $mark->status = "Deleted";
        $mark->save();

        return redirect('/viewclassmarks')->with('message', 'Mark deleted successfully!');
    }

}
