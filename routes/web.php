<?php
// I am write from claude ai dashboard

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController; 
use App\Http\Controllers\Admin\HomePageController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\HomeController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/aaa', function () {
    return view('admin.home.manage');
});


// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    
    // Protected admin routes - basic admin check
    Route::middleware(['auth', AdminMiddleware::class])->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Role management (admin only)
        Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
            Route::resource('roles', RoleController::class)
            ->parameters(['roles' => 'user']);
        });
        
        // Home page management (admin and editor)
        // Route::middleware([RoleMiddleware::class . ':admin,editor'])->group(function () {
        //     Route::get('/home-page', [HomePageController::class, 'index'])->name('home-page');

            
        // });

         // Home page management (admin and editor) - COMPLETE ROUTES
        Route::middleware([RoleMiddleware::class . ':admin,editor'])->group(function () {
            Route::get('/home/manage', [HomePageController::class, 'index'])->name('home.manage');
             Route::post('/home/save', [HomePageController::class, 'storeOrUpdate'])->name('home.save');
        });
    });
});