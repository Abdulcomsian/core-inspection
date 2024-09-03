<?php

use App\Http\Controllers\Configuration\BranchController;
use App\Http\Controllers\Configuration\CommentController;
use App\Http\Controllers\Configuration\CompetenciesMaintenanceController;
use App\Http\Controllers\Configuration\EquipmentTypeController;
use App\Http\Controllers\Configuration\GeneralSettingController;
use App\Http\Controllers\Configuration\PartMaintenanceController;
use App\Http\Controllers\Configuration\UserController;
use App\Http\Controllers\Configuration\ZoneMaintenanceController;
use App\Http\Controllers\EquipmentsController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\OtpConfirmationController;
use App\Http\Controllers\Report\InspectionController;
use App\Http\Controllers\Report\JobForcastController;
use App\Http\Controllers\Report\OverdueClientController;
use App\Http\Controllers\Report\ScheduleController;
use App\Http\Controllers\Setup\InspectionTemplateController;
use App\Http\Controllers\Setup\JobTemplateController;
use App\Http\Controllers\Setup\RegisterTemplateController;
use App\Http\Controllers\Setup\SummaryTemplateController;

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
            Route::get('create', [JobForcastController::class, 'create'])->name('create');
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

    Route::group(['prefix' => 'job', 'as' => 'job.'], function () {
        Route::get('index', [JobController::class,'index'])->name('index');
        Route::get('create', [JobController::class,'create'])->name('create');
    });

    Route::group(['prefix' => 'equipment', 'as' => 'equipment.'], function () {
        Route::get('index', [EquipmentsController::class,'index'])->name('index');
        Route::get('create', [EquipmentsController::class,'create'])->name('create');
    });

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.'], function () {
        Route::group(['prefix' => 'branch', 'as' => 'branch.'], function () {
            Route::get('index', [BranchController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'equipment_type', 'as' => 'equipment_type.'], function () {
            Route::get('index', [EquipmentTypeController::class, 'index'])->name('index');
            Route::get('create', [EquipmentTypeController::class, 'create'])->name('create');
        });
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('index', [UserController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'part_maintenance', 'as' => 'part_maintenance.'], function () {
            Route::get('index', [PartMaintenanceController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'competencies_maintenance', 'as' => 'competencies_maintenance.'], function () {
            Route::get('index', [CompetenciesMaintenanceController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'zone_maintenance', 'as' => 'zone_maintenance.'], function () {
            Route::get('index', [ZoneMaintenanceController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'predefined_comment', 'as' => 'predefined_comment.'], function () {
            Route::get('index', [CommentController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'general_setting', 'as' => 'general_setting.'], function () {
            Route::get('index', [GeneralSettingController::class, 'index'])->name('index');
        });
    });

    Route::group(['prefix' => 'setup', 'as' => 'setup.'], function () {
        Route::group(['prefix' => 'inspection_template', 'as' => 'inspection_template.'], function () {
            Route::get('index', [InspectionTemplateController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'job_template', 'as' => 'job_template.'], function () {
            Route::get('index', [JobTemplateController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'register_template', 'as' => 'register_template.'], function () {
            Route::get('index', [RegisterTemplateController::class, 'index'])->name('index');
        });
        Route::group(['prefix' => 'summary_template', 'as' => 'summary_template.'], function () {
            Route::get('index', [SummaryTemplateController::class, 'index'])->name('index');
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
