<?php

namespace App\Http\Controllers\Auth;

use Notification;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Notifications\RegisterNotification;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function register(Request $request)
    // {
    //     $avatarName = null;

    //     $validator = Validator::make($request->all(), [
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'role' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //         'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024', 'dimensions:max_height=300,max_width=300'],
    //         'services' => ['required_if:role,vendor', 'array'],
    //         'services.*' => ['integer', 'exists:service_categories,id'],
    //         'gender' => ['required', 'integer', 'in:0,1,2'],
    //         'phone' => ['required', 'string', 'max:20'],
    //     ], [
    //         'avatar.dimensions' => 'avatar must have maximum height and width of 300 pixels',
    //     ]);

    //     if ($validator->fails()) {
    //         $errorMessage = '';
    //         foreach ($validator->errors()->all() as $error) {
    //             $errorMessage = $errorMessage . $error . "\n";
    //         }
    //         toastr($errorMessage, 'error');
    //         return redirect()->back()->withInput();
    //     }

    //     if ($request->has('avatar')) {
    //         $avatar = $request->file('avatar');
    //         $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
    //         $avatarPath = public_path('/images/');
    //         $avatar->move($avatarPath, $avatarName);
    //     }

    //     if ($request->role == 'user') {
    //         $is_approve = 1;
    //         $userRole = 'user';
    //         $userType = 'User';
    //     } else {
    //         $is_approve = 0;
    //         $userRole = 'vendor_user';
    //         $userType = 'Vendor';
    //     }

    //     $user = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name' => $request->last_name,
    //         'name' => $request->first_name . ' ' . $request->last_name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'email_verified_at' => now(),
    //         'is_approved' => $is_approve,
    //         'avatar' =>  $avatarName,
    //         'gender' => $request->gender,
    //         'phone' => $request->phone,
    //     ]);

    //     $user->assignRole($userRole);

    //     if ($request->role == 'vendor' && $request->has('services')) {
    //         foreach ($request->services as $serviceCategoryId) {
    //             Service::create([
    //                 'service_category_id' => $serviceCategoryId,
    //                 'user_id' => $user->id,
    //             ]);
    //         }
    //     }

    //     Notification::route('mail', 'info@mavenprojects.cc')->notify(new RegisterNotification($user, $userType));
    //     toastr()->success('Successfully registered, a verification link has been sent to your email account, kindly verify your email');
    //     event(new Registered($user));

    //     return redirect()->route('login');
    // }

    protected function register(Request $request)
{
    $avatarName = null;

    $validator = Validator::make($request->all(), [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'role' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024', 'dimensions:max_height=300,max_width=300'],
        'services' => ['required_if:role,vendor', 'array'],
        'services.*' => ['integer', 'exists:service_categories,id'],
        'gender' => ['required', 'integer', 'in:0,1,2'],
        'phone' => ['required', 'string', 'max:20'],
    ], [
        'avatar.dimensions' => 'avatar must have maximum height and width of 300 pixels',
    ]);

    if ($validator->fails()) {
        $errorMessage = '';
        foreach ($validator->errors()->all() as $error) {
            $errorMessage .= $error . "\n";
        }
        toastr($errorMessage, 'error');
        return redirect()->back()->withInput();
    }

    if ($request->has('avatar')) {
        $avatar = $request->file('avatar');
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $avatarPath = public_path('/images/');
        $avatar->move($avatarPath, $avatarName);
    }

    if ($request->role == 'user') {
        $is_approve = 1;
        $userRole = 'user';
        $userType = 'User';

        // Generate User Unique Identifier
        $latestUser = User::role('user')->orderBy('id', 'desc')->first();
        $userIdentifier = $latestUser ? sprintf('%05d', $latestUser->id + 1) . 'U' : '00001U';

    } else {
        $is_approve = 0;
        $userRole = 'vendor_user';
        $userType = 'Vendor';

        // Generate Vendor Unique Identifier
        $latestVendor = User::role('vendor_user')->orderBy('id', 'desc')->first();
        $userIdentifier = $latestVendor ? sprintf('%05d', $latestVendor->id + 1) . 'P' : '00001P';
    }

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'name' => $request->first_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'email_verified_at' => now(),
        'is_approved' => $is_approve,
        'avatar' =>  $avatarName,
        'gender' => $request->gender,
        'phone' => $request->phone,
        'identifier' => $userIdentifier, // Store the unique identifier
    ]);

    $user->assignRole($userRole);

    if ($request->role == 'vendor' && $request->has('services')) {
        foreach ($request->services as $serviceCategoryId) {
            Service::create([
                'service_category_id' => $serviceCategoryId,
                'user_id' => $user->id,
            ]);
        }
    }

    Notification::route('mail', 'info@mavenprojects.cc')->notify(new RegisterNotification($user, $userType));
    toastr()->success('Successfully registered, a verification link has been sent to your email account, kindly verify your email');
    event(new Registered($user));

    return redirect()->route('login');
}

}
