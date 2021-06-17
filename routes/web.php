<?php

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
Route::middleware('auth')->group(function () use ($router){
    Route::get('/', 'HomeController@index');
    Route::get('/checkout/{any?}', 'HomeController@index')->where('any', '.*');
    Route::get('/products/{any?}', 'HomeController@index')->where('any', '.*');
    Route::get('/order-history/{any?}', 'HomeController@index')->where('any', '.*');
    Route::group(['prefix' => 'api'], function () use ($router) {
        $router->resources([
            'events'    => 'EventController',
            'todos'     => 'TodoController',
            'get-products'  => 'ProductController',
            'menu-categories'  => 'MenuCategoryController',
            'cart'  => 'CartController',
            'orders'  => 'OrderController',
        ]);

        $router->get('/get-cart-count', 'CartController@getCartCount');
        $router->get('/check-coupon', 'CartController@checkCoupon');
        $router->post('/use-coupon', 'CartController@useCoupon');
    });
});
Auth::routes();
