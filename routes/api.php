<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("auth/signup", [SignupController::class, "register"]);
Route::get("auth/login", [LoginController::class, "login"]);
Route::get("auth/logout", [LogoutController::class, "logout"]);


Route::get("/showcategory/{id}", [CategoryController::class, "show"]);
Route::post("/createcategory", [CategoryController::class, "create"]);
Route::post("/updatecategory/{id}", [CategoryController::class, "edit"]);
Route::post("/deletecategory/{id}", [CategoryController::class, "destroy"]);