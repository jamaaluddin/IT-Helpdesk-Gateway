<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ITSupportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('admin')
    ->name('admin.dashboard');

Route::get('/user/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'role:User'])
    ->name('user.dashboard');

Route::get('/it-support/dashboard', [ITSupportController::class, 'dashboard'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.dashboard');

Route::get('/it-support/my-tickets', [ITSupportController::class, 'myTickets'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.my-tickets');

Route::get('/it-support/tickets', [ITSupportController::class, 'tickets'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets');

Route::get('/it-support/tickets/{ticket}', [ITSupportController::class, 'show'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets.show');

Route::post('/it-support/tickets/{ticket}/take', [ITSupportController::class, 'take'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets.take');

Route::post('/it-support/tickets/{ticket}/start', [ITSupportController::class, 'start'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets.start');

Route::post('/it-support/tickets/{ticket}/priority', [ITSupportController::class, 'setPriority'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets.priority');

Route::post('/it-support/tickets/{ticket}/resolve', [ITSupportController::class, 'resolve'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets.resolve');

Route::get('/user/tickets/create', [TicketController::class, 'create'])
    ->middleware(['auth', 'role:User'])
    ->name('tickets.create');

Route::post('/user/tickets', [TicketController::class, 'store'])
    ->middleware(['auth', 'role:User'])
    ->name('tickets.store');

Route::get('/user/tickets', [TicketController::class, 'index'])
    ->middleware(['auth', 'role:User'])
    ->name('tickets.index');

Route::get('/user/tickets/{ticket}', [TicketController::class, 'show'])
    ->middleware(['auth', 'role:User'])
    ->name('tickets.show');

Route::post('/user/tickets/{ticket}/close', [TicketController::class, 'close'])
    ->middleware(['auth', 'role:User'])
    ->name('tickets.close');

Route::post('/user/tickets/{ticket}/reopen', [TicketController::class, 'reopen'])
    ->middleware(['auth', 'role:User'])
    ->name('tickets.reopen');

Route::post('/admin/users/{user}/approve', [UserApprovalController::class, 'approve'])
    ->middleware('admin')
    ->name('admin.users.approve');

Route::post('/admin/users/{user}/reject', [UserApprovalController::class, 'reject'])
    ->middleware('admin')
    ->name('admin.users.reject');



Route::post('/logout', function () {
    auth()->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');
