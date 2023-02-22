<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectCategories;

class SubjectCategoriesController extends Controller
{
    public function index(){
        $this->authorize('create',  SubjectCategories::class);

        return view('subjectCategories/addSubjectCategory');
    }
    public function store(Request $request){
        $this->authorize('create',  SubjectCategories::class);

        $request->validate([
            'category_name' => 'required',
            'description' => 'required'
        ]);
        SubjectCategories::create([
            'category_name' => request('category_name'),
            'description' => request('description')
        ]);

        return redirect('/viewsubjectcategories')->with('message', 'Subject category added successfully!');
    }
    public function viewSubjectCategories(){
        $this->authorize('viewAny',  SubjectCategories::class);

        $categories = SubjectCategories::where('deleted_at', NULL)->get();

        return view('subjectCategories/viewSubjectCategories', ['categories'=> $categories]);
    }

    public function edit($id, SubjectCategories $subjectCategory){
        $this->authorize('update',  $subjectCategory);

        $category = SubjectCategories::find($id);

        return view('subjectCategories/editSubjectCategory', ['category'=>$category]);
    }

    public function update(Request $request, $id, SubjectCategories $subjectCategory){
        $this->authorize('update',  $subjectCategory);

        $request->validate([
            'category_name' => 'required',
            'description' => 'required'
        ]);

        $category = SubjectCategories::find($id);
        
        $category->category_name= $request->input('category_name');
        $category->description = $request->input('description');
        $category->save();

        return redirect('/viewsubjectcategories')->with('message', 'Subject category updated successfully!');
    }

    public function destroy($id, SubjectCategories $subjectCategory)
    {
        $this->authorize('delete',  $subjectCategory);

        $category = SubjectCategories::find($id)->delete();

        return redirect('/viewsubjectcategories')->with('message', 'Subject category deleted successfully!');
    }

    public static function getSubjectCategoryName($id){
        if($id == NULL){
            return "Not found";
        }
        $category = SubjectCategories::find($id);

        return $category->category_name;
    }

    //softDeletes categories
    public function trashedCategories(){
        $this->authorize('restore',  SubjectCategories::class);

        $categories = SubjectCategories::onlyTrashed()->get();
        return view('subjectCategories/trashedSubjectCategories', compact('categories'));
    }

    //restore deleted categories
    public function restoreCategory($id){
        $this->authorize('restore',  SubjectCategories::class);

        SubjectCategories::whereId($id)->restore();
        return back();
    }

    //restore all deleted categories
    public function restoreCategories(){
        $this->authorize('restore',  SubjectCategories::class);
        
        SubjectCategories::onlyTrashed()->restore();
        return back();
    }
}
