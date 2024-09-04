<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function verify_email(Request $request, $id)
    {
        $user = User::find($id);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
        Auth::login($user);

        if (auth()->user()->hasRole('user')) {
            toastr()->success('Dear User, You account has been verified successfully ');
            return redirect('user/dashboard');
        } elseif (auth()->user()->hasRole('vendor_user')) {
            toastr()->success('Dear Service Provider, You account has been verified successfully ');
            return redirect('service-provider/dashboard');
        } elseif (auth()->user()->hasRole('admin')) {
            return redirect('admin/dashboard');
        }
    }
}
