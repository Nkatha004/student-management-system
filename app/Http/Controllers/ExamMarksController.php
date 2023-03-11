<?php

namespace App\Http\Controllers;
use App\Http\Controllers\StudentSubjectsController;
use App\Http\Controllers\SubjectsController;
use App\Models\ExamMark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Role;
use App\Models\School;
use App\Models\StudentSubject;
use App\Models\EmployeeSubject;
use Auth;
use Illuminate\Http\Request;

class ExamMarksController extends Controller
{
    public function index($studentID, $subjectID){
        $studentsubjects = StudentSubject::select('*')->where('deleted_at', NULL)
                                                ->where('student_id', Student::find($studentID)->id)
                                                ->where('subject_id', Subject::find($subjectID)->id)
                                                ->get()
                                                ->first();
        if($studentsubjects){
            $this->authorize('createMark',  $studentsubjects);

            //find the subjects done by the student
            $subjects = StudentSubject::select('*')->where('deleted_at', NULL)
                                                            ->where('student_id', Student::find($studentID)->id)
                                                            ->get();
            //find the student subject done by the student
            $studentsubjects = StudentSubject::select('*')->where('deleted_at', NULL)
                                                    ->where('student_id', Student::find($studentID)->id)
                                                    ->where('subject_id', Subject::find($subjectID)->id)
                                                    ->get()
                                                    ->first();

            return view('exams.addExamMarks', ['student'=>Student::find($studentID),'subject'=>Subject::find($subjectID), 'studentsubjects'=>$studentsubjects, 'subjects'=>$subjects]);
        }else{
            return redirect()->with('message', 'No student does the selected subject');
        }
    }
    public function store(Request $request){
        $this->authorize('create',  ExamMark::class);

        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $request->validate([
                'subject' => 'required'
            ]);
        }

        $request->validate([
            'term' => 'required',
            'mark' => 'required'
        ]);
        
        $year = date('Y');
        //get the subject and validate it is actually taught by that teacher
        $subject = request('subject');

