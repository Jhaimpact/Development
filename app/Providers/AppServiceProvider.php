<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('view-auth',function($user){
            return Permission::checkAuth(1); 
         });
 
         Gate::define('create-auth',function($user){
            return Permission::checkAuth(2);
         });
 
         Gate::define('update-auth',function($user){
            return Permission::checkAuth(3);
         });
         
         Gate::define('delete-auth',function($user){
             return Permission::checkAuth(4);
         });
    }
}
