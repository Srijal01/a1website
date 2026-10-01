<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('pages', PageController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('portfolio', PortfolioController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('blog-posts', BlogPostController::class);
        Route::resource('clients', ClientController::class);
        Route::resource('technologies', TechnologyController::class);
        Route::resource('team-members', TeamMemberController::class);

        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
        Route::post('/contact-messages/{contactMessage}/mark-replied', [ContactMessageController::class, 'markReplied'])->name('contact-messages.mark-replied');

        Route::get('/settings', [WebsiteSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [WebsiteSettingController::class, 'update'])->name('settings.update');
    });
});
