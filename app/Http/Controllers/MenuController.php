<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\ManageMenuRequest;

use Illuminate\Support\Facades\Gate;

class MenuController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
  
    public function index()
    {
        if(!Gate::allows('view-auth')){
            abort(403);
        }
        return view('menu',['result'=>Menu::all()]);
    }

    public function store(ManageMenuRequest $request , Menu $menu)
    {
        
        $array = [
            'menu_name'=>$request->menu_name,
            'menu_icon'=>$request->menu_icon,
            'menu_href'=>$request->menu_href,
            'parent_id'=>$request->parent_id,
            'permissions'=>is_array($request->permission)?implode(',',$request->permission):0,
        ];
        
        $response = false;
        
        if($request->isMethod('post')){
        
            if(!Gate::allows('create-auth')){
                abort(403);
            }
            $response = Menu::create($array);
        
        }elseif($request->isMethod('put')){
            
            if(!Gate::allows('update-auth')){
                abort(403);
            }
            $response = $menu->update($array);
           
        }
        
        // return $array;
        if($response){
        
            session()->flash('success',config('constants.SUCCESS'));
       
            return redirect('menu');
       
        }else{
       
            session()->flash('error',config('constants.ERROR'));
            return redirect(url()->previous());
       
        }
    }

    public function show(Menu $menu = null)
    {
        if(!Gate::allows($menu?'update-auth':'create-auth')){
            abort(403);
        }
        return view('manage-menu',['result'=>$menu , 'parent_menu'=>Menu::where("parent_id","0")->get()]);
    } 
}
  