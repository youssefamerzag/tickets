<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UserController;
use App\Models\Tickets;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Ticket;

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


Auth::routes();


Route::get('/', [App\Http\Controllers\TicketsController::class, 'index'])->name('home')->middleware('auth');

Route::get('/profile' , [UserController::class , 'show'])->name('users.show')->middleware('auth');

//create ticket
Route::get('/ticket/create', [TicketsController::class , 'create'])->name('tickets.create')->middleware('auth');
Route::post('/ticket/create', [TicketsController::class , 'store'])->name('tickets.store')->middleware('auth');

//edit ticket
Route::get('/ticket/edit/{ticket}', [TicketsController::class , 'edit'])->name('tickets.edit')->middleware('auth');
Route::put('/ticket/edit/{ticket}', [TicketsController::class , 'update'])->name('tickets.update')->middleware('auth');

//delete ticket
Route::delete('/ticket/edit/{ticket}', [UserController::class , 'destroy'])->name('tickets.destroy')->middleware('auth');

//show ticket
Route::get('/ticket/{ticket}', [TicketsController::class , 'show'])->name('tickets.show')->middleware('auth');
//admin 

Route::middleware('admin', 'auth')->group(function () {
    Route::get('/admin' , [AdminController::class , 'index'])->name('admin.profile');
    Route::get('/admin/ticket/edit/{ticket}', [AdminController::class , 'edit'])->name('adminticket.edit');
    Route::put('/admin/ticket/edit/{ticket}', [AdminController::class , 'update'])->name('adminticket.update');
    Route::delete('/admin/ticket/destroy/{ticket}', [AdminController::class , 'destroy'])->name('adminticket.destroy');
    Route::get('/admin/users', [AdminController::class , 'users_index'])->name('users.index');
    Route::get('/admin/users/{user}', [AdminController::class , 'user_tickets'])->name('user.tickets');
    Route::delete('/admin/user/{user}', [AdminController::class , 'destroy_user'])->name('user.destroy');
    Route::put('/admin/user/{user}', [AdminController::class , 'update_user'])->name('user.update');
});



//Middleware

