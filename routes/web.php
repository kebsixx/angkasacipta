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
Route::post('/create-ticket', [TicketController::class, 'store'])->name('ticket.store');

Route::get('/tickets', [TicketController::class, 'list'])->name('ticket.list');  // Halaman tabel tiket
