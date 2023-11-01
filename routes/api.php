<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderControllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactPersonController;


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

Route::group(['middleware' => ['auth:sanctum']], function () {
    //USER_ROUT
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/np', [AuthController::class, 'userDetails'])->name('userDetails');

    //CUSTPMER_ROUT
    Route::post('customers', [CustomerController::class, 'save']);
    Route::put('customers/{id}', [CustomerController::class, 'update']);
    Route::delete('customers/{id}', [CustomerController::class, 'delete']);

    //CUSTOMERPERSON_ROUT
    Route::post('contactperson/{id}', [ContactPersonController::class, 'update']);


    //ORDER_ROUT
    Route::post('/order/saveOrder', [OrderControllers::class, 'saveOrder'])->name('saveOrder');
    Route::post('/order/setImage/{id}', [OrderControllers::class, 'setImageOrder'])->name('setImageOrder');
});

//customer routes
Route::get('customers', [CustomerController::class, 'index']);
Route::get('customers/{id}', [CustomerController::class, 'search']);

//user routes
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');

//order routes
Route::get('/order/getAll', [OrderControllers::class, 'getAllData'])->name('getAllData');
Route::post('/order/searchOrder/{id}', [OrderControllers::class, 'searchOrderbyId'])->name('searchOrderbyId');
