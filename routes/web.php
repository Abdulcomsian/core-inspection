<?php

use App\Http\Controllers\Job\RentalsController;
use App\Http\Controllers\Job\InspectionController;
use App\Http\Controllers\Job\SchedulerController;
use App\Http\Controllers\asset\EquipmentTypeController;
use App\Http\Controllers\asset\PartController;
use App\Http\Controllers\Client\LocationController;
use App\Http\Controllers\Client\ZoneController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\equipment\EquipmentController;
use App\Http\Controllers\equipment\MultipleEquipmentController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\OtpConfirmationController;
use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Report\ScheduleController;
use App\Http\Controllers\Report\JobForcastController;
use App\Http\Controllers\Setup\JobTemplateController;
use App\Http\Controllers\Configuration\BranchController;
use App\Http\Controllers\Report\OverdueClientController;
use App\Http\Controllers\Configuration\CommentController;
use App\Http\Controllers\Setup\ServiceTemplateController;
use App\Http\Controllers\Setup\SummaryTemplateController;
use App\Http\Controllers\Setup\RegisterTemplateController;
use App\Http\Controllers\Setup\InspectionTemplateController;
use App\Http\Controllers\Configuration\GeneralSettingController;
use App\Http\Controllers\Configuration\PartMaintenanceController;
use App\Http\Controllers\Configuration\ZoneMaintenanceController;
use App\Http\Controllers\Configuration\CompetenciesMaintenanceController;

// Redirect to login page by default
Route::redirect('/', '/login');

// Home Route
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }
    return redirect()->route('admin.home');
});

// Authentication Routes
Auth::routes();

// Group all authenticated routes
Route::middleware(['auth'])->namespace('Admin')->group(function () {

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
});
Route::middleware(['auth'])->group(function () {
    // Job Routes
    Route::prefix('job')->name('job.')->group(function () {
        // Rentals
        Route::prefix('rental')->name('rental.')->controller(RentalsController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
        });

        // Inspection
        Route::prefix('inspection')->name('inspection.')->controller(InspectionController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('show', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::get('edit', 'edit')->name('edit');
        });

        // Scheduler
        Route::prefix('scheduler')->name('scheduler.')->controller(SchedulerController::class)->group(function () {
            Route::get('index', 'index')->name('index');
        });
    });

    // Assets Routes
    Route::prefix('asset')->name('asset.')->group(function () {
        // Equipment Type
        Route::prefix('equipment_type')->name('equipment_type.')->controller(EquipmentTypeController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('show', 'show')->name('show');
        });

        // Part
        Route::prefix('part')->name('part.')->controller(PartController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('show', 'show')->name('show');
        });
    });

    // Clients Routes
    Route::prefix('client')->name('client.')->group(function () {
        // Location
        Route::prefix('location')->name('location.')->controller(LocationController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('show', 'show')->name('show');
        });

        // Zone
        Route::prefix('zone')->name('zone.')->controller(ZoneController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('show', 'show')->name('show');
        });

        // User
        Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('show', 'show')->name('show');
        });
    });

    // Equipment Routes
    Route::prefix('equipment')->name('equipment.')->group(function () {
        Route::controller(EquipmentController::class)->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::get('show', 'show')->name('show');
        });
        Route::prefix('multiple')->name('multiple.')->controller(MultipleEquipmentController::class)->group(function () {
            Route::get('create', 'create')->name('create');
        });
    });

    // Billing Routes
    Route::prefix('billing')->name('billing.')->controller(BillingController::class)->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
    });

    // Report Routes
    // Route::prefix('report')->name('report.')->group(function () {

    //     // Job Forecast
    //     Route::prefix('forcast')->name('forcast.')->controller(JobForcastController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //         Route::get('create', 'create')->name('create');
    //     });

    //     // Overdue Client
    //     Route::prefix('overdue_client')->name('overdue_client.')->controller(OverdueClientController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Inspection
    //     Route::prefix('inspection')->name('inspection.')->controller(InspectionController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Schedule
    //     Route::prefix('schedule')->name('schedule.')->controller(ScheduleController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });
    // });

    // // Job Routes
    // Route::prefix('job')->name('job.')->controller(JobController::class)->group(function () {
    //     Route::get('index', 'index')->name('index');
    //     Route::get('create', 'create')->name('create');
    // });

    // // Equipment Routes
    // Route::prefix('equipment')->name('equipment.')->controller(EquipmentsController::class)->group(function () {
    //     Route::get('index', 'index')->name('index');
    //     Route::get('create', 'create')->name('create');
    // });

    // // Client Routes
    // Route::prefix('client')->name('client.')->controller(ClientController::class)->group(function () {
    //     Route::get('index', 'index')->name('index');
    //     Route::get('create', 'create')->name('create');
    // });

    // // Configuration Routes
    // Route::prefix('configuration')->name('configuration.')->group(function () {

    //     // Branch Configuration
    //     Route::prefix('branch')->name('branch.')->controller(BranchController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Equipment Type Configuration
    //     Route::prefix('equipment_type')->name('equipment_type.')->controller(EquipmentTypeController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //         Route::get('create', 'create')->name('create');
    //     });

    //     // User Configuration
    //     Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Part Maintenance Configuration
    //     Route::prefix('part_maintenance')->name('part_maintenance.')->controller(PartMaintenanceController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Competencies Maintenance
    //     Route::prefix('competencies_maintenance')->name('competencies_maintenance.')->controller(CompetenciesMaintenanceController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Zone Maintenance
    //     Route::prefix('zone_maintenance')->name('zone_maintenance.')->controller(ZoneMaintenanceController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Predefined Comment
    //     Route::prefix('predefined_comment')->name('predefined_comment.')->controller(CommentController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // General Settings
    //     Route::prefix('general_setting')->name('general_setting.')->controller(GeneralSettingController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });
    // });

    // // Setup Routes
    // Route::prefix('setup')->name('setup.')->group(function () {

    //     // Inspection Template
    //     Route::prefix('inspection_template')->name('inspection_template.')->controller(InspectionTemplateController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Job Template
    //     Route::prefix('job_template')->name('job_template.')->controller(JobTemplateController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Register Template
    //     Route::prefix('register_template')->name('register_template.')->controller(RegisterTemplateController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Service Template
    //     Route::prefix('service_template')->name('service_template.')->controller(ServiceTemplateController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });

    //     // Summary Template
    //     Route::prefix('summary_template')->name('summary_template.')->controller(SummaryTemplateController::class)->group(function () {
    //         Route::get('index', 'index')->name('index');
    //     });
    // });
});

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware(['auth'])->group(function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});

// OTP Confirmation
Route::get('otp-confirmation/{username}', [OtpConfirmationController::class, 'index'])->name('otp.confirmation');
Route::post('otp-confirmation', [OtpConfirmationController::class, 'verification'])->name('password.otp.verification');

// Reset Password
Route::get('reset-password/{username}/{otp}', [ResetPasswordController::class, 'index'])->name('reset.password');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('reset-password');
