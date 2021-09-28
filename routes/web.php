<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GW\AccountController as GWAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function () {
    Route::post('/create', [UserController::class, 'create'])->name('create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/updateApiKey', [UserController::class, 'updateApiKey'])->name('updateApiKey');
    Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');
});

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
});

Route::prefix('gwapi')->name('gwapi.')->middleware(['auth'])->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/', [GWAccountController::class, 'account'])->name('account');
        Route::get('/achievements', [GWAccountController::class, 'achievements'])->name('achievements');
        Route::get('/bank', [GWAccountController::class, 'bank'])->name('bank');
        Route::get('/dailycrafting', [GWAccountController::class, 'dailycrafting'])->name('dailycrafting');
        Route::get('/dungeons', [GWAccountController::class, 'dungeons'])->name('dungeons');
        Route::get('/dyes', [GWAccountController::class, 'dyes'])->name('dyes');
    });
});
