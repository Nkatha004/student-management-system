<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\School;
use App\Models\Role;
use Hash;
use Auth;

class EmployeesController extends Controller
{
    public function index(){
        $this->authorize('create',  Employee::class);

        $schools = School::all()->where('deleted_at', NULL)->where('payment_status', 'Payment Complete');
        $roles = Role::all()->where('deleted_at', NULL);

        return view('employees/addEmployee', ['schools'=>$schools, 'roles'=>$roles]);
    }
    public function store(Request $request){
        $this->authorize('create',  Employee::class);

        //Form validation
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required | email | unique:employees',
            'telNo' => 'required',
            'gender' => 'required',
            'password' => [
                'required',
                Password::min(8)
                            ->letters()
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                            ->uncompromised(3)
            ],
            'password_confirmation' => 'required | same:password'
        ]);

        Employee::create([
            'first_name' => request('fname'), 
            'last_name' => request('lname'),
            'tsc_number' => request('tscNo'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'telephone_number' => request('telNo'),
            'gender' => request('gender'),
            'school_id' => request('school'),
            'role_id' => request('role')
        ]);

        //Return a view of all employees
        return redirect('/viewemployees')->with('message', 'Employee added successfully!');

    }
    public function viewEmployees(){
        $this->authorize('viewAny',  Employee::class);

        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $employees = Employee::orderBy('role_id')->where('deleted_at', NULL)->get();
        }else if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            //display employees in the same school as logged in user
            $employees = Employee::orderBy('role_id')->where('deleted_at', NULL)->where('school_id', Auth::user()->school_id)->get();
        }
        return view('employees/viewEmployees', ['employees'=> $employees]);
    }
    public function edit($id){
        $employee = Employee::find($id);
        $this->authorize('update',  $employee);

        $schools = School::all()->where('deleted_at', NULL)->where('payment_status', 'Payment Complete');

        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $roles = Role::all()->where('deleted_at', NULL);
        }else{
            $roles = Role::all()->where('deleted_at', NULL)->where('id' ,'!=' ,Role::IS_SUPERADMIN)->where('id', '!=' , Role::IS_PRINCIPAL);
        }

        return view('employees/editEmployee', ['employee'=>$employee, 'schools'=>$schools, 'roles'=>$roles]);
    }

    public function update(Request $request, $id){
        $employee = Employee::find($id);
        $this->authorize('update',  $employee);

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required | email',
            'telNo' => 'required | min: 9',
            'gender' => 'required',
            'role' => 'required'
        ]);
        
        $employee->first_name= $request->input('fname');
        $employee->last_name= $request->input('lname');
        $employee->email = $request->input('email');
        $employee->telephone_number = $request->input('telNo');
        $employee->tsc_number = $request->input('tscNo');
        $employee->gender = $request->input('gender');
        $employee->role_id = $request->input('role');
    
        $employee->save();

        return redirect('/viewemployees')->with('message', 'Employee updated successfully!');
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $this->authorize('delete',  $employee);

        $employee->delete();

        return redirect('/viewemployees')->with('message', 'Employee deleted successfully!');
    }

    //softDeletes employees
    public function trashedEmployees(Employee $employee){
        $this->authorize('restore',  Employee::class);

        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $employees = Employee::onlyTrashed()->get()->where('school_id', Auth::user()->school_id);
        }else{
            $employees = Employee::onlyTrashed()->get();
        }
        return view('employees/trashedEmployees', compact('employees'));
    }

    //restore deleted employees
    public function restoreEmployee($id){
        $this->authorize('restore',  Employee::class);

        Employee::whereId($id)->restore();
        return back();
    }

    //restore all deleted employees
    public function restoreEmployees(){
        $this->authorize('restore',  Employee::class);

        Employee::onlyTrashed()->restore();
        return back();
    }

    public static function getEmployeeName($id){
        if($id == NULL){
            return "Not found";
        }
        $employee = Employee::find($id);

        return $employee->first_name.' '.$employee->last_name;
    }
}
