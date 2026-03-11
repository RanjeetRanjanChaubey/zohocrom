<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    });

    // Authenticated admin routes
    Route::middleware(['auth:admin', 'admin.activity'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
        |---------------------------------------
        | Settings Routes
        |---------------------------------------
        */

      

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
            Route::get('settings/{id}/edit', [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('settings.edit');
            Route::post('settings/{id}', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
        });

    });

     Route::get('setting/role', [SettingController::class,'role'])
     ->name('setting.role');

      Route::get('setting/general', [SettingController::class,'general'])
     ->name('setting.general');

     Route::get('setting/userlist', [SettingController::class,'userlist'])
     ->name('setting.userlist');
     
});

 Route::prefix('admin/settings')->name('admin.settings.')->group(function () {
    Route::get('/general', [SettingController::class, 'general'])->name('general');
    Route::post('/general', [SettingController::class, 'updateGeneral'])->name('general.update');

});