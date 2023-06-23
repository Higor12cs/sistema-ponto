<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ImporterController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\AttendanceController as UserAttendanceController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('/', fn () => redirect()->to('/login'));

Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('/new-password', [UserController::class, 'newPassword'])->name('new-password.index');
    Route::post('/new-password', [UserController::class, 'setNewPassword'])->name('new-password.update');
});

Route::middleware(['auth', 'password.check', 'active.user'])->group(function () {
    Route::middleware('is_admin')->prefix('/admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/attendances', AttendanceController::class)->except(['show']);
        Route::get('/attendances/reopen/{attendance}', [AttendanceController::class, 'reopenAttendance'])->name('attendances.reopen');
        Route::get('/attendances/close/{attendance}', [AttendanceController::class, 'closeAttendance'])->name('attendances.close');
        Route::get('/importer', [ImporterController::class, 'index'])->name('importer.index');
        Route::post('/importer/import/fixed-date', [ImporterController::class, 'fixedDateImport'])->name('import.fixed-date');
        Route::post('/importer/import/date-range', [ImporterController::class, 'dateRangeImport'])->name('import.date-range');
        Route::post('/importer/import/fixed-employee', [ImporterController::class, 'fixedManagerImport'])->name('import.fixed-manager');
        Route::resource('/employees', EmployeeController::class);
        Route::resource('/users', UserController::class)->except('destroy');
        Route::post('/users/password-reset/{user}', [UserController::class, 'setToResetPassword'])->name('users.set-to-reset-password');
        Route::post('/users/active/{user}', [UserController::class, 'switchUserActiveStatus'])->name('users.switch-active-status');
        Route::get('/reports/manager', [ReportController::class, 'byManager'])->name('reports.by-manager');
        Route::get('/reports/employee', [ReportController::class, 'byEmployee'])->name('reports.by-employee');
        Route::post('/reports/manager', [ReportController::class, 'reportByManager'])->name('reports.manager');
        Route::post('/reports/manager/export', [ReportController::class, 'exportByManager'])->name('reports.manager.export');
    });

    Route::middleware('is_user')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/attendances', [UserAttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/attendances/{attendance}', [UserAttendanceController::class, 'close'])->name('attendance.close');
        Route::get('/attendances/{attendance:id}/fill', [UserAttendanceController::class, 'fill'])->name('attendance.fill');
    });

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
