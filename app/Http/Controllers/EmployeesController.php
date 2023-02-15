<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\School;
use App\Models\Role;
use Hash;
use Auth;

class EmployeesController extends Controller
{
    public function index(){
        $schools = School::all()->where('deleted_at', NULL)->where('id', '!=', '1');
        $roles = Role::all()->where('deleted_at', NULL);

        return view('employees/addEmployee', ['schools'=>$schools, 'roles'=>$roles]);
    }
    public function store(Request $request){
        //Form validation
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required | email | unique:employees',
            'telNo' => 'required',
            'password' => 'required | min:6',
            'password_confirmation' => 'required | min:6 | same:password'
        ]);

        Employee::create([
            'first_name' => request('fname'), 
            'last_name' => request('lname'),
            'tsc_number' => request('tscNo'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'telephone_number' => request('telNo'),
            'school_id' => request('school'),
            'role_id' => request('role')
        ]);

        //Return a view of all employees
        return redirect('/viewemployees')->with('message', 'Employee added successfully!');

    }
    public function viewEmployees(){
        if(Auth::user()->role_id == 1){
            $employees = Employee::orderBy('role_id')->where('deleted_at', NULL)->get();
        }else if(Auth::user()->role_id == 2){
            //display employees in the same school as logged in user
            $employees = Employee::orderBy('role_id')->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id)->get();
        }
        return view('employees/viewEmployees', ['employees'=> $employees]);
    }
    public function edit($id){
        $employee = Employee::find($id);
        $schools = School::all()->where('deleted_at', NULL)->where('id', '!=', '1');
        $roles = Role::all()->where('deleted_at', NULL)->where('id' ,'!=' ,'1')->where('id', '!=' ,'2');

        return view('employees/editEmployee', ['employee'=>$employee, 'schools'=>$schools, 'roles'=>$roles]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required | email',
            'telNo' => 'required',
            'status' => 'required'
        ]);

        $employee = Employee::find($id);
        
        $employee->first_name= $request->input('fname');
        $employee->last_name= $request->input('lname');
        $employee->email = $request->input('email');
        $employee->telephone_number = $request->input('telNo');
        $employee->tsc_number = $request->input('tscNo');
    
        $employee->save();

        return redirect('/viewemployees')->with('message', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id)->delete();

        return redirect('/viewemployees')->with('message', 'Employee deleted successfully!');
    }

    public static function getEmployeeName($id){
        if($id == NULL){
            return "Not found";
        }
        $employee = Employee::find($id);

        return $employee->first_name.' '.$employee->last_name;
    }
    
}
