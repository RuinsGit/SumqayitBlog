<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LogoApiController;
use App\Http\Controllers\Api\TranslationManageController;
use App\Http\Controllers\Api\SeoController;
use App\Http\Controllers\Api\SocialMediaApiController;
use App\Http\Controllers\Api\SocialshareApiController;
use App\Http\Controllers\Api\SocialfooterApiController;
use App\Http\Controllers\Api\HomeCartApiController;
use App\Http\Controllers\Api\WorklifeController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ContactMarketingApiController;
use App\Http\Controllers\Api\MapApiController;
use App\Http\Controllers\Api\GalleryVideoController;
use App\Http\Controllers\Api\GalleryController;
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

// Contact Marketing Routes
Route::get('contact_marketing', [ContactMarketingApiController::class, 'index']);
Route::post('contact_marketing', [ContactMarketingApiController::class, 'store']);
Route::get('contact_marketing/{id}', [ContactMarketingApiController::class, 'show']);
Route::delete('contact_marketing/{id}', [ContactMarketingApiController::class, 'destroy']);

// Map Routes
Route::get('maps', [MapApiController::class, 'index']);
Route::get('maps/{id}', [MapApiController::class, 'show']);




// Gallery Video Routes
Route::prefix('gallery-videos')->group(function () {
    Route::get('/', [GalleryVideoController::class, 'index']);
    Route::get('/latest/{limit?}', [GalleryVideoController::class, 'getLatest']);
    Route::get('/paginated/{perPage?}', [GalleryVideoController::class, 'getPaginated']);
    Route::get('/slug/{lang}/{slug}', [GalleryVideoController::class, 'getBySlug']);
    Route::get('/{id}', [GalleryVideoController::class, 'show']);
});

// Gallery Image Routes
Route::prefix('gallery-images')->group(function () {
    Route::get('/', [GalleryController::class, 'index']);
    Route::get('/latest/{limit?}', [GalleryController::class, 'getLatest']);
    Route::get('/paginated/{perPage?}', [GalleryController::class, 'getPaginated']);
    Route::get('/slug/{lang}/{slug}', [GalleryController::class, 'getBySlug']);
    Route::get('/{id}', [GalleryController::class, 'show']);
});