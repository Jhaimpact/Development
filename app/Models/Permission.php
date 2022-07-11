<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
// use App\Models\

class Permission extends Model
{
    use HasFactory;
    protected $table = 'role_menu_permissions';

    protected $fillable = [
        'role_id','menu_id','permission_id'
    ];

    public static function parent(){
        return Permission::join("menus","menus.id","=",'role_menu_permissions.menu_id')->where("parent_id","=","0")->where()->get();
    }

    public static function checkAuth($permission_id){
        
        if(auth('admin')->user()->role_id == "1"){
            // print_r(request()->segment(2));die;
            $menu_row = Menu::where("menu_href","=",request()->segment(2))->first();
            $permission_array  = explode(',',$menu_row->permissions);
         
            return in_array($permission_id,$permission_array);
            return true;
        }
        
        $result = Permission::select("menus.id")
        ->join("menus","menus.id","=",'role_menu_permissions.menu_id')
        ->where("menu_href","=",request()->segment(2))
        ->where("permission_id","=",$permission_id)
        ->where("role_id","=",auth()->user()->role_id)->get();
       
        return $result->isNotEmpty();
    }
}