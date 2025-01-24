<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LogoApiController;
use App\Http\Controllers\Api\TranslationManageController;
use App\Http\Controllers\Api\SeoController;

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