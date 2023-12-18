<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HistoryController;

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

Route::post('/user', [UserController::class, 'store']);

Route::put('/user/{id}', [UserController::class, 'update']);

Route::post('/history', [HistoryController::class, 'store']);

Route::get('/history/{idDoctor}', [HistoryController::class, 'getHistory']);

Route::get('/historyPatient/{idPatient}', [HistoryController::class, 'getHistoryPatient']);

Route::put('/historyConfirmed/{id}', [HistoryController::class, 'updateSignature']);

Route::post('/login', [LoginController::class, 'login']);

Route::put('/changePassword/{id}', [UserController::class, 'changePassword']);
