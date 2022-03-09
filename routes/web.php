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

Route::get('dev',[App\Http\Controllers\DevController::class,'index']);

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('application/list',[App\Http\Controllers\Admin\ApplicationController::class,'customList'])
    ->name('voyager.application.list');

    Route::get('application/{id}/print',[App\Http\Controllers\Admin\ApplicationController::class,'print'])
    ->name('voyager.application.print');

    Route::post('application/{id}/change/status',[App\Http\Controllers\Admin\ApplicationController::class,'changeStatus'])
    ->name('voyager.application.change.status');

    Voyager::routes();
    
});

