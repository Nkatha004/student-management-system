<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectCategories;
use App\Models\Subject;

class SubjectsController extends Controller
{
    public function index(){
        $categories = SubjectCategories::all()->where('status', 'Active');

        return view('subjects/addSubject', ['categories'=> $categories ]);
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'category'=>'required'
        ]);
        
        Subject::create([
            'subject_name' => request('name'),
            'category_id' => request('category')
        ]);

        return redirect('/viewsubjects')->with('message', 'Subject added successfully!');
    }
    public function viewSubjects(){
        $subjects = Subject::where('status', 'Active')->paginate(10);

        return view('subjects/viewSubjects', ['subjects'=> $subjects]);
    }

    public function edit($id){
        $subject = Subject::find($id);
        $categories = SubjectCategories::all()->where('status', 'Active');

        return view('subjects/editSubject', ['subject'=> $subject,'categories'=> $categories]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'status' => 'required'
        ]);

        $subject = Subject::find($id);
        
        $subject->subject_name= $request->input('name');
        $subject->category_id = $request->input('category');
        $subject->status= $request->input('status');
        $subject->save();

        return redirect('/viewsubjects')->with('message', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);

        $subject->status = "Deleted";
        $subject->save();

        return redirect('/viewsubjects')->with('message', 'Subject deleted successfully!');
    }

    public static function getSubjectName($id){
        if($id == NULL){
            return "Not found";
        }
        $subject = Subject::find($id);

        return $subject->subject_name;
    }
}
