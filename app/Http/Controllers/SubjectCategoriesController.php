<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectCategories;

class SubjectCategoriesController extends Controller
{
    public function index(){
        return view('subjectCategories/addSubjectCategory');
    }
    public function store(Request $request){
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
        $categories = SubjectCategories::where('deleted_at', NULL)->get();

        return view('subjectCategories/viewSubjectCategories', ['categories'=> $categories]);
    }

    public function edit($id){
        $category = SubjectCategories::find($id);

        return view('subjectCategories/editSubjectCategory', ['category'=>$category]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $category = SubjectCategories::find($id);
        
        $category->category_name= $request->input('category_name');
        $category->description = $request->input('description');
        $category->save();

        return redirect('/viewsubjectcategories')->with('message', 'Subject category updated successfully!');
    }

    public function destroy($id)
    {
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
}
