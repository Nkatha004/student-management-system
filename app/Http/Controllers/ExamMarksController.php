<?php

namespace App\Http\Controllers;
use App\Http\Controllers\StudentSubjectsController;
use App\Http\Controllers\SubjectsController;
use App\Models\ExamMark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\StudentSubject;
use Auth;

use Illuminate\Http\Request;

class ExamMarksController extends Controller
{
    public function index($studentID, $subjectID){
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

        // foreach($exams as $exam){
        //     if($year == $exam->year && request('term') == $exam->term){
        //         $studentName = StudentSubjectsController::getStudentName(request('studentSubject'));
        //         return redirect('/marks/'.StudentSubject::find(request('studentSubject'))->student_id.'/'.StudentSubject::find(request('studentSubject'))->subject_id)->with('message', 'Marks for '.$studentName.' for '.$request->term.' '.$year.' '.' already exist!'); 
        //     }
        // }
        // ExamMark::create([
        //     'student_subject_id' => request('studentSubject'),
        //     'mark' => request('mark'), 
        //     'year' => $year,
        //     'term' => request('term'),
        //     'added_by' => Auth::user()->id
        // ]);
        return redirect('/viewmarks/'.request('subjectID'));

    }
    public function viewMarks($id){
        $subject = SubjectsController::getSubjectName($id);
        $marks = ExamMark::all()->where('status', 'Active')->where('added_by', Auth::user()->id);
        $term1Marks = ExamMark::all()->where('status', 'Active')->where('added_by', Auth::user()->id)->where('term', 'Term 1');
        $term2Marks = ExamMark::all()->where('status', 'Active')->where('added_by', Auth::user()->id)->where('term', 2);
        $term3Marks = ExamMark::all()->where('status', 'Active')->where('added_by', Auth::user()->id)->where('term', 3);

        return view('exams/viewMarks', ['term1Marks'=> $term1Marks, 'term2Marks'=> $term2Marks, 'term3Marks'=> $term3Marks, 'marks'=>$marks, 'subject'=>$subject]);
    }
}
