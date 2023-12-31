<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

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

// Route::middleware('auth:sanctum')->group(function () {
//     // Your protected routes
// });

Route::get('/tickets/open', [TicketController::class, 'getOpenTickets']);
Route::get('/tickets/closed', [TicketController::class, 'getClosedTickets']);
Route::get('/users/{email}/tickets', [TicketController::class, 'getUserTickets']);
Route::get('/stats', [TicketController::class, 'getStats']);
