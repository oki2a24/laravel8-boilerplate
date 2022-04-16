<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\EmailVerificationNotificationController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/health', fn () => ["status" => 200])->name('health');

// 認証
Route::post('login', [AuthenticatedSessionController::class, 'login'])->middleware(['guest'])->name('login');
Route::post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
Route::post('register', [RegisteredUserController::class, 'store'])->middleware(['guest']);
Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)->middleware(['auth:sanctum', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware(['guest'])->name('password.email');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware(['guest'])->name('password.reset');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [ProfileController::class, 'show'])->name('user.show');
    Route::put('/user/password', [PasswordController::class, 'update'])->name('user-password.update');
    Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])->name('user-profile-information.update');
});
