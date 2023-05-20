<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FuncionarioController;
use App\Http\Controllers\Admin\PontoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\PontoController as UserPontoController;
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

Route::get('/', fn () => redirect()->to('/login'));

Route::middleware(['auth', 'active.user'])->group(function () {
    Route::get('/nova-senha', [UserController::class, 'newPassword'])->name('new-password.index');
    Route::post('/nova-senha', [UserController::class, 'setNewPassword'])->name('new-password.update');
});

Route::middleware(['auth', 'password.check', 'active.user'])->group(function () {
    Route::middleware('is_admin')->prefix('/admin')->as('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('/funcionarios', FuncionarioController::class);
        Route::resource('/pontos', PontoController::class);
        Route::resource('/users', UserController::class)->except('destroy');
        Route::post('/users/redefinir-senha/{user}', [UserController::class, 'setToResetPassword'])->name('users.set-to-reset-password');
        Route::post('/users/ativo/{user}', [UserController::class, 'switchUserActiveStatus'])->name('users.switch-active-status');
    });

    Route::middleware('is_user')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pontos', [UserPontoController::class, 'index'])->name('pontos.index');
        Route::get('/pontos/{ponto:id}/preencher', [UserPontoController::class, 'preencher'])->name('pontos.preencher');
    });

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Auth::routes([
    'login' => true,
    'logout' => true,
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);
