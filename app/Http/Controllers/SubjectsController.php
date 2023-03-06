<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectCategories;
use App\Models\Subject;
use App\Models\School;

class SubjectsController extends Controller
{
    public function index(){
        $this->authorize('create',  Subject::class);

        $categories = SubjectCategories::all()->where('deleted_at', NULL);
        $schools = School::all()->where('deleted_at', NULL);

        return view('subjects/addSubject', ['categories'=> $categories, 'schools' => $schools]);
    }
    public function store(Request $request){
        $this->authorize('create',  Subject::class);

        $request->validate([
            'name' => 'required',
            'category'=>'required',
            'school' => 'required'
        ]);
        
        Subject::create([
            'subject_name' => request('name'),
            'category_id' => request('category'),
            'school_id' => request('school')
        ]);

        return redirect('/viewsubjects')->with('message', 'Subject added successfully!');
    }
    public function viewSubjects(){
        $this->authorize('viewAny',  Subject::class);

        $subjects = Subject::where('deleted_at', NULL)->get();

        return view('subjects/viewSubjects', ['subjects'=> $subjects]);
    }

    public function edit($id){
        $subject = Subject::find($id);
        $this->authorize('update',  $subject);

        $categories = SubjectCategories::all()->where('deleted_at', NULL);
        $schools = School::all()->where('deleted_at', NULL);

        return view('subjects/editSubject', ['subject'=> $subject,'categories'=> $categories, 'schools' => $schools]);
    }

    public function update(Request $request, $id){
        $subject = Subject::find($id);
        $this->authorize('update',  $subject);

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'school' => 'required'
        ]);

        $subject->subject_name= $request->input('name');
        $subject->category_id = $request->input('category');
        $subject->school_id = $request->input('school');
        $subject->save();

        return redirect('/viewsubjects')->with('message', 'Subject updated successfully!');
    }

    public function destroy($id, Subject $deleteSubject)
    {
        $this->authorize('delete',  $deleteSubject);
        $subject = Subject::find($id)->delete();
        
        return redirect('/viewsubjects')->with('message', 'Subject deleted successfully!');
    }

    public static function getSubjectName($id){
        if($id == NULL){
            return "Not found";
        }
        $subject = Subject::find($id);

        return $subject->subject_name;
    }

    //softDeletes subjects
    public function trashedSubjects(){
        $this->authorize('restore', Subject::class);

        $subjects = Subject::onlyTrashed()->get();
        return view('subjects/trashedSubjects', compact('subjects'));
    }

    //restore deleted subjects
    public function restoreSubject($id){
        $this->authorize('restore', Subject::class);

        Subject::whereId($id)->restore();
        return back();
    }

    //restore all deleted subjects
    public function restoreSubjects(){
        $this->authorize('restore', Subject::class);
        
        Subject::onlyTrashed()->restore();
        return back();
    }
}
