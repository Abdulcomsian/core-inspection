<?php

use App\Http\Controllers\ClientController;
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
use App\Http\Controllers\Setup\ServiceTemplateController;
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
        Route::group([
            'prefix' => 'forcast',
            'as' => 'forcast.',
            'controller' => JobForcastController::class
        ], function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
        });

        Route::group([
            'prefix' => 'overdue_client',
            'as' => 'overdue_client.',
            'controller' => OverdueClientController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });

        Route::group([
            'prefix' => 'inspection',
            'as' => 'inspection.',
            'controller' => InspectionController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });

        Route::group([
            'prefix' => 'schedule',
            'as' => 'schedule.',
            'controller' => ScheduleController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
    });

    Route::group([
        'prefix' => 'job',
        'as' => 'job.',
        'controller' => JobController::class
    ], function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
    });

    Route::group([
        'prefix' => 'equipment',
        'as' => 'equipment.',
        'controller' => EquipmentsController::class
    ], function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
    });

    Route::group([
        'prefix' => 'client',
        'as' => 'client.',
        'controller' => ClientController::class
    ], function (): void {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
    });

    Route::group(['prefix' => 'configuration', 'as' => 'configuration.',], function () {
        Route::group([
            'prefix' => 'branch',
            'as' => 'branch.',
            'controller' => BranchController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'equipment_type',
            'as' => 'equipment_type.',
            'controller' => EquipmentTypeController::class
        ], function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
        });
        Route::group([
            'prefix' => 'users',
            'as' => 'users.',
            'controller' => UserController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'part_maintenance',
            'as' => 'part_maintenance.',
            'controller' => PartMaintenanceController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'competencies_maintenance',
            'as' => 'competencies_maintenance.',
            'controller' => CompetenciesMaintenanceController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'zone_maintenance',
            'as' => 'zone_maintenance.',
            'controller' => ZoneMaintenanceController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'predefined_comment',
            'as' => 'predefined_comment.',
            'controller' => CommentController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'general_setting',
            'as' => 'general_setting.',
            'controller' => GeneralSettingController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
    });

    Route::group(['prefix' => 'setup', 'as' => 'setup.'], function () {
        Route::group([
            'prefix' => 'inspection_template',
            'as' => 'inspection_template.',
            'controller' => InspectionTemplateController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'job_template',
            'as' => 'job_template.',
            'controller' => JobTemplateController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'register_template',
            'as' => 'register_template.',
            'controller' => RegisterTemplateController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'service_template',
            'as' => 'service_template.',
            'controller' => ServiceTemplateController::class
        ], function () {
            Route::get('index', 'index')->name('index');
        });
        Route::group([
            'prefix' => 'summary_template',
            'as' => 'summary_template.',
            'controller' => SummaryTemplateController::class
        ], function () {
            Route::get('index', 'index')->name('index');
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
