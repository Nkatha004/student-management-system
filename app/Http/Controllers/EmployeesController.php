<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\School;
use App\Models\Role;
use Hash;

class EmployeesController extends Controller
{
    public function index(){
        $schools = School::all()->where('status', 'Active');
        $roles = Role::all()->where('status', 'Active');

        return view('employees/addEmployee', ['schools'=>$schools, 'roles'=>$roles]);
    }
    public function store(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required | email | unique:employees',
            'telNo' => 'required',
            'password' => 'required | min:6',
            'password_confirmation' => 'required | min:6 | same:password',
            'tscNo' => 'required',
            'school' => 'required',
            'role' => 'required'
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

        return redirect('/viewemployees')->with('message', 'Employee added successfully!');

    }
    public function viewEmployees(){
        $employees = Employee::all();
       
        return view('employees/viewEmployees', ['employees'=> $employees]);
    }
    public function edit($id){
        $employee = Employee::find($id);
        $schools = School::all()->where('status', 'Active');
        $roles = Role::all()->where('status', 'Active');

        return view('employees/editEmployee', ['employee'=>$employee, 'schools'=>$schools, 'roles'=>$roles]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required | email',
            'telNo' => 'required',
            'tscNo' => 'required',
            'school' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        $employee = Employee::find($id);
        
        $employee->first_name= $request->input('fname');
        $employee->last_name= $request->input('lname');
        $employee->email = $request->input('email');
        $employee->telephone_number = $request->input('telNo');
        $employee->tsc_number = $request->input('tscNo');
        $employee->school_id = $request->input('school');
        $employee->role_id = $request->input('role');
        $employee->status= $request->input('status');

        $employee->save();

        return redirect('/viewemployees')->with('message', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        $employee->status = "Deleted";
        $employee->save();

        return redirect('/viewemployees')->with('message', 'Employee deleted successfully!');
    }
    
}
