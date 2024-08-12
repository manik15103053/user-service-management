<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $data['roles'] = Role::with('permissions')->latest()->get();
        return view('pages.role.index',$data);
    }

    public function create(){
        $data['permissions'] = Permission::all()->groupBy('module');
        return view('pages.role.create',$data);
    }

    public function store(Request $request){
  
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array', 
            'permissions.*' => 'exists:permissions,id'
        ]);
    

        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
      
        $permissions = Permission::whereIn('id', $request->permissions)->get();
    
        $role->syncPermissions($permissions);

        return redirect()->route('role.index')->with('success', 'Role Created Successfully');
    }

    public function edit($id){

        $data['permissions'] = Permission::all()->groupBy('module');
        $data['role'] = Role::with('permissions')->find($id);
        return view('pages.role.edit',$data);
    }

    public function update(Request $request, $id) {
        
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);
    
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
    
    
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
    
        return redirect()->route('role.index')->with('success', 'Role Updated Successfully');
    }

    public function delete($id) {
       
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Role Deleted Successfully');
    }
    
    
}
