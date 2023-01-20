<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomController;
use App\Models\Command;
use App\Models\Product;
use App\Models\ProductCommand;
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
    Route::post('/command/edit', [CommandController::class,'editCommand']);
    Route::put('/save-insumos/{id}', [CommandController::class,'saveInsumos']);
    Route::get('/command/{id}/insumos', [CommandController::class,'insumos']);
    Route::get('/rooms', [RoomController::class,'rooms']);
    Route::put('/rooms/updateStatus/{id}', [RoomController::class,'updateStatus'])->name('rooms.updateStatus');

    Route::get('/command/pdf/{id}',[PdfController::class,'commandPdf'])->name('command.pdf');
});
