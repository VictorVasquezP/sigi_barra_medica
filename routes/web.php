<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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
    return redirect('/admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => 'api'], function () {
    Route::get('/products', [ProductController::class,'getProducts']);
    Route::post('/command/add', [CommandController::class,'storeCommand']);
});
