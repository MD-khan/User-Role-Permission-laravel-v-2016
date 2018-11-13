<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Role;
use App\Permission;
use DB;


class RoleController extends Controller
{
 
    public function __construct()
    {
       //$this->middleware('permission:role-edit');
        //return response()->view('errors.403');
    }

     public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
    	$permissions = Permission::get();
           return view('roles.create',compact('permissions'));
    }

    public function store (Request $request, Role $role ) 
        {
            $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);
    	//$role = new Role();
            $role->name = $request->input('name');
            $role->display_name = $request->input('display_name');
            $role->description = $request->input('description');
            $role->save();

            foreach ($request->input('permission') as $key => $value) {
                         $role->attachPermission($value);
            }

            return redirect()->back()
                        ->with('success','Role has been created  successfully');
     
    }


    /**
     * Display the specified role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
         $role = Role::find($id);
        $permissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
            ->where("permission_role.role_id",$id)
            ->get();
        
        //return (compact('role', 'permissions'));
        return view('roles.show',compact('role','permissions'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissionAll = Permission::all();
        $permissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
       ->where("permission_role.role_id",$id)
            ->get();


          /*
        $permission = Permission::get();
          $rolePermissions = DB::table("permission_role")->where("permission_role.role_id",$id)
            ->with('permission_role.permission_id','permission_role.permission_id');

             return view('roles.edit',compact('role','permission','rolePermissions'));
            */
        return view('roles.edit',compact('role','permissions', 'permissionAll'));
    }

   
   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'display_name' => 'required',
            'description' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        DB::table("permission_role")->where("permission_role.role_id",$id)
            ->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        return redirect()->back()
                        ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            DB::table("roles")->where('id',$id)->delete();
                return redirect()->back()
                        ->with('success','Role deleted successfully');
    }
    
}
