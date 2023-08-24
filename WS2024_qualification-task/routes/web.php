<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('index');
    })->name('login');


    Route::prefix('events')->group(function () {
        Route::get('/', [ EventController::class, 'show']);
        Route::get('/create',[EventController::class, 'showCreate']);
        Route::get('/edit/{event_id}',[EventController::class, 'showEdit']);
        Route::get('/details/{event_id}',[EventController::class, 'showSingle']);
    });
    Route::prefix('session')->group(function () {
        Route::get('/create/{event_id}',[SessionController::class, 'showCreate']);
        Route::get('/edit/{session_id}',[SessionController::class, 'showEdit']);
    });
    Route::prefix('ticket')->group(function () {
        Route::get('/create/{event_id}',[TicketController::class, 'showCreate']);
    });
    Route::prefix('channel')->group(function () {
        Route::get('/create/{event_id}',[ChannelController::class, 'showCreate']);
    });
});



