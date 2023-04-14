<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SizeController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('products', [ProductController::class, 'index']);
Route::post('/products/create-product', [ProductController::class, 'index']);




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




Route::get("/sizes", [SizeController ::class, "index"]);
Route::get("/sizes/{id}", [SizeController::class, "show"]);
Route::post("/sizes/store", [SizeController::class, "store"]);
Route::post("/sizes/{id}", [SizeController::class, "edit"]);
Route::delete("/sizes/{id}", [SizeController::class, "destroy"]);
