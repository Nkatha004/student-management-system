<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Classes;
use App\Models\Employee;

class ClassesController extends Controller
{
    public function index(){
        //exclude admin and principal from being class teachers
        $teachers = Employee::all()->where('status', 'Active')->where('role_id', '!=', '1')->where('role_id', '!=', '2');

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

        return redirect('/viewclasses')->with('message', 'Class added successfully!');

    }
    public function viewclasses(){
        $classes = Classes::all()->where('status', 'Active');
       
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
