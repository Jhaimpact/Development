<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\View;

use  App\Models\Menu;

class ShareView
{
    public function handle(Request $request, Closure $next)
    {
     
        $menu = new Menu();
        View::share('render_menu',$menu->parent());
        /*
            if(Auth::check()){
                $menu = new Menu();
                View::share('render_menu',$menu->parent());
            }else{
                View::share('render_menu',[]);
            }
        */
        
        return $next($request);
    }
}
