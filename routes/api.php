<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
// use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserAdressController;
use App\Http\Controllers\UserController;
use App\Models\OrderStatus;
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

Route::get('/initial/app', [AppController::class, 'index']);
Route::get('/initial/dashboard', [AppController::class, 'dashboard']);

Route::post("auth/signup", [SignupController::class, "register"]);
Route::post("auth/login", [LoginController::class, "login"]);
Route::post("auth/login_google", [LoginController::class, "login_google"]);
Route::get("auth/logout", [LogoutController::class, "logout"]);
Route::post("/auth/request-reset-password", [ResetPasswordController::class, "requestResetPassword"]);
Route::post("/auth/reset-password", [ResetPasswordController::class, "resetPassword"]);
Route::post("/auth/verify-reset-password", [ResetPasswordController::class, "VerifyResetPassword"]);
Route::post("/auth/update-password", [ResetPasswordController::class, "UpdatePassword"]);

// Route::get("auth/google", [GoogleController::class, "getAuthUrl"]);


Route::get("/categories", [CategoryController::class, "index"]);
Route::get("/categories/{id}", [CategoryController::class, "show"]);
Route::post("/categories", [CategoryController::class, "store"]);
Route::post("/categories/{id}", [CategoryController::class, "edit"]);
Route::delete("/categories/{id}", [CategoryController::class, "destroy"]);


Route::get("/users", [UserController::class, "index"]);
Route::post("/users/update/info", [UserController::class, "editInfo"]);
Route::post("/users/update/password", [UserController::class, "editPassword"]);
Route::get("/users/{id}", [UserController::class, "show"]);
Route::post("/users", [UserController::class, "store"]);
Route::post("/users/switch-role/{id}", [UserController::class, "switchRole"]);
Route::post("/users/{id}", [UserController::class, "edit"]);
Route::delete("/users/{id}", [UserController::class, "destroy"]);


Route::get('/orders/statuses', [OrderStatusController::class, 'index']);
Route::get("/orders/statuses/{id}", [OrderStatusController::class, "show"]);
Route::delete("/orders/statuses/{id}", [OrderStatusController::class, "destroy"]);
Route::post("/orders/statuses", [OrderStatusController::class, "store"]);

Route::get("/orders", [OrderController::class, "index"]);
Route::get("/orders/{id}", [OrderController::class, "show"]);
Route::post("/orders/{id}/status", [OrderController::class, "updateOrderStatus"]);
Route::post("/orders/{id}/confirmPayment", [OrderController::class, "confirmPayment"]);
Route::post("/orders", [OrderController::class, "store"]);
Route::get("/user/orders", [OrderController::class, "showUserOrders"]);




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

Route::get("/sizes", [SizeController ::class, "index"]);
Route::get("/sizes/{id}", [SizeController::class, "show"]);
Route::post("/sizes/store", [SizeController::class, "store"]);
Route::post("/sizes/{id}", [SizeController::class, "edit"]);
Route::delete("/sizes/{id}", [SizeController::class, "destroy"]);



Route::get("/products", [ProductController::class, "index"]);
Route::get("/products/active", [ProductController::class, "all_active"]);
Route::get("/products/{id}", [ProductController::class, "show_active"]);
Route::get("/admin/products/{id}", [ProductController::class, "show"]);
Route::post("/products", [ProductController::class, "store"]);
Route::post('/products/{id}/active', [ProductController::class, 'setActive']);
Route::post("/products/{id}", [ProductController::class, "edit"]);
Route::delete("/products/{id}", [ProductController::class, "destroy"]);

Route::get("/colors", [ColorController::class, "index"]);
Route::get("/colors/{id}", [ColorController::class, "show"]);
Route::post("/colors", [ColorController::class, "store"]);
Route::post("/colors/{id}", [ColorController::class, "edit"]);
Route::delete("/colors/{id}", [ColorController::class, "destroy"]);

Route::post('payment/initiate', [StripeController::class, 'initiatePayment']);
Route::post('payment/complete', [StripeController::class, 'completePayment']);
Route::post('payment/failure', [StripeController::class, 'failPayment']);



Route::get("/options", [OptionController::class, "index"]);
Route::get("/options/{id}", [OptionController::class, "show"]);
Route::post("/options", [OptionController::class, "store"]);
Route::post("/options/updateMany", [OptionController::class, "updateMany"]);
// Route::post("/options/{id}", [OptionController::class, "edit"]);
Route::delete("/options/{id}", [OptionController::class, "destroy"]);


Route::post('/sliders/{id}/active', [SliderController::class, 'setActive']);
Route::post('/sliders', [SliderController::class, 'store']);
Route::delete('/sliders/{id}', [SliderController::class, 'destroy']);
