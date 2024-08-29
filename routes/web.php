<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\OtpConfirmationController;
use App\Http\Controllers\Report\InspectionController;
use App\Http\Controllers\Report\JobForcastController;
use App\Http\Controllers\Report\OverdueClientController;
use App\Http\Controllers\Report\ScheduleController;

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Report

    // Job Forcast
    Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        Route::group(['prefix' => 'forcast', 'as' => 'forcast.'], function () {
            Route::get('index', [JobForcastController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => 'overdue_client', 'as' => 'overdue_client.'], function () {
            Route::get('index', [OverdueClientController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => 'inspection', 'as' => 'inspection.'], function () {
            Route::get('index', [InspectionController::class, 'index'])->name('index');
        });

        Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
            Route::get('index', [ScheduleController::class, 'index'])->name('index');
        });
    });
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::get('otp-confirmation/{username}', [OtpConfirmationController::class, 'index'])->name('otp.confirmation');
Route::post('otp-confirmation', [OtpConfirmationController::class, 'verification'])->name('password.otp.verification');

Route::get('reset-password/{username}/{otp}', [ResetPasswordController::class, 'index'])->name('reset.password');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');
