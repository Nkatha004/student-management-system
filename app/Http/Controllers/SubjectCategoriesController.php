<?php

namespace App\Http\Controllers;
use App\Http\Controllers\SchoolsController;

use Illuminate\Http\Request;
use App\Models\SubjectCategories;
use App\Models\School;
use App\Models\Role;
use Auth;

class SubjectCategoriesController extends Controller
{
    public function index(){
        $this->authorize('create',  SubjectCategories::class);
        $schools = School::all()->where('deleted_at', NULL)->where('payment_status', 'Payment Complete');

        return view('subjectCategories/addSubjectCategory', ['schools' => $schools]);
    }
    public function store(Request $request){
        $this->authorize('create',  SubjectCategories::class);

        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
            'school' => 'required'
        ]);

        if($this->canAddRecord(request('category_name'), request('school'))){
            SubjectCategories::create([
                'category_name' => request('category_name'),
                'description' => request('description'),
                'school_id' => request('school')
            ]);
            return redirect('/viewsubjectcategories')->with('message', 'Subject category added successfully!');
        }else{
            return redirect('/subjectcategories')->with('messageWarning', request('category_name')." already exists for ".SchoolsController::getSchoolName(request('school')));
        }
    }
    public function viewSubjectCategories(){
        $this->authorize('viewAny',  SubjectCategories::class);

        $categories = SubjectCategories::where('deleted_at', NULL)->get();

        return view('subjectCategories/viewSubjectCategories', ['categories'=> $categories]);
    }

    public function edit($id){
        $category = SubjectCategories::find($id);
        $this->authorize('update',  $category);

        return view('subjectCategories/editSubjectCategory', ['category'=>$category]);
    }

    public function update(Request $request, $id){
        $category = SubjectCategories::find($id);
        $this->authorize('update',  $category);

        $request->validate([
            'category_name' => 'required',
            'description' => 'required'
        ]);
        
        $category->category_name= $request->input('category_name');
        $category->description = $request->input('description');
        $category->save();

        return redirect('/viewsubjectcategories')->with('message', 'Subject category updated successfully!');
    }

    public function destroy($id)
    {
        $category = SubjectCategories::find($id);
        $category->delete();

        $this->authorize('delete',  $category);

        return redirect('/viewsubjectcategories')->with('message', 'Subject category deleted successfully!');
    }

    public static function getSubjectCategoryName($id){
        if($id == NULL){
            return "Not found";
        }
        $category = SubjectCategories::find($id);

        return $category->category_name;
    }

    public static function canAddRecord($category, $school){
        $categories = SubjectCategories::all()->where('category_name', $category)->where('school_id', $school);

        if(count($categories) > 0){
            return false;
        }else{
            return true;
        }
    }

    //softDeletes categories
    public function trashedCategories(){
        $this->authorize('restore',  SubjectCategories::class);

        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            $categories = SubjectCategories::onlyTrashed()->get()->where('school_id', Auth::user()->school_id);
        }else{
            $categories = SubjectCategories::onlyTrashed()->get();
        }

        return view('subjectCategories/trashedSubjectCategories', compact('categories'));
    }

    //restore deleted category
    public function restoreCategory($id){
        $this->authorize('restore',  SubjectCategories::class);
    
        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            SubjectCategories::whereId($id)->where('school_id', Auth::user()->school_id)->restore();
        }else{
            SubjectCategories::whereId($id)->restore();
        }
        
        return back();
    }

    //restore all deleted categories
    public function restoreCategories(){
        $this->authorize('restore',  SubjectCategories::class);
        
        if(Auth::user()->role_id == Role::IS_PRINCIPAL){
            SubjectCategories::onlyTrashed()->where('school_id', Auth::user()->school_id)->restore();
        }else{
            SubjectCategories::onlyTrashed()->restore();
        }

        return back();
    }
}
