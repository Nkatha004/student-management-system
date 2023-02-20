<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Role;

class RolesController extends Controller
{
    public function index(){
        $this->authorize('create',  Role::class);

        return view('roles/addRole');
    }

    public function store(Request $request){
        $this->authorize('create',  Role::class);

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
        $this->authorize('viewAny',  Role::class);

        $roles = Role::where('deleted_at', NULL)->get();

        return view('roles/viewroles', ['roles'=> $roles]);
    }

    public function edit($id, Role $role){
        $this->authorize('update',  $role);

        $role = Role::find($id);

        return view('roles/editRole', ['role'=>$role]);
    }

    public function update(Request $request, $id, Role $role){
        $this->authorize('update',  $role);

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
        $role->save();

        return redirect('/viewroles')->with('message', 'Role updated successfully!');
    }

    public function destroy($id, Role $role)
    {
        $this->authorize('delete',  $role);

        $role = Role::find($id)->delete();
        return redirect('/viewroles')->with('message', 'Role deleted successfully!');
    }

    //softDeletes roles
    public function trashedRoles(){
        $this->authorize('restore',  Role::class);

        $roles = Role::onlyTrashed()->get();
        return view('roles/trashedRoles', compact('roles'));
    }

    //restore deleted role
    public function restoreRole($id){
        $this->authorize('restore',  Role::class);

        Role::whereId($id)->restore();
        return back();
    }

    //restore all deleted roles
    public function restoreRoles(){
        $this->authorize('restore',  Role::class);
        
        Role::onlyTrashed()->restore();
        return back();
    }

    public static function getRoleName($id){
        if($id == NULL){
            return "Not found";
        }
        $role = Role::find($id);

        return $role->role_name;
    }
}
