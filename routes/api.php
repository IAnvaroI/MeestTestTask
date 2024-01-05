<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthNoteActionsMiddleware;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::patch('/password', [PasswordController::class, 'update'])->name('password.update');
    Route::delete('/user', [UserController::class, 'delete'])->name('user.delete');

    Route::resource('notes', NoteController::class)->only(['index', 'store']);

    Route::middleware(AuthNoteActionsMiddleware::class)->group(function () {
        Route::resource('notes', NoteController::class)->only(['show', 'update', 'destroy']);
    });
});
