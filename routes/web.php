<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JsController;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::get('/', function () {
    echo "Hello Admins ! Welcome to Our Site ";
});


Route::get('/user/edit',function(){
    return redirect('register');
});

Route::get('/login/admin', [LoginController::class,'showAdminLoginForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
    
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');


Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['auth:admin','share'])->group(function(){

                        Route::get("/",function(Request $request){
                            return redirect("admin/category");
                        });

                        Route::post('/adminLogout', function(Request $request){
                            Auth::guard('admin')->logout();

                            $request->session()->invalidate();
                    
                            $request->session()->regenerateToken();
                    
                            return redirect('/login/admin');
                        });
                        


                        Route::get('/checkauth',function(){
                            print_r(Auth::user()->id);
                        });

                        Route::get('/home',function(){
                             return view('layout.master');
                        });
                            
                        Route::controller(MenuController::class)->group(function(){
                            Route::get('/menu','index');
                            Route::get('/menu/edit/{menu?}','show');
                            Route::post('/menu/edit','store');
                            Route::put('/menu/edit/{menu?}','store');
                            Route::delete('/menu/{menu}','destroy'); 
                        });

                     
                        Route::get('/permissions',[PermissionController::class,'index']);
                        Route::post('/permissions',[PermissionController::class,'update']);

                        Route::controller(ProductController::class)->group(function(){
                            Route::get('/product','index');
                            Route::get('/product/manage/{product?}','show');
                            Route::post('/product','store');
                            Route::put('/product','store');
                            Route::delete('/product/{product}','destroy');
                            
                            /*product detail*/
                            Route::get('/product-detail/{product}','product_detail');
                            Route::post('/product-detail/{product}','save_product_detail');
                            // Route::get('/product-detail/{product}/edit/{product_detail?}','product_detail_show');
                            // Route::post('/product-detail/{product}/edit','product_detail_store');
                            // Route::put('/product-detail/{product}/edit/{product_detail}','product_detail_update');
                            // Route::delete('/product-detail/{product}/{product_detail}','product_detail_destroy');
                        });
                            
                        Route::controller(CategoryController::class)->group(function(){
                            Route::get('/category','index');
                            Route::get('/category/manage/{category?}','show');
                            Route::post('/category','store');
                            Route::put('/category','store');
                            Route::delete('/category/{category}','destroy');
                        });

                        Route::controller(RoleController::class)->group(function(){
                            Route::get('/role','index');
                            Route::get('/role/manage/{role?}','show');
                            Route::post('/role','store');
                            Route::put('/role','store');
                            Route::delete('/role/{role}','destroy'); 
                        });
                      
                        Route::controller(AdminController::class)->group(function(){
                            Route::get('/system-user','index');
                            Route::get('/system-user/manage/{system_users?}','show');
                            Route::post('/system-user','store');
                            Route::put('/system-user','store');
                            Route::delete('/system-user/{system_users}','destroy'); 
                        });


                        Route::controller(UserController::class)->group(function(){
                            Route::get('/customers','index');
                            Route::delete('/customers/{customer}','destroy'); 
                        });

                        Route::controller(JsController::class)->group(function(){
                            Route::get('/get-child-category/{parent}','get_chlid_category');
                            Route::get('/get-child-size-attribute/{parent}','get_child_size');
                        });
    });
});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
