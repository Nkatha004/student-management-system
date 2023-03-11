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
        $this->authorize('create',  Classes::class);

        //exclude admin and principal from being class teachers
        $teachers = Employee::all()->where('deleted_at', NULL)->where('role_id', '!=', Role::IS_SUPERADMIN)->where('role_id', '!=', Role::IS_PRINCIPAL);
        if(Auth::user()->role_id != Role::IS_SUPERADMIN){
            $teachers = Employee::all()->where('deleted_at', NULL)
                                        ->where('role_id', '==', Role::IS_TEACHER)
                                        ->where('school_id', Auth::user()->school_id);
        }

        return view('classes/addClass', ['teachers'=>$teachers]);
    }
    public function store(Request $request){
        $this->authorize('create',  Classes::class);

        $request->validate([
            'classname' => 'required',
            'year' => 'required',
            'teacher'=>'required'
        ]);

        $school = Employee::all()->where('id', request('teacher'))->first()->school_id;

        Classes::create([
            'class_name' => request('classname'), 
            'year' => request('year'),
            'school_id' => $school,
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
        $this->authorize('viewAny',  Classes::class);

        if(Auth::user()->role_id == Role::IS_SUPERADMIN){
            $classes = Classes::where('deleted_at', NULL)->get();
        }else if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $classes = Classes::where('deleted_at', NULL)->where('school_id', Auth::user()->school_id)->get();
        }elseif (Auth::user()->role_id == Role::IS_CLASSTEACHER){
            $classes = Classes::where('deleted_at', NULL)->where('school_id', Auth::user()->school_id)->where('class_teacher', Auth::user()->id)->get();
        }else{
            $classes = Classes::where('deleted_at', NULL)->where('school_id', Auth::user()->school_id)->get();
        }
        return view('classes/viewclasses', ['classes'=> $classes]);
    }
    public function edit($id){
        $class = Classes::find($id);
        $this->authorize('update',  $class);

        $schools = School::all()->where('deleted_at', NULL)->where('payment_status', 'Payment Complete');
        $teachers = Employee::all()->where('deleted_at', NULL)->where('role_id', '!=', Role::IS_SUPERADMIN)->where('role_id', '!=', Role::IS_PRINCIPAL);

        return view('classes/editclass', ['class'=>$class, 'schools'=>$schools, 'teachers'=>$teachers]);
    }

    public function update(Request $request, $id){
        $class = Classes::find($id);
        $this->authorize('update',  $class);

        $request->validate([
            'classname' => 'required',
            'year' => 'required',
            'teacher'=>'required'
        ]);
        
        $class->class_name= $request->input('classname');
        $class->year = $request->input('year');
        $class->school_id = $request->input('school');
        $class->class_teacher = $request->input('teacher');

        $class->save();

        return redirect('/viewclasses')->with('message', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        $class = Classes::find($id);
        $this->authorize('delete',  $class);

        $class->delete();

        return redirect('/viewclasses')->with('message', 'Class deleted successfully!');
    }

    //softDeletes classes
    public function trashedClasses(){
        $this->authorize('restore',  Classes::class);

        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $classes = Classes::onlyTrashed()->get()->where('school_id', Auth::user()->school_id);
        }else{
            $classes = Classes::onlyTrashed()->get();
        }
        
        return view('classes/trashedClasses', compact('classes'));
    }

    //restore deleted classes
    public function restoreClass($id){
        $this->authorize('restore', Classes::class);

        Classes::whereId($id)->restore();
        return back();
    }

    //restore all deleted classes
    public function restoreClasses(){
        $this->authorize('restore',  Classes::class);

        Classes::onlyTrashed()->restore();
        return back();
    }

    public static function getClassName($id){
        if($id == NULL){
            return "Unassigned";
        }
        $class = Classes::find($id);

        return $class->class_name;
    }
    
}
