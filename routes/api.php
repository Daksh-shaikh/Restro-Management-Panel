<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
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


//super admin panel


// Route::post('registration', [ApiController::class, 'registration']);

// Route::get('userCheck', [ApiController::class, 'user_check']);

Route::post('user_registration', [ApiController::class, 'user_registration']);

Route::get('get_user', [ApiController::class, 'get_user']);

Route::post('send_mobile_verify_otp', [ApiController::class, 'send_mobile_verify_otp']);

Route::post('updateUser/{id}', [ApiController::class, 'updateUser']);

Route::get('getCity', [ApiController::class, 'getCity']);

Route::get('getCategory', [ApiController::class, 'getCategory']);

Route::get('getBanner', [ApiController::class, 'getBanner']);

// Route::get('get_user', [ApiController::class, 'get_user']);

Route::get('get_restro', [ApiController::class, 'get_restro']);

Route::get('get_restro_data', [ApiController::class, 'get_restro_data']);

Route::get('get_restro_new', [ApiController::class, 'get_restro_new']);



Route::get('getMenu', [ApiController::class, 'getMenu']);

Route::get('get_coupon', [ApiController::class, 'get_coupon']);


//admin panel

Route::get('get_recipe', [ApiController::class, 'get_recipe']);

Route::get('getCart', [ApiController::class, 'getCart']);

Route::post('addToCart', [ApiController::class, 'addToCart']);

Route::get('remove_cart', [ApiController::class, 'remove_cart']);

Route::post('postOrder', [ApiController::class, 'postOrder']);

Route::get('get_order_history', [ApiController::class, 'get_order_history']);

Route::get('get_search_restro', [ApiController::class, 'get_search_restro']);

Route::get('get_search_menu', [ApiController::class, 'get_search_menu']);

Route::get('getHistory', [ApiController::class, 'getHistory']);



// Restro API

Route::get('restro_login', [ApiController::class, 'restro_login']);

Route::get('getRestroOrder', [ApiController::class, 'getRestroOrder']);

Route::get('getRestroInfo', [ApiController::class, 'getRestroInfo']);

Route::post('accept_order', [ApiController::class, 'accept_order']);

Route::post('cancel_order', [ApiController::class, 'cancel_order']);

Route::post('delivery_address', [ApiController::class, 'delivery_address']);

Route::get('get_delivery_address', [ApiController::class, 'get_delivery_address']);



//Delivery Boy API

Route::post('delivery_registration', [ApiController::class, 'delivery_registration']);

Route::get('delivery_check', [ApiController::class, 'delivery_check']);

Route::get('get_delivery_boy_info', [ApiController::class, 'get_delivery_boy_info']);

Route::get('get_delivery_order', [ApiController::class, 'get_delivery_order']);

Route::post('delivery_accept_order', [ApiController::class, 'delivery_accept_order']);

Route::post('delivery_cancel_order', [ApiController::class, 'delivery_cancel_order']);


// Kitchen API

Route::post('kitchen_registration', [ApiController::class, 'kitchen_registration']);

Route::get('kitchen_check', [ApiController::class, 'kitchen_check']);

Route::get('get_kitchen_info', [ApiController::class, 'get_kitchen_info']);

Route::get('get_all_restro', [ApiController::class, 'get_all_restro']);

Route::get('get_kitchen_order', [ApiController::class, 'get_kitchen_order']);

Route::post('kitchen_accept_order', [ApiController::class, 'kitchen_accept_order']);

Route::post('kitchen_order_completed', [ApiController::class, 'kitchen_order_completed']);

