<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Classes;

class ClassesController extends Controller
{
    public function index(){
        $schools = School::all()->where('status', 'Active');

        return view('classes/addClass', ['schools'=>$schools]);
    }
    public function store(Request $request){
        $request->validate([
            'classname' => 'required',
            'year' => 'required'
        ]);
        if(request('school') == NULL){
            return redirect('/login')->with('message', "Please login to add a new class");
        }
        Classes::create([
            'class_name' => request('classname'), 
            'year' => request('year'),
            'school_id' => request('school')
        ]);

        return redirect('/viewclasses')->with('message', 'Class added successfully!');

    }
    public function viewclasses(){
        $classes = Classes::all();
       
        return view('classes/viewclasses', ['classes'=> $classes]);
    }
    public function edit($id){
        $class = Classes::find($id);
        $schools = School::all()->where('status', 'Active');

        return view('classes/editclass', ['class'=>$class, 'schools'=>$schools]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'classname' => 'required',
            'year' => 'required',
            'status'=>'required'
        ]);

        $class = Classes::find($id);
        
        $class->class_name= $request->input('classname');
        $class->year = $request->input('year');
        $class->school_id = $request->input('school');
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
