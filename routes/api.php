<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/', function () {

    return response()->json([
        'code'=>1,
        'message'=>'Welcome to our site',
    ]);

});

Route::get('/csrf',function(){
    return response()->json([
        'code' => '1',
        'result' => csrf_token(),
    ]);
});


Route::controller(UserController::class)->group(function(){

    Route::post('/signup','signup');
    Route::post('/login','login');
    Route::post('/get-otp','getOtp');
    Route::post('/verify-otp','verifyOtp');
    Route::post('/forgot-password','forgotPassword');
    Route::post('/reset-password','resetPassword');
    Route::post('/social-login','socialLogin');

});

Route::middleware(['auth:sanctum'])->group(function(){
   
    Route::get('/check',function(){
        return response()->json("you have reachd here");
    });

    Route::controller(WishlistController::class)->group(function(){
        Route::get('get-wishlist','getWishlist');
        Route::post('save-wishlist/{product}','saveWishlist');
        Route::delete('delete-wishlist/{product}','deleteWishlist');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('feature-category','featureCategory');
        Route::get('get-category','getCategory');
    });



});
