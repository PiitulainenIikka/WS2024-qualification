<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('events')->group(function () {
        Route::post('/create',[EventController::class, 'create']);
        Route::post('/edit/{event_id}',[EventController::class, 'edit']);
    });
    Route::prefix('ticket')->group(function () {
        Route::post('/create/{event_id}',[TicketController::class, 'create']);
    });
    Route::prefix('session')->group(function () {
        Route::post('/create/{event_id}',[SessionController::class, 'create']);
    });
    Route::prefix('channel')->group(function () {
        Route::post('/create/{event_id}',[ChannelController::class, 'create']);
    });
});