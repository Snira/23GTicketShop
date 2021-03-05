<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\IsAjax;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::group(
    [
        'prefix' => 'v1',
        'middleware' => IsAjax::class
    ],
    static function (): void {
        Route::resource('/events', EventController::class);
        Route::resource('/tickets', TicketController::class);
        Route::get('/tickets/{ticketId}', [TicketController::class, 'show']);
        Route::get('/tickets/{ticketId}', [TicketController::class, 'buyTicket']);
    },
);

