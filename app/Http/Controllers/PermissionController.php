<?php

namespace App\Http\Controllers;
// namespace App\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Menu;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{

    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
        // Gate::authorize('view-auth');
        // if(!Gate::allows('view-auth')){
        //     abort(403);
        // }
        return view('permission',['role'=>Role::all(),'menus'=>Menu::all()->where("menu_href","<>","#")]);
    }

    public function update(Request $request){
        // Gate::authorize('create-auth');
      
        // if(!Gate::allows('create-auth')){
        //     abort(403);
        // }
        
        Permission::truncate();
        $create_arr = [];
        if(is_array($request->data)){
            foreach ($request->data as $key => $value) {
                $req_arr = explode('_',$key);
                array_push($create_arr,['role_id'=>$req_arr[0],'menu_id'=>$req_arr[1],'permission_id'=>$req_arr[2]]);
            }
            
            if(Permission::insert($create_arr)){
                session()->flash('success',config('constants.SUCCESS'));
            }else{
                session()->flash('error',config('constants.FAILED'));
            }
        }
        return redirect('admin/permissions');

    }
}