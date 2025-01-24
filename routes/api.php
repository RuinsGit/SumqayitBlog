<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LogoApiController;
use App\Http\Controllers\Api\TranslationManageController;
use App\Http\Controllers\Api\SeoController;
use App\Http\Controllers\Api\SocialMediaApiController;
use App\Http\Controllers\Api\SocialshareApiController;
use App\Http\Controllers\Api\SocialfooterApiController;
use App\Http\Controllers\Api\HomecartApiController;
use App\Http\Controllers\Api\WorklifeController;
use App\Http\Controllers\Api\AboutController;
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
// Logo Routes
Route::get('/logos', [LogoApiController::class, 'index']);
Route::get('/logos/{id}', [LogoApiController::class, 'show']);
Route::get('/logos/key/{key}', [LogoApiController::class, 'getByKey']);
Route::get('/logos/group/{group}', [LogoApiController::class, 'getByGroup']);

// Translation Routes
Route::get('translations', [TranslationManageController::class, 'index']);
Route::get('translations/{id}', [TranslationManageController::class, 'show']);
Route::get('translations/key/{key}', [TranslationManageController::class, 'getByKey']);
Route::get('translations/group/{group}', [TranslationManageController::class, 'getByGroup']);

// SEO Routes
Route::prefix('seo')->group(function () {
    Route::get('/', [SeoController::class, 'index']);
    Route::get('/{key}', [SeoController::class, 'show']);
    Route::post('/', [SeoController::class, 'store']);
    Route::put('/{id}', [SeoController::class, 'update']);
    Route::delete('/{id}', [SeoController::class, 'destroy']);
});

// Social Media Routes
Route::prefix('social-media')->group(function () {
    Route::get('/', [SocialMediaApiController::class, 'index']);
    Route::get('/{id}', [SocialMediaApiController::class, 'show']);
    Route::post('/', [SocialMediaApiController::class, 'store']);
    Route::put('/{id}', [SocialMediaApiController::class, 'update']);
    Route::delete('/{id}', [SocialMediaApiController::class, 'destroy']);
    Route::post('/{id}/toggle-status', [SocialMediaApiController::class, 'toggleStatus']);
});

// Socialshare Routes
Route::prefix('socialshares')->group(function () {
    Route::get('/', [SocialshareApiController::class, 'index']);
    Route::get('/{id}', [SocialshareApiController::class, 'show']);
    Route::post('/', [SocialshareApiController::class, 'store']);
    Route::put('/{id}', [SocialshareApiController::class, 'update']);
    Route::delete('/{id}', [SocialshareApiController::class, 'destroy']);
});

// Social Footer Routes
Route::prefix('social-footer')->group(function () {
    Route::get('/', [SocialfooterApiController::class, 'index']);
    Route::get('/{id}', [SocialfooterApiController::class, 'show']);
    Route::post('/', [SocialfooterApiController::class, 'store']);
    Route::put('/{id}', [SocialfooterApiController::class, 'update']);
    Route::delete('/{id}', [SocialfooterApiController::class, 'destroy']);
});

// Homecart Routes
Route::prefix('homecart')->group(function () {
    Route::get('/', [HomecartApiController::class, 'index']);
    Route::get('/{id}', [HomecartApiController::class, 'show']);
    Route::post('/', [HomecartApiController::class, 'store']);
    Route::put('/{id}', [HomecartApiController::class, 'update']);
    Route::delete('/{id}', [HomecartApiController::class, 'destroy']);
});

// Worklife Routes
Route::prefix('worklife')->group(function () {
    Route::get('/', [WorklifeController::class, 'index'])->name('api.worklife.index');
    Route::get('{id}', [WorklifeController::class, 'show'])->name('api.worklife.show');
    Route::post('/', [WorklifeController::class, 'store'])->name('api.worklife.store');
    Route::put('{id}', [WorklifeController::class, 'update'])->name('api.worklife.update');
    Route::delete('{id}', [WorklifeController::class, 'destroy'])->name('api.worklife.destroy');
});

// About Routes
Route::get('/about', [AboutController::class, 'index']);
Route::get('/about/{id}', [AboutController::class, 'show']);