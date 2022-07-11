<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Role;
use App\Http\Requests\ManageAdminRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(){
        Gate::authorize('view-auth');
        return view('user',['result'=>Admin::all()]);
    }

    public function show(Admin $system_users = null){
        Gate::authorize('view-auth');
        return view('manage-users',['result'=>$system_users , 'roles' => Role::all()]);
    }


    
    public function store(ManageAdminRequest $request){
        // if(!Gate::allows('create-auth')){
        //     abort(403);
        // }
        
        $operation_type = 0;
        $system_user_object = null;

        if($request->isMethod('post')){
                Gate::authorize('create-auth');
                
                $system_user_object = new Admin();
                $operation_type = 1;
                $system_user_object->password  =  Hash::make($request->password);

        }elseif($request->isMethod('put')){
                
                Gate::authorize('update-auth');
                
                $system_user_object = Admin::find($request->id);
                $operation_type = 2;
        }



       
        $system_user_object->name = $request->name;
        $system_user_object->email = $request->email;
        $system_user_object->contact = $request->contact;
        $system_user_object->role_id = $request->role_id;
        $system_user_object->status = 1;
        
        $result = $system_user_object->save();
    
        $this->setSessionData($result , $operation_type);

        if($result){
            return redirect('admin/system-user');
        }
    }


    public function destroy(Admin $system_user){
        Gate::authorize('delete-auth');
                
        print_r(json_encode(['code'=>$system_user->delete()]));
    }


}