        //get the exam marks so that you can validate the results for the specific term and student do not already exist
        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $studentsubject = StudentSubject::select('id')->where('student_id', request('student_id'))->where('subject_id', request('subject'))->get()->first()->id;
            $exams = ExamMark::where('student_subject_id', $studentsubject)->get();
        }else{
            $studentsubject = request('studentSubject');

            $exams = ExamMark::all()->where('student_subject_id', $studentsubject);
        }
        foreach($exams as $exam){
            if($year == $exam->year && request('term') == $exam->term){
                $studentName = StudentSubjectsController::getStudentName(request('student_id'));
                return redirect('/marks/'.StudentSubject::find($studentsubject)->student_id.'/'.StudentSubject::find($studentsubject)->subject_id)->with('message', 'Marks for '.$studentName.' for '.$request->term.' '.$year.' '.' already exist!'); 
            }
        }
        
        ExamMark::create([
            'student_subject_id' => $studentsubject,
            'mark' => request('mark'), 
            'year' => $year,
            'term' => request('term'),
            'added_by' => Auth::user()->id
        ]);
        //Get the class of the student
        $class = Student::all()->where('admission_number', request('admission'))->first()->class_id;
        return redirect('/viewclassmarks/'.$class);

    }
    public function viewClassMarks($id, request $request){
        $this->authorize('view',  Classes::find($id));

        $subjects = Subject::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);
        
        if(Auth::user()->role_id == Role::IS_CLASSTEACHER){
            //marks of all students in the class
            $marks = ExamMark::when($request->subject != null, function($query) use($request, $id){
                                            return $query->whereIn('student_subject_id', StudentSubject::select('id')
                                                            ->where('subject_id', $request->subject)
                                                            ->whereIn('student_id', Student::select("id")
                                                            ->where('class_id', $id)
                                                            ->whereIn('class_id', Classes::select('id')
                                                            ->where('deleted_at', NULL)
                                                            ->where('class_teacher', Auth::user()->id))));
                                        })
                                        ->when($request->term != null, function($query) use($request, $id){
                                            return $query->where('term', $request->term)
                                                            ->whereIn('student_subject_id', StudentSubject::select('id')
                                                            ->whereIn('student_id', Student::select("id")
                                                            ->where('class_id', $id)
                                                            ->whereIn('class_id', Classes::select('id')
                                                            ->where('deleted_at', NULL)
                                                            ->where('class_teacher', Auth::user()->id))));
                                        })
                                        
                                        ->whereIn('student_subject_id', StudentSubject::select('id')
                                        ->whereIn('student_id', Student::select("id")
                                        ->where('class_id', $id)
                                        ->whereIn('class_id', Classes::select('id')
                                        ->where('deleted_at', NULL)
                                        ->where('class_teacher', Auth::user()->id))))->get();
        }else{
            $marks = ExamMark::when($request->subject != null, function($query) use($request, $id){
                                            return $query->whereIn('student_subject_id', StudentSubject::select('id')
                                                        ->where('subject_id', $request->subject)
                                                        ->whereIn('student_id', Student::select("id")
                                                        ->where('class_id', $id)
                                                        ->where('deleted_at', NULL)));
                                })
                                ->when($request->term != null, function($query) use($request, $id){
                                    return $query->where('term', $request->term)
                                                ->whereIn('student_subject_id', StudentSubject::select('id')
                                                ->whereIn('student_id', Student::select("id")
                                                ->where('class_id', $id)
                                                ->where('deleted_at', NULL)));
                                })    
                                ->whereIn('student_subject_id', StudentSubject::select('id')
                                ->whereIn('student_id', Student::select("id")
                                ->where('class_id', $id)
                                ->where('deleted_at', NULL)))->get();
        }

        return view('exams/viewAllMarks', ['marks'=>$marks, 'classID'=>$id, 'subjects'=>$subjects]);
    }

    public function edit($id, $class){
        $marks = ExamMark::find($id);
        $this->authorize('update',  $marks);
        
        $studentsubject = StudentSubject::find($marks->student_subject_id);
        $student = Student::find($studentsubject->student_id);

        return view('exams/editExamMark', ['marks'=>$marks, 'class'=>$class, 'student'=>$student, 'studentsubject'=>$studentsubject]);
    }

    public function update(Request $request, $id, $class){
        $mark = ExamMark::find($id);
        $this->authorize('update',  $mark);

        $request->validate([
            'mark' => 'required'
        ]);

        $mark->mark= $request->input('mark');

        $mark->save();

        return redirect('/viewclassmarks/'.$class)->with('message', 'Marks updated successfully!');
    }

    public function destroy($id, $class){
        $mark = ExamMark::find($id);
        $this->authorize('delete',  $mark);

        $mark->delete();

        return redirect('/viewclassmarks/'.$class)->with('message', 'Mark deleted successfully!');
    }

    //softDeletes exam mark
    public function trashedExamMarks(){
        $this->authorize('restore',  ExamMark::class);

        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $marks = ExamMark::onlyTrashed()->get()->whereIn('student_subject_id', StudentSubject::select('id')->whereIn('student_id', Student::select('id')->whereIn('class_id', Classes::select('id')->where('school_id', Auth::user()->school_id))));
        }else{
            $marks = ExamMark::onlyTrashed()->get();
        }
        
        return view('exams/trashedExamMarks', compact('marks'));
    }

    //restore deleted exam mark
    public function restoreExamMark($id){
        $this->authorize('restore',  ExamMark::class);

        ExamMark::whereId($id)->restore();
        return back();
    }

    //restore all deleted exam marks
    public function restoreExamMarks(){
        $this->authorize('restore',  ExamMark::class);
        
        ExamMark::onlyTrashed()->restore();
        return back();
    }
}
