<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Classes;
use App\Models\Employee;
use App\Models\Role;
use Auth;

class ClassesController extends Controller
{
    public function index(){
        //exclude admin and principal from being class teachers
        $teachers = Employee::all()->where('status', 'Active')->where('role_id', '!=', '1')->where('role_id', '!=', '2');
        if(Auth::user()->role_id != 1){
            $teachers = Employee::all()->where('status', 'Active')
                                        ->where('role_id', '==', '3')
                                        ->where('school_id', Auth::user()->school_id);
        }

        return view('classes/addClass', ['teachers'=>$teachers]);
    }
    public function store(Request $request){
        $request->validate([
            'classname' => 'required',
            'year' => 'required',
            'teacher'=>'required'
        ]);
        if(request('school') == NULL){
            return redirect('/login')->with('message', "Please login to add a new class");
        }
        Classes::create([
            'class_name' => request('classname'), 
            'year' => request('year'),
            'school_id' => request('school'),
            'class_teacher'=>request('teacher')
        ]);

        //find the employee whose id is sent from the form and promote their role to a classteacher
        $employee = Employee::find(request('teacher'));
        $role = Role::all()->where('role_name', 'Class Teacher')->first();
        $employee->role_id = $role['id'];

        $employee->save();

        return redirect('/viewclasses')->with('message', 'Class added successfully!');

    }
    public function viewclasses(){
        if(Auth::user()->role_id == 1){
            $classes = Classes::where('status', 'Active')->paginate(10);
        }elseif (Auth::user()->role_id == 4){
            $classes = Classes::where('status', 'Active')->where('school_id', Auth::user()->school_id)->where('class_teacher', Auth::user()->id)->paginate(10);
        }else{
            $classes = Classes::where('status', 'Active')->where('school_id', Auth::user()->school_id)->paginate(10);
        }
        return view('classes/viewclasses', ['classes'=> $classes]);
    }
    public function edit($id){
        $class = Classes::find($id);
        $schools = School::all()->where('status', 'Active');
        $teachers = Employee::all()->where('status', 'Active')->where('role_id', '!=', '1')->where('role_id', '!=', '2');

        return view('classes/editclass', ['class'=>$class, 'schools'=>$schools, 'teachers'=>$teachers]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'classname' => 'required',
            'year' => 'required',
            'teacher'=>'required',
            'status'=>'required'
        ]);

        $class = Classes::find($id);
        
        $class->class_name= $request->input('classname');
        $class->year = $request->input('year');
        $class->school_id = $request->input('school');
        $class->class_teacher = $request->input('teacher');
        $class->status= $request->input('status');

        $class->save();

        return redirect('/viewclasses')->with('message', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        $class = Classes::find($id);

        $class->status = "Deleted";
        $class->save();

        return redirect('/viewclasses')->with('message', 'Class deleted successfully!');
    }

    public static function getClassName($id){
        if($id == NULL){
            return "Unassigned";
        }
        $class = Classes::find($id);

        return $class->class_name;
    }
    
}
