<?php

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

Route::get('/', [TicketController::class, 'index'])->name('welcome');
Route::post('/tickets', [TicketController::class, 'store'])->name('ticket.store');

// Remove atau comment out route list jika tidak digunakan
// Route::get('/tickets', [TicketController::class, 'list'])->name('tickets.list');
