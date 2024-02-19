<?php

//super admin route
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CityController;
use App\Http\Controllers\Frontend\BannerController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\GstController;
use App\Http\Controllers\Frontend\RestroController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\Frontend\DeliveryBoyController;

// Import middleware classes
use App\Http\Middleware\SuperadminCheckStatus;
use App\Http\Middleware\AdminCheckStatus;


// //middleware route
// use App\Http\Controller\Middleware\CheckStatus;



//admin route
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\LeaveDateController;
use App\Http\Controllers\admin\DeliverySlotTimingController;
use App\Http\Controllers\admin\RecipeController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\KitchenController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'web'], function () {

//login routes
Route::get('/', [AdminLoginController::class, 'index'])->name('adminLogin');
Route::post('/postlogin', [AdminLoginController::class, 'login'])->name('postlogin');
// Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
Route::match(['get', 'post'], '/logout', [AdminLoginController::class, 'logout'])->name('logout');


// Route::middleware([CheckStatus::class])->group(function(){
    //----------------------------------
// Route::group(['middleware'=>'CheckStatus'],function(){
    //----------------------------------

Route::group(['middleware' => SuperadminCheckStatus::class], function () {
        // Define superadmin routes here
        // Example:
Route::get('/superadmin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/city',[CityController::class, 'index'])->name('city');
Route::post('cityStore',[CityController::class, 'cityStore'])->name('cityStore');
Route::get('cityDestroy/{id}',[CityController::class, 'cityDestroy'])->name('cityDestroy');
Route::get('cityEdit/{id}', [CityController::class, 'cityEdit'])->name('cityEdit');
Route::post('cityUpdate', [CityController::class, 'cityUpdate'])->name('cityUpdate');
Route::get('/update_city_status/{id}', [CityController::class, 'update_city_status'])->name('update_city_status');


Route::get('bannerIndex',[BannerController::class, 'index'])->name('bannerIndex');
Route::post('bannerStore',[BannerController::class, 'bannerStore'])->name('bannerStore');
Route::get('bannerDestroy/{id}', [BannerController::class, 'bannerDestroy'])->name('bannerDestroy');
Route::get('bannerEdit/{id}', [BannerController::class, 'bannerEdit'])->name('bannerEdit');
Route::post('bannerUpdate', [BannerController::class, 'bannerUpdate'])->name('bannerUpdate');
Route::get('/update_banner_status/{id}', [BannerController::class, 'update_banner_status'])->name('update_banner_status');


Route::get('categoryIndex',[CategoryController::class, 'index'])->name('categoryIndex');
Route::post('categoryStore',[CategoryController::class, 'categoryStore'])->name('categoryStore');
Route::get('categoryDestroy/{id}',[CategoryController::class, 'categoryDestroy'])->name('categoryDestroy');
// Route::get('categoryEdit/{id}', [CategoryController::class, 'categoryEdit'])->name('categoryEdit');
Route::match(['get', 'post'], 'categoryEdit/{id}', [CategoryController::class, 'categoryEdit'])->name('categoryEdit');
Route::post('categoryUpdate', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
Route::get('/update_category_status/{id}', [CategoryController::class, 'update_category_status'])->name('update_category_status');


Route::get('gstIndex', [GstController::class, 'index'])->name('gstIndex');
Route::post('gstStore', [GstController::class, 'gstStore'])->name('gstStore');

Route::get('restroIndex', [RestroController::class, 'index'])->name('restroIndex');
Route::post('restroStore', [RestroController::class, 'restroStore'])->name('restroStore');
Route::get('restroDestroy/{id}', [RestroController::class, 'restroDestroy'])->name('restroDestroy');
Route::get('restroEdit/{id}', [RestroController::class, 'restroEdit'])->name('restroEdit');
Route::post('restroUpdate', [RestroController::class, 'restroUpdate'])->name('restroUpdate');
Route::get('/login', [RestroController::class, 'login'])->name('login');
Route::get('/view', [RestroController::class, 'view'])->name('view');
//for status active or inactive
Route::get('/update_status/{id}', [RestroController::class, 'update_status'])->name('update_status');
// Route::get('/getCoordinates/{cityId}', [RestroController::class, 'getCoordinates'])->name('getCoordinates');

Route::get('couponIndex', [CouponController::class, 'index'])->name('couponIndex');
Route::post('couponStore', [CouponController::class, 'couponStore'])->name('couponStore');
Route::get('coupon/create', [CouponController::class, 'create'])->name('createCoupon');
Route::get('couponDestroy/{id}', [CouponController::class, 'couponDestroy'])->name('couponDestroy');
Route::get('couponEdit/{id}', [CouponController::class, 'couponEdit'])->name('couponEdit');
Route::post('couponUpdate', [CouponController::class, 'couponUpdate'])->name('couponUpdate');
//for status active or inactive
Route::get('/update_coupon_status/{id}', [CouponController::class, 'update_coupon_status'])->name('update_coupon_status');

Route::get('menu', [MenuController::class, 'index'])->name('menuIndex');
Route::post('menuStore', [MenuController::class, 'menuStore'])->name('menuStore');
Route::get('menuDestroy/{id}', [MenuController::class, 'menuDestroy'])->name('menuDestroy');
Route::get('menuEdit/{id}', [MenuController::class, 'menuEdit'])->name('menuEdit');
Route::post('menuUpdate', [MenuController::class, 'menuUpdate'])->name('menuUpdate');
//for status active or inactive
Route::get('/update_menu_status/{id}', [MenuController::class, 'update_menu_status'])->name('update_menu_status');
Route::get('/getRestaurants/{cityId}', [MenuController::class,'getRestaurants'])->name('getRestaurants');
// routes/web.php

// Route::get('/getRestaurants/{cityId}', [MenuController::class,'getRestaurants'])->name('getRestaurants');

//DELIVERY BOY
Route::get('/delivery_boy', [DeliveryBoyController::class, 'index'])->name('delivery_boy');
Route::post('store-delivery-boy',[DeliveryBoyController::class, 'store_delivery_boy'])->name('store-delivery-boy');
Route::get('/delivery-boy-edit/{id}', [DeliveryBoyController::class, 'edit_delivery_boy'])->name('edit_delivery_boy');
Route::post('update-delivery-boy',[DeliveryBoyController::class, 'update_delivery_boy'])->name('update_delivery_boy');
Route::get('/update_delivery_boy_status/{id}', [DeliveryBoyController::class, 'update_delivery_boy_status'])->name('update_delivery_boy_status');


});

// Admin routes
// Route::get('/', [AdminLoginController::class, 'index'])->name('adminLogin');
// Route::post('/login', [AdminLoginController::class, 'login'])->name('postlogin');

Route::group(['middleware' => AdminCheckStatus::class], function () {
    // Define admin routes here
    // Example:
    // Route::get('/admin/dashboard', 'AdminController@dashboard');

Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('adminDashboard');

Route::get('showProfile/{id}', [ProfileController::class, 'showProfile'])->name('showProfile');
Route::post('updateProfile/{id}', [ProfileController::class, 'updateProfile'])->name('profile.update');

Route::get('add_recipe', [RecipeController::class, 'index'])->name('add_recipe');
Route::post('add_recipe/store', [RecipeController::class, 'recipeStore'])->name('recipeStore');
Route::get('recipeDestroy/{id}', [RecipeController::class, 'recipeDestroy'])->name('recipeDestroy');
Route::get('recipeEdit/{id}', [RecipeController::class, 'recipeEdit'])->name('recipeEdit');
Route::post('recipeUpdate', [RecipeController::class, 'recipeUpdate'])->name('recipeUpdate');
Route::get('/update_recipe_status/{id}', [RecipeController::class, 'update_recipe_status'])->name('update_recipe_status');

Route::get('leave_date', [LeaveDateController::class, 'index'])->name('leave_date');
Route::post('leave_date/store', [LeaveDateController::class, 'dateStore'])->name('dateStore');
Route::get('leaveDateDestroy/{id}', [LeaveDateController::class, 'leaveDateDestroy'])->name('leaveDateDestroy');
Route::get('leaveDateEdit/{id}', [LeaveDateController::class, 'leaveDateEdit'])->name('leaveDateEdit');
Route::post('leaveDateUpdate', [LeaveDateController::class, 'leaveDateUpdate'])->name('leaveDateUpdate');

Route::get('delivery_slots_timing', [DeliverySlotTimingController::class, 'index'])->name('delivery_slots_timing');
Route::post('delivery_slots_timing/store', [DeliverySlotTimingController::class, 'deliverySlotStore'])->name('deliverySlotStore');
Route::get('deliverySlotDestroy/{id}', [DeliverySlotTimingController::class, 'deliverySlotDestroy'])->name('deliverySlotDestroy');
Route::get('deliverySlotEdit/{id}', [DeliverySlotTimingController::class, 'deliverySlotEdit'])->name('deliverySlotEdit');
Route::post('deliverySlotUpdate', [DeliverySlotTimingController::class, 'deliverySlotUpdate'])->name('deliverySlotUpdate');

Route::get('kitchen', [KitchenController::class, 'index'])->name('kitchen');
Route::post('kitchen-registration', [KitchenController::class, 'kitchen_registration'])->name('kitchen-registration');
Route::get('kitchen-edit/{id}', [KitchenController::class, 'kitchen_edit'])->name('kitchen-edit');
Route::post('kitchen-update', [KitchenController::class, 'kitchen_update'])->name('kitchen-update');
Route::get('/update-kitchen-status/{id}', [KitchenController::class, 'update_kitchen_status'])->name('update-kitchen-status');


});


});

