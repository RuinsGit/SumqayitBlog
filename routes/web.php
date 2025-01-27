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
use App\Http\Controllers\Admin\HomecartController;
use App\Http\Controllers\Admin\WorklifeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\MapController;
use App\Http\Controllers\Admin\ContactMarketingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryVideoController;
use App\Http\Controllers\Admin\ArticleController;

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
            Route::prefix('socialshare')->group(function () {
                Route::get('/', [SocialshareController::class, 'index'])->name('socialshare.index');
                Route::get('/create', [SocialshareController::class, 'create'])->name('socialshare.create');
                Route::post('/', [SocialshareController::class, 'store'])->name('socialshare.store');
                Route::get('/{id}/edit', [SocialshareController::class, 'edit'])->name('socialshare.edit');
                Route::put('/{id}', [SocialshareController::class, 'update'])->name('socialshare.update');
                Route::delete('/{id}', [SocialshareController::class, 'destroy'])->name('socialshare.destroy');
                Route::post('/order', [SocialshareController::class, 'order'])->name('socialshare.order');
                Route::post('/{id}/toggle-status', [SocialshareController::class, 'toggleStatus'])->name('socialshare.toggleStatus');
                Route::post('/updatesitelink', [SocialshareController::class, 'updateSitelink'])->name('socialshare.updatesitelink');
            });

              // Social Footer routes
              Route::get('socialfooter', [SocialfooterController::class, 'index'])->name('socialfooter.index');
              Route::get('socialfooter/create', [SocialfooterController::class, 'create'])->name('socialfooter.create');
              Route::post('socialfooter', [SocialfooterController::class, 'store'])->name('socialfooter.store');
              Route::get('socialfooter/{id}/edit', [SocialfooterController::class, 'edit'])->name('socialfooter.edit');
              Route::put('socialfooter/{id}', [SocialfooterController::class, 'update'])->name('socialfooter.update');
              Route::delete('socialfooter/{id}', [SocialfooterController::class, 'destroy'])->name('socialfooter.destroy');
              Route::post('socialfooter/order', [SocialfooterController::class, 'order'])->name('socialfooter.order');
              Route::post('socialfooter/toggle-status/{id}', [SocialfooterController::class, 'toggleStatus'])->name('socialfooter.toggle-status');

              // Homecart
            Route::resource('homecart', HomecartController::class);

            // Worklife
            Route::resource('worklife', WorklifeController::class);
            Route::get('worklife', [WorklifeController::class, 'index'])->name('worklife.index');
            Route::get('worklife/create', [WorklifeController::class, 'create'])->name('worklife.create');
            Route::post('worklife', [WorklifeController::class, 'store'])->name('worklife.store');
            Route::get('worklife/{id}/edit', [WorklifeController::class, 'edit'])->name('worklife.edit');
            Route::put('worklife/{id}', [WorklifeController::class, 'update'])->name('worklife.update');
            Route::delete('worklife/{id}', [WorklifeController::class, 'destroy'])->name('worklife.destroy');

            Route::resource('about', AboutController::class);

            // Maps
            
            Route::get('maps', [MapController::class, 'index'])->name('maps.index');
            Route::get('maps/create', [MapController::class, 'create'])->name('maps.create');
            Route::post('maps', [MapController::class, 'store'])->name('maps.store');
            Route::get('maps/{id}/edit', [MapController::class, 'edit'])->name('maps.edit');
            Route::put('maps/{id}', [MapController::class, 'update'])->name('maps.update');
            Route::delete('maps/{id}', [MapController::class, 'destroy'])->name('maps.destroy');
            Route::get('maps/{id}', [MapController::class, 'show'])->name('maps.show');

            Route::resource('contact_marketing', ContactMarketingController::class);
            Route::get('contact_marketing/{id}', [ContactMarketingController::class, 'show'])->name('contact_marketing.show');
            Route::delete('contact_marketing/{id}', [ContactMarketingController::class, 'destroy'])->name('contact_marketing.destroy');


            // Gallery routes
            Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
            Route::get('galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
            Route::post('galleries', [GalleryController::class, 'store'])->name('galleries.store');
            Route::get('galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
            Route::put('galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
            Route::delete('galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

            // Gallery Video routes
            Route::get('gallery-videos', [GalleryVideoController::class, 'index'])->name('gallery-videos.index');
            Route::get('gallery-videos/create', [GalleryVideoController::class, 'create'])->name('gallery-videos.create');
            Route::post('gallery-videos', [GalleryVideoController::class, 'store'])->name('gallery-videos.store');
            Route::get('gallery-videos/{galleryVideo}/edit', [GalleryVideoController::class, 'edit'])->name('gallery-videos.edit');
            Route::put('gallery-videos/{galleryVideo}', [GalleryVideoController::class, 'update'])->name('gallery-videos.update');
            Route::delete('gallery-videos/{galleryVideo}', [GalleryVideoController::class, 'destroy'])->name('gallery-videos.destroy');

            Route::resource('articles', ArticleController::class);
            Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
            Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
            Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
            Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
            Route::put('articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
            Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
        });

        
    });
});


