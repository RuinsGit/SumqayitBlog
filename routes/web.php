<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TranslationManageController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\SocialshareController;
use App\Http\Controllers\Admin\SocialfooterController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('back.pages.index');
        }
        return redirect()->route('admin.login');
    });

    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
    Route::post('login', [AdminController::class, 'login'])->name('handle-login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('profile', function () {
            return view('back.admin.profile');
        })->name('admin.profile');

        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::prefix('pages')->name('back.pages.')->group(function () {
            Route::get('index', [PageController::class, 'index'])->name('index');

            Route::resource('translation-manage', TranslationManageController::class);
            Route::get('translation-manage', [TranslationManageController::class, 'index'])->name('translation-manage.index');
            Route::get('translation-manage/create', [TranslationManageController::class, 'create'])->name('translation-manage.create');
            Route::post('translation-manage', [TranslationManageController::class, 'store'])->name('translation-manage.store');
            Route::get('translation-manage/{translation}/edit', [TranslationManageController::class, 'edit'])->name('translation-manage.edit');
            Route::put('translation-manage/{translation}', [TranslationManageController::class, 'update'])->name('translation-manage.update');
            Route::delete('translation-manage/{translation}', [TranslationManageController::class, 'destroy'])->name('translation-manage.destroy');


             // SEO routes
             Route::resource('seo', SeoController::class);
             Route::get('seo/toggle-status/{id}', [SeoController::class, 'toggleStatus'])->name('seo.toggle-status');
             Route::post('seo/toggle-status/{id}', [SeoController::class, 'toggleStatus'])->name('seo.toggle-status.post');
             Route::get('seo', [SeoController::class, 'index'])->name('seo.index');
             Route::get('seo/create', [SeoController::class, 'create'])->name('seo.create');
             Route::post('seo', [SeoController::class, 'store'])->name('seo.store');
             Route::get('seo/{id}/edit', [SeoController::class, 'edit'])->name('seo.edit');
             Route::put('seo/{id}', [SeoController::class, 'update'])->name('seo.update');
             Route::delete('seo/{id}', [SeoController::class, 'destroy'])->name('seo.destroy');

             // Logo routes
             Route::resource('logos', LogoController::class);
            Route::get('logos', [LogoController::class, 'index'])->name('logos.index');
            Route::get('logos/create', [LogoController::class, 'create'])->name('logos.create');
            Route::post('logos', [LogoController::class, 'store'])->name('logos.store');
            Route::get('logos/{id}', [LogoController::class, 'show'])->name('logos.show');
            Route::get('logos/{id}/edit', [LogoController::class, 'edit'])->name('logos.edit');
            Route::put('logos/{id}', [LogoController::class, 'update'])->name('logos.update');
            Route::delete('logos/{id}', [LogoController::class, 'destroy'])->name('logos.destroy');


            
             // Social Media routes
             Route::get('social', [SocialMediaController::class, 'index'])->name('social.index');
             Route::get('social/create', [SocialMediaController::class, 'create'])->name('social.create');
             Route::post('social', [SocialMediaController::class, 'store'])->name('social.store');
             Route::get('social/{id}/edit', [SocialMediaController::class, 'edit'])->name('social.edit');
             Route::put('social/{id}', [SocialMediaController::class, 'update'])->name('social.update');
             Route::delete('social/{id}', [SocialMediaController::class, 'destroy'])->name('social.destroy');
             Route::post('social/order', [SocialMediaController::class, 'order'])->name('social.order');
             Route::post('social/toggle-status/{id}', [SocialMediaController::class, 'toggleStatus'])->name('social.toggle-status');

              // Social Share routes
            Route::get('socialshare', [SocialshareController::class, 'index'])->name('socialshare.index');
            Route::get('socialshare/create', [SocialshareController::class, 'create'])->name('socialshare.create');
            Route::post('socialshare', [SocialshareController::class, 'store'])->name('socialshare.store');
            Route::get('socialshare/{id}/edit', [SocialshareController::class, 'edit'])->name('socialshare.edit');
            Route::put('socialshare/{id}', [SocialshareController::class, 'update'])->name('socialshare.update');
            Route::delete('socialshare/{id}', [SocialshareController::class, 'destroy'])->name('socialshare.destroy');
            Route::post('socialshare/order', [SocialshareController::class, 'order'])->name('socialshare.order');
            Route::post('socialshare/{id}/toggle-status', [SocialshareController::class, 'toggleStatus'])->name('socialshare.toggleStatus');

              // Social Footer routes
              Route::get('socialfooter', [SocialfooterController::class, 'index'])->name('socialfooter.index');
              Route::get('socialfooter/create', [SocialfooterController::class, 'create'])->name('socialfooter.create');
              Route::post('socialfooter', [SocialfooterController::class, 'store'])->name('socialfooter.store');
              Route::get('socialfooter/{id}/edit', [SocialfooterController::class, 'edit'])->name('socialfooter.edit');
              Route::put('socialfooter/{id}', [SocialfooterController::class, 'update'])->name('socialfooter.update');
              Route::delete('socialfooter/{id}', [SocialfooterController::class, 'destroy'])->name('socialfooter.destroy');
              Route::post('socialfooter/order', [SocialfooterController::class, 'order'])->name('socialfooter.order');
              Route::post('socialfooter/toggle-status/{id}', [SocialfooterController::class, 'toggleStatus'])->name('socialfooter.toggle-status');







        });

        
    });
});
