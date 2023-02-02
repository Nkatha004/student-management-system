<?php

namespace App\Http\Controllers;
use App\Models\ExamMark;
use App\Models\Student;
use App\Models\StudentSubject;

use Illuminate\Http\Request;

class ExamMarksController extends Controller
{
    public function index($id){
        $student = Student::find($id);
        $studentsubjects = StudentSubject::all()->where('status', 'Active')->where('student_id', $id);
        return view('exams.addExamMarks', ['student'=>$student, 'studentsubjects'=>$studentsubjects]);
    }
}
