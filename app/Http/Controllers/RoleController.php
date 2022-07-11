<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\ManageRoleRequest;

use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        // if(!Gate::allows('view-auth')){
        //     abort(403);
        // }
        return view('role',['result'=>Role::all()]);
    }

    public function show(Role $role = null)
    { 
        // if(!Gate::allows($role?'update-auth':'create-auth')){
        //     abort(403);
        // }
        
        return view('manage-role',['result'=>$role]);
    }

    public function store(ManageRoleRequest $request)
    {

        
        $role_object = null;

        if($request->isMethod('post')){
                $role_object = new Role();
                $operation_type = 1;
        }elseif($request->isMethod('put')){
                $role_object = Role::find($request->id);
                $operation_type = 2;
        }

        $role_object->name= $request->name;
        $role_object->status= $request->status ? 1:0;
        
        $result = $role_object->save();
    
        $this->setSessionData($result , $operation_type);

        if($result){
            return redirect('admin/role');
        }
        
    }

    public function destroy(Role $role)
    {
        // if(!Gate::allows('delete-auth')){
        //     print_r(json_encode(['code'=>0]));die();
        // }
        print_r(json_encode(['code'=>$role->delete()]));
    }
}