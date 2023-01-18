<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function index(){
        return view('bityarn/roles/addRole');
    }

    public function store(Request $request){
        $request->validate([
            'rolename'=>'required',
            'roleDesc'=>'required'
        ]);
        Role::create([
            'role_name' => request('rolename'),
            'role_description' => request('roleDesc')
        ]);

        return redirect('/bityarn/viewroles')->with('message', 'Role added successfully!');
    }
    public function viewRoles(){
        $roles = Role::all();

        return view('bityarn/roles/viewroles', ['roles'=> $roles]);
    }

    public function edit($id){
        $role = Role::find($id);

        return view('bityarn/roles/editRole', ['role'=>$role]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'rolename' => 'required',
            'roleDesc' => 'required',
            'status' => 'required'
        ]);

        $role = Role::find($id);
        
        $role->role_name= $request->input('rolename');
        $role->role_description = $request->input('roleDesc');
        $role->status = $request->input('status');
        $role->save();

        return redirect('/bityarn/viewroles')->with('message', 'Role updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        $role->status = "Deleted";
        $role->save();

        return redirect('/bityarn/viewroles')->with('message', 'Role deleted successfully!');
    }

    public static function getRoleName($id){
        $role = Role::find($id);

        return $role->role_name;
    }
}
