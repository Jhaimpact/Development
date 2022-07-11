<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_name',
        'menu_icon',
        'menu_href',
        'parent_id',
        'permissions'
    ];

    public function menu(){
        return $this->hasOne(Menu::class,'id','parent_id')->withDefault();
    }

    // DB::enableQueryLog();
    //     $run = $this->hasMany(self::class,'parent_id')->toSql();
    //     print_r($run);
    //     $query = DB::getQueryLog();
    //     dd($run);
        
    public function child(){
        if(auth('admin')->user()->role_id == 1){

            return $this->hasMany(self::class,'parent_id');    

        }else{
         
            return $this->hasMany(self::class,'parent_id')->join('role_menu_permissions','role_menu_permissions.menu_id','=','menus.id')->where("role_id","=",auth()->user()->role_id)->where("permission_id","=","1");
        
        }
        
    }

    public function parent(){
        if(auth('admin')->user()->role_id == 1)
            return self::where("parent_id","=","0")->get();    
        else {
            $result = self::select("menus.*")
                        ->leftJoin('role_menu_permissions','role_menu_permissions.menu_id','=','menus.id')
                        ->where(function($query){
                            $query->where("role_id","=",auth()->user()->role_id)
                            ->where("permission_id","=","1")
                            ->where('parent_id','=','0');
                        })->orWhere('menu_href','=','#')->get();
            return $result;
                                                      
        }
        
    }
    
}