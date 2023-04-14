<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserAdressController;
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
Route::post("auth/login", [LoginController::class, "login"]);
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



Route::get("/products", [ProductController::class, "index"]);
Route::get("/products/{id}", [ProductController::class, "show"]);
Route::post("/products", [ProductController::class, "store"]);
Route::post("/products/{id}", [ProductController::class, "edit"]);
Route::delete("/product/{id}", [ProductController::class, "destroy"]);

Route::get("/colors", [ColorController::class, "index"]);
Route::get("/colors/{id}", [ColorController::class, "show"]);
Route::post("/colors", [ColorController::class, "store"]);
Route::post("/colors/{id}", [ColorController::class, "edit"]);
Route::delete("/colors/{id}", [ColorController::class, "destroy"]);
Route::get("/orders", [OrderController::class, "index"]);
Route::get("/orders/{id}", [OrderController::class, "show"]);
Route::post("/orders", [OrderController::class, "store"]);


Route::get("/carts", [CartController::class, "index"]);
Route::get("/carts/{id}", [CartController::class, "show"]);
Route::post("/carts", [CartController::class, "store"]);
Route::delete("/carts/{id}", [CartController::class, "destroy"]);


Route::get("/useradresses", [UserAdressController::class, "index"]);
Route::get("/useradresses/{id}", [UserAdressController::class, "show"]);
Route::post("/useradresses", [UserAdressController::class, "store"]);
Route::post("/useradresses/{id}", [UserAdressController::class, "edit"]);
Route::delete("/useradresses/{id}", [UserAdressController::class, "destroy"]);


Route::get("/reviews", [ReviewsController::class, "index"]);
Route::get("/reviews/{id}", [ReviewsController::class, "show"]);
Route::post("/reviews", [ReviewsController::class, "store"]);
Route::post("/reviews/{id}", [ReviewsController::class, "edit"]);
Route::delete("/reviews/{id}", [ReviewsController::class, "destroy"]);


Route::get("/discounts", [DiscountController::class, "index"]);
Route::get("/discounts/{id}", [DiscountController::class, "show"]);
Route::post("/discounts", [DiscountController::class, "store"]);
Route::post("/discounts/{id}", [DiscountController::class, "edit"]);
Route::delete("/discounts/{id}", [DiscountController::class, "destroy"]);
