<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Role;

class RolesController extends Controller
{
    public function index(){
        return view('roles/addRole');
    }

    public function store(Request $request){
        $input = $request->all();

        $rules = [
            'rolename'=>'required',
            'roleDesc'=>'required'
        ];

        $messages = [
            'rolename.required' => 'Role name is required',
            'roleDesc.required'=>'Role description is required'
        ];

        $validator = Validator::make($input, $rules, $messages);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        Role::create([
            'role_name' => $input['rolename'],
            'role_description' => $input['roleDesc']
        ]);

        return redirect('/viewroles')->with('message', 'Role added successfully!');
    }
    public function viewRoles(){
        $roles = Role::all();

        return view('roles/viewroles', ['roles'=> $roles]);
    }

    public function edit($id){
        $role = Role::find($id);

        return view('roles/editRole', ['role'=>$role]);
    }

    public function update(Request $request, $id){
        $input = $request->all();
        $role = Role::find($id);

        $rules = [
            'rolename' => 'required',
            'roleDesc' => 'required',
            'status' => 'required'
        ];

        $messages = [
            'rolename.required' => 'Role name is required',
            'roleDesc.required'=>'Role description is required'
        ];

        $validator = Validator::make($input, $rules, $messages);
        
        if ($validator->fails()) {
            return back()->withErrors($validator->messages());
        }

        $role->role_name= $input['rolename'];
        $role->role_description = $input['roleDesc'];
        $role->status = $input['status'];
        $role->save();

        return redirect('/viewroles')->with('message', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        $role->status = "Deleted";
        $role->save();

        return redirect('/viewroles')->with('message', 'Role deleted successfully!');
    }

    public static function getRoleName($id){
        $role = Role::find($id);

        return $role->role_name;
    }
}
