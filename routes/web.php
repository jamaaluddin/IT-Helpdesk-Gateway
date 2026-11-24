<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ITSupportController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\ItSupportMaintenanceController;
use App\Http\Controllers\MaintenanceHistoryController;
use App\Http\Controllers\ServerMaintenanceController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\ITSupportAssetController;
use App\Http\Controllers\BeritaAcaraController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [LoginController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.process');

// Admin Routes

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('admin')
    ->name('admin.dashboard');

Route::get('/admin/tickets', [AdminController::class, 'tickets'])
    ->middleware('admin')
    ->name('admin.tickets.index');

Route::get('/admin/maintenance/history', [MaintenanceHistoryController::class, 'adminHistory'])
    ->middleware('admin')
    ->name('admin.maintenance.history');

Route::get('/admin/assets', [AssetController::class, 'index'])
    ->middleware('admin')
    ->name('admin.assets.index');

Route::get('/admin/assets/create', [AssetController::class, 'create'])
    ->middleware('admin')
    ->name('admin.assets.create');

Route::post('/admin/assets', [AssetController::class, 'store'])
    ->middleware('admin')
    ->name('admin.assets.store');

Route::get('/admin/assets/{asset}', [AssetController::class, 'show'])
    ->middleware('admin')
    ->name('admin.assets.show');

Route::get('/admin/assets/{asset}/edit', [AssetController::class, 'edit'])
    ->middleware('admin')
    ->name('admin.assets.edit');

Route::put('/admin/assets/{asset}', [AssetController::class, 'update'])
    ->middleware('admin')
    ->name('admin.assets.update');

Route::patch('/admin/assets/{asset}/retire', [AssetController::class, 'retire'])
    ->middleware('admin')
    ->name('admin.assets.retire');

Route::delete('/admin/assets/{asset}', [AssetController::class, 'destroy'])
    ->middleware('admin')
    ->name('admin.assets.destroy');

Route::get('/admin/asset-types', [AssetTypeController::class, 'index'])
    ->middleware('admin')
    ->name('admin.asset-types.index');

Route::post('/admin/asset-types', [AssetTypeController::class, 'store'])
    ->middleware('admin')
    ->name('admin.asset-types.store');

Route::put('/admin/asset-types/{assetType}', [AssetTypeController::class, 'update'])
    ->middleware('admin')
    ->name('admin.asset-types.update');

Route::patch('/admin/asset-types/{assetType}/toggle-status', [AssetTypeController::class, 'toggleStatus'])
    ->middleware('admin')
    ->name('admin.asset-types.toggle-status');

Route::get('/admin/reports', [AdminController::class, 'report'])
    ->middleware('admin')
    ->name('admin.reports.index');

Route::get('/admin/users', [AdminController::class, 'users'])
    ->middleware('admin')
    ->name('admin.users.index');

Route::post('/admin/users/{user}/approve', [UserApprovalController::class, 'approve'])
    ->middleware('admin')
    ->name('admin.users.approve');

Route::post('/admin/users/{user}/reject', [UserApprovalController::class, 'reject'])
    ->middleware('admin')
    ->name('admin.users.reject');


// IT Support Routes

Route::get('/it-support/dashboard', [ITSupportController::class, 'dashboard'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.dashboard');

Route::get('/it-support/assets', [ITSupportAssetController::class, 'index'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.index');

Route::get('/it-support/assets/create', [ITSupportAssetController::class, 'create'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.create');

Route::post('/it-support/assets', [ITSupportAssetController::class, 'store'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.store');

Route::get('/it-support/assets/{asset}/edit', [ITSupportAssetController::class, 'edit'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.edit');

Route::get('/it-support/assets/{asset}/history', [ITSupportAssetController::class, 'history'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.history');

Route::put('/it-support/assets/{asset}', [ITSupportAssetController::class, 'update'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.update');

Route::get('/it-support/assets/{asset}/detail', [ITSupportAssetController::class, 'show'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.show');

Route::get('/it-support/assets/{assetType}', [ITSupportAssetController::class, 'category'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.assets.category');

Route::get('/it-support/maintenance/pc', [ItSupportMaintenanceController::class, 'index'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.pc');

Route::get('/it-support/maintenance/pc/{maintenanceSchedule}', [ItSupportMaintenanceController::class, 'show'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.pc.show');

Route::post('/it-support/maintenance/pc/{maintenanceSchedule}/record', [ItSupportMaintenanceController::class, 'storeRecord'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.pc.record.store');

Route::get('/it-support/maintenance/schedules', [ItSupportMaintenanceController::class, 'index'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.schedules.index');

Route::get('/it-support/maintenance/schedules/create', [ItSupportMaintenanceController::class, 'create'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.schedules.create');

Route::post('/it-support/maintenance/schedules', [ItSupportMaintenanceController::class, 'store'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.schedules.store');

Route::get('/it-support/maintenance/history', [MaintenanceHistoryController::class, 'index'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.history');

Route::get('/it-support/maintenance/server', [ServerMaintenanceController::class, 'index'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.server');

Route::get('/it-support/maintenance/server/create', [ServerMaintenanceController::class, 'create'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.server.create');

Route::post('/it-support/maintenance/server', [ServerMaintenanceController::class, 'store'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.maintenance.server.store');

Route::get('/it-support/tickets', [ITSupportController::class, 'tickets'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets');

Route::get('/it-support/tickets/history', [ITSupportController::class, 'history'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.tickets.history');

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

Route::get('/it-support/berita-acara', [BeritaAcaraController::class, 'index'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.index');

Route::get('/it-support/berita-acara/create', [BeritaAcaraController::class, 'create'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.create');

Route::post('/it-support/berita-acara', [BeritaAcaraController::class, 'store'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.store');

Route::get('/it-support/berita-acara/{beritaAcara}/edit', [BeritaAcaraController::class, 'edit'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.edit');

Route::put('/it-support/berita-acara/{beritaAcara}', [BeritaAcaraController::class, 'update'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.update');

Route::delete('/it-support/berita-acara/{beritaAcara}', [BeritaAcaraController::class, 'destroy'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.destroy');

Route::get('/it-support/berita-acara/{beritaAcara}', [BeritaAcaraController::class, 'show'])
    ->middleware(['auth', 'role:IT Support'])
    ->name('it-support.berita-acara.show');


// User Routes

Route::get('/user/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'role:User'])
    ->name('user.dashboard');

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

Route::post('/logout', function () {
    auth()->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');
