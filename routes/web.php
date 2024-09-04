<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\{HomeController, AuthenticationController,  MessageController, DisbursementController, CollectionController, AdminController, UserController, VendorController, ServiceCategoryController, ServiceController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Language Translation
Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root')->middleware('guest');

//Update User Details
Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');
Route::post('get-country-cities', [VendorController::class, 'getCountryCities'])->name('getCountryCities');
Route::post('get-cities-town', [VendorController::class, 'getCityTowns'])->name('getCityTowns');

Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::group(['middleware' => ['web']], function () {
    // Route::get('/', 'HomeController@index')->name('home');

    // Auth::routes([
    //     'register' => false, // Registration Routes...
    //     'reset' => false, // Password Reset Routes...
    //     'verify' => false, // Email Verification Routes...
    // ]);

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin', 'approved_user']], function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('service-categories', ServiceCategoryController::class);
        Route::get('get-service/{id}', [AdminController::class, 'getService'])->name('getService');
        Route::post('set-price', [AdminController::class, 'setPrice'])->name('setPrice');
        Route::get('service-providers', [AdminController::class, 'ServiceProvider'])->name('ServiceProvider');
        Route::get('user-accounts', [AdminController::class, 'UserAccounts'])->name('UserAccounts');
        Route::get('get-Vendor-Details/{id}', [AdminController::class, 'getVendorDetails'])->name('getVendorDetails');
        Route::post('/updateVendor', [AdminController::class, 'updateVendor'])->name('UpdateVendor');
        Route::get('admin-accounts', [AdminController::class, 'AdminAccounts'])->name('AdminAccounts');
        Route::get('approvals', [AdminController::class, 'Approvals'])->name('Approvals');
        Route::get('onboarding-approvals', [AdminController::class, 'onBoardingApprovals'])->name('onBoardingApprovals');
        Route::get('service-approvals', [AdminController::class, 'serviceApprovals'])->name('serviceApprovals');
        Route::get('onboarding-vendor-profile/{id}/{service_id?}', [AdminController::class, 'onBoardingVendorProfile'])->name('onBoardingVendorProfile');
        Route::get('locations', [AdminController::class, 'locations'])->name('Locations');
        Route::get('appointments', [AdminController::class, 'Appointments'])->name('Appointments');
        Route::get('services', [AdminController::class, 'providerServices'])->name('providerServices');
        Route::get('booked-services', [AdminController::class, 'Appointments'])->name('Appointments');
        Route::get('interviews', [AdminController::class, 'Interviews'])->name('Interviews');
        Route::get('/venderdetails', [AdminController::class, 'VenderDetails'])->name('VenderDetails');
        Route::get('all-transactions', [AdminController::class, 'Transactions'])->name('Transactions');
        Route::get('disputed-transactions', [AdminController::class, 'Dispute'])->name('Dispute');
        Route::get('request-to-pay', [CollectionController::class, 'requestToPay'])->name('requestToPay');
        Route::get('/service-details/{id}', [AdminController::class, 'appointmentDetails'])->name('appointmentDetails');
        Route::get('/services-commision', [AdminController::class, 'appointmentCommision'])->name('appointmentCommision');
        Route::post('approve-provider-payment/{id}', [DisbursementController::class, 'adminApproveVendorPayment'])->name('adminApproveVendorPayment');
        Route::get('service-provider-detail/{id}', [AdminController::class, 'serviceProviderDetail'])->name('serviceProviderDetail');
        Route::post('update-approval-status', [AdminController::class, 'updateApprovalStatus'])->name('updateApprovalStatus');
        Route::post('update-onboarding-status', [AdminController::class, 'updateonBoardingStatus'])->name('updateonBoardingStatus');
        Route::post('add-country', [AdminController::class, 'addCountry'])->name('addCountry');
        Route::post('add-city', [AdminController::class, 'addCity'])->name('addCity');
        Route::post('add-town', [AdminController::class, 'addTown'])->name('addTown');
        Route::post('request/approve/{id}', [AdminController::class, 'approveRequest'])->name('approveRequest');
        Route::post('request/reject/{id}', [AdminController::class, 'rejectRequest'])->name('rejectRequest');
        Route::post('download-services-pdf', [AdminController::class, 'downloadServicesPdf'])->name('downloadServicesPdf');
        // Route::get('dashboard', [AdminController::class,'Dashboard'])->name('Dashboard');
    });
    // 'approved_user'
    Route::group(['prefix' => 'service-provider', 'as' => 'vendor.', 'middleware' => ['auth', 'verify.email', 'role:vendor_user']], function () {
        Route::get('/profile', [VendorController::class, 'Profile'])->name('Profile');
        Route::post('/update-info', [VendorController::class, 'updateInfo'])->name('updateInfo');
        Route::post('/upload-avatar', [VendorController::class, 'uploadAvatar'])->name('upload.avatar');
        Route::get('/onBoarding', [VendorController::class, 'OnBoarding'])->name('OnBoarding');
        Route::get('/profile-submit', [VendorController::class, 'profileSubmit'])->name('profileSubmit');
        Route::post('/delete-qualification', [VendorController::class, 'deleteQualification'])->name('delete.qualification');
        Route::get('/edit-profile', [VendorController::class, 'EditProfile'])->name('EditProfile');
        Route::get('/payments', [VendorController::class, 'Payments'])->name('Payments');
        Route::post('add-service', [VendorController::class, 'addService'])->name('addService');
        Route::get('/manage-services', [VendorController::class, 'ManageServices'])->name('ManageServices');
        Route::post('/withdraw-fund', [DisbursementController::class, 'WithDrawFund'])->name('WithDrawFund');
        Route::get('/service-providers', [VendorController::class, 'index'])->name('vendor_user');
        Route::resource('services', ServiceController::class);
        Route::get('/dashboard', [VendorController::class, 'Dashboard'])->name('Dashboard');
        Route::get('/bookings', [VendorController::class, 'Bookings'])->name('Bookings');
        Route::get('/tasks', [VendorController::class, 'Tasks'])->name('Tasks');
        Route::get('/wallet', [VendorController::class, 'Wallet'])->name('Wallet');
        Route::get('/booked-services', [VendorController::class, 'Appointments'])->name('Appointments');
        Route::get('/service-reviews/{id}', [VendorController::class, 'serviceReviews'])->name('serviceReviews');
        Route::get('/service-details/{id}', [VendorController::class, 'appointmentDetails'])->name('appointmentDetails');
        Route::post('send-text-to-user', [MessageController::class, 'sendTextToUser'])->name('sendTextToUser');
        Route::post('add-biography', [VendorController::class, 'addBiography'])->name('addBiography');
        Route::post('add-servicetype', [VendorController::class, 'addServiceType'])->name('addServiceType');
        Route::post('add-appointment-schedule', [VendorController::class, 'addAppointmentSchedule'])->name('addAppointmentSchedule');
        Route::post('add-company-contact', [VendorController::class, 'addCompanyContactDetails'])->name('addCompanyContactDetails');
        Route::post('add-company-location', [VendorController::class, 'addCompanyLocation'])->name('addCompanyLocation');
        Route::post('get-qualification-row', [VendorController::class, 'getQualificationRow'])->name('getQualificationRow');
        Route::post('update-qualification', [VendorController::class, 'updateQualification'])->name('updateQualification');

        Route::group(['middleware' => ['verify.email', 'approved_user']], function () {
            Route::get('/payments', [VendorController::class, 'Payments'])->name('Payments');
            Route::post('add-service', [VendorController::class, 'addService'])->name('addService');
            Route::get('/manage-services', [VendorController::class, 'ManageServices'])->name('ManageServices');
            Route::post('/withdraw-fund', [DisbursementController::class, 'WithDrawFund'])->name('WithDrawFund');
            Route::get('/vendor-user', [VendorController::class, 'index'])->name('vendor_user');
            Route::resource('services', ServiceController::class);
            Route::get('/dashboard', [VendorController::class, 'Dashboard'])->name('Dashboard');
            Route::get('/bookings', [VendorController::class, 'Bookings'])->name('Bookings');
            Route::get('/tasks', [VendorController::class, 'Tasks'])->name('Tasks');
            Route::get('/wallet', [VendorController::class, 'Wallet'])->name('Wallet');
            Route::get('/appointments', [VendorController::class, 'Appointments'])->name('Appointments');
            Route::post('/appointments/approve/{id}', [VendorController::class, 'approveAppointment'])->name('appointments.approve');
            Route::post('/appointments/reject/{id}', [VendorController::class, 'rejectAppointment'])->name('appointments.reject');
            Route::get('/appointment-details/{id}/{user_id}', [VendorController::class, 'appointmentDetails'])->name('appointmentDetails');
            Route::post('send-text-to-user', [MessageController::class, 'sendTextToUser'])->name('sendTextToUser');
        });
    });
    Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'role:user', 'approved_user', 'verify.email']], function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/details', [UserController::class, 'Details'])->name('Details');
        Route::get('/event', [MessageController::class, 'performEvent']);
        Route::get('/payments', [UserController::class, 'Payments'])->name('Payments');
        Route::get('/transactions', [UserController::class, 'Transactions'])->name('Transactions');
        Route::get('dashboard', [UserController::class, 'Dashboard'])->name('Dashboard');
        Route::get('edit-profile', [UserController::class, 'editProfile'])->name('edit.profile');
        Route::put('update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
        Route::get('/booked-services', [UserController::class, 'Appointments'])->name('Appointments');
        Route::get('/appointments/search', [UserController::class, 'searchAppointment'])->name('search-appointment');
        Route::get('/service-detail/{id}/{vendor_id}', [UserController::class, 'appointmentDetails'])->name('appointmentDetails');
        Route::get('/service-providers', [UserController::class, 'ServiceProviders'])->name('ServiceProviders');
        Route::get('/get-country-cities', [UserController::class, 'getCountryCities'])->name('getCountryCities');
        Route::get('/{id}/profile', [UserController::class, 'Profile'])->name('Profile');
        Route::post('make-appointment', [UserController::class, 'makeAppointment'])->name('makeAppointment');
        Route::post('submit-payment', [CollectionController::class, 'submitPayment'])->name('submit_payment');
        Route::get('/services', [UserController::class, 'Services'])->name('Services');
        Route::get('vendor/{vendor_id}/service-details/{id}', [UserController::class, 'vendorServiceDetails'])->name('vendor_service_details');
        Route::get('service-details/{id}', [UserController::class, 'serviceDetails'])->name('service_details');
        Route::get('/wallet', [UserController::class, 'Wallet'])->name('Wallet');
        Route::post('approve-payment/{id}', [CollectionController::class, 'approvePayment'])->name('approve_payment');
        Route::post('make-payment/{id}', [CollectionController::class, 'makeCollectionPayment'])->name('makeCollectionPayment');
        Route::post('approve-provider-payment/{id}', [DisbursementController::class, 'userApproveVendorPayment'])->name('userApproveVendorPayment');
        Route::post('send-text-to-vendor', [MessageController::class, 'sendTextToVendor'])->name('sendTextToVendor');
        Route::post('submit-review', [UserController::class, 'submitReview'])->name('submitReview');
        Route::post('add-balance', [UserController::class, 'addBalance'])->name('addBalance');
        Route::get('transaction-history', [UserController::class, 'transactionHistory'])->name('transactionHistory');
        Route::get('/service-reviews/{id}', [UserController::class, 'serviceReviews'])->name('serviceReviews');
    });
    Route::group(['middleware' => ['web', 'auth', 'approved_user']], function () {
        Route::post('/update-user', [UserController::class, 'updateUser'])->name('update_user');
        Route::post('/delete-user', [UserController::class, 'deleteUser'])->name('delete_user');
    });
    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/email/verify/{id}/{hash}', [AuthenticationController::class, 'verify_email'])->name('verification.verify');
    //dashborad routes ends here////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Route::get('/{any}', [FrontendController::class, 'error'])->where('any', '.*');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});
