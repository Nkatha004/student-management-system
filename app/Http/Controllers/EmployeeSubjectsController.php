<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Subject;
use App\Models\EmployeeSubject;
use Illuminate\Http\Request;

class EmployeeSubjectsController extends Controller
{
    public function index($id){
        $employee = Employee::find($id);
        $employeesubjects = EmployeeSubject::all()->where('employee_id', $id);
        $subjects = Subject::all()->where('status', 'Active');
    
        return view('employees/addEmployeeSubjects', ['employee'=> $employee, 'employeesubjects'=> $employeesubjects, 'subjects'=>$subjects]);
    }

    public function store(Request $request){
        $request->validate([
            'employee' => 'required',
            'subject' => 'required'
        ]);

        EmployeeSubject::create([
            'employee_id' => request('employee'), 
            'subject_id' => request('subject')
        ]);

        return redirect("/employeesubjects/".request('employee'))->with("message", "Employee Subject added successfully");
    }

    public function edit($id){
        $employeesubject = EmployeeSubject::find($id);
        $subjects = Subject::all()->where('status', 'Active');

        return view('employees/editEmployeeSubject', ['employeesubject'=>$employeesubject, 'subjects'=>$subjects]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'subject' => 'required'
        ]);

        $employeesubject = EmployeeSubject::find($id);
        
        $employeesubject->subject_id= $request->input('subject');
        $employeesubject->status= $request->input('status');

        $employeesubject->save();

        return redirect("/employeesubjects/".request('employee'))->with("Employee Subject edited successfully");
    }

    public function destroy($id)
    {
        $employeesubject = EmployeeSubject::find($id);

        $employeesubject->status = "Deleted";
        $employeesubject->save();

        return redirect("/employeesubjects/".$employeesubject->employee_id)->with("Employee Subject deleted successfully");
    }
}
