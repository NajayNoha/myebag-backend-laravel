<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
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


Route::get("/categories", [CategoryController::class, "index"]);
Route::get("/categories/{id}", [CategoryController::class, "show"]);
Route::post("/categories", [CategoryController::class, "store"]);
Route::post("/categories/{id}", [CategoryController::class, "edit"]);
Route::delete("/categories/{id}", [CategoryController::class, "destroy"]);


Route::get("/users", [UserController::class, "index"]);
Route::get("/users/{id}", [UserController::class, "show"]);
Route::post("/users", [UserController::class, "store"]);
Route::post("/users/{id}", [UserController::class, "edit"]);
Route::delete("/users/{id}", [UserController::class, "destroy"]);