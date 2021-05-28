<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// Route::resource('posts',PostController::class);

//AuthRoutes

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

//protected routes
Route::group(['middleware'=> ['auth:sanctum']],function () {
    Route::post("/posts",[PostController::class,'store']);
    Route::put("/posts/{id}",[PostController::class,'update']);
    Route::delete("/posts/{id}",[PostController::class,'destroy']);

    //AuthRoutes
    Route::post('/logout',[AuthController::class,'logout']);
});

//public routes
Route::get("/posts",[PostController::class,'index']);
Route::get("/posts/{id}",[PostController::class,'show']);
Route::get('posts/search/{description}',[PostController::class,'search']);    //searches for a post by description or a part of the des.




// Route::get("/posts/")

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
