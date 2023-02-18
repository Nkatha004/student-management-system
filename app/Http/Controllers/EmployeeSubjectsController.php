<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SubjectsController;

use App\Models\Employee;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\EmployeeSubject;
use Illuminate\Http\Request;
use Auth;

class EmployeeSubjectsController extends Controller
{
    public function index($id){

        $this->authorize('viewAny',  EmployeeSubject::class);

        $employee = Employee::find($id);
        $employeesubjects = EmployeeSubject::all()->where('employee_id', $id)->where('deleted_at', NULL);
        $subjects = Subject::all()->where('deleted_at', NULL);
        $classes = Classes::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);
        return view('employees/addEmployeeSubjects', ['employee'=> $employee, 'employeesubjects'=> $employeesubjects, 'subjects'=>$subjects, 'classes'=>$classes]);
    }

    public function store(Request $request){

        $this->authorize('create',  EmployeeSubject::class);

        $request->validate([
            'employee' => 'required',
            'subject' => 'required',
            'class' => 'required'
        ]);

        $empsubjects = EmployeeSubject::all()->where('subject_id', request('subject'))->where('class_id', request('class'));

        foreach($empsubjects as $empsubject){
            if($empsubject->class_id == request('class') && $empsubject->subject_id == request('subject')){
                return redirect("/employeesubjects/".request('employee'))->with("message", "There already exists ".SubjectsController::getSubjectName(request('subject'))." teacher for ".ClassesController::getClassName(request('class')));
            }
        }
        EmployeeSubject::create([
            'employee_id' => request('employee'), 
            'subject_id' => request('subject'),
            'class_id' => request('class')
        ]);

        return redirect("/employeesubjects/".request('employee'))->with("message", "Employee Subject added successfully");
    }

    public function edit($id, EmployeeSubject $employeesubject){

        $this->authorize('update',  $employeesubject);

        $employeesubject = EmployeeSubject::find($id);
        $subjects = Subject::all()->where('deleted_at', NULL);
        $classes = Classes::all()->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id);

        return view('employees/editEmployeeSubject', ['employeesubject'=>$employeesubject, 'subjects'=>$subjects, 'classes'=>$classes]);
    }

    public function update(Request $request, $id, EmployeeSubject $employeesubject){

        $this->authorize('update',  $employeesubject);

        $request->validate([
            'subject' => 'required',
            'class' => 'required'
        ]);

        $employeesubject = EmployeeSubject::find($id);
        
        $employeesubject->subject_id= $request->input('subject');
        $employeesubject->class_id= $request->input('class');

        $employeesubject->save();

        return redirect("/employeesubjects/".request('employee'))->with("Employee Subject edited successfully");
    }

    public function destroy($id, EmployeeSubject $employeesubject)
    {
        $this->authorize('delete',  $employeesubject);

        $employeesubject = EmployeeSubject::find($id);
        $employeesubject->delete();

        return redirect("/employeesubjects/".$employeesubject->employee_id)->with("Employee Subject deleted successfully");
    }

    //softDeletes employeesubjects
    public function trashedEmployeeSubjects(){
        $this->authorize('restore',  EmployeeSubject::class);

        $employeesubjects = EmployeeSubject::onlyTrashed()->get();
        return view('employees/trashedEmployeeSubjects', compact('employeesubjects'));
    }

    //restore deleted employeesubject
    public function restoreEmployeeSubject($id){
        $this->authorize('restore',  Employee::class);

        EmployeeSubject::whereId($id)->restore();
        return back();
    }

    //restore all deleted employeesubjects
    public function restoreEmployeeSubjects(){
        $this->authorize('restore',  Employee::class);
        
        EmployeeSubject::onlyTrashed()->restore();
        return back();
    }
}
