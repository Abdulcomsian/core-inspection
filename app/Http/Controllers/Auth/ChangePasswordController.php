<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        return view('auth.passwords.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $user->update($request->validated());

        return redirect()->route('profile.password.edit')->with('message', __('global.change_password_success'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $directoryPath = public_path('assets/media/profile');

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $signaturePath = $user->signature;
        if ($request->hasFile('signature')) {
            $fileName = Str::uuid() . '.' . $request->file('signature')->getClientOriginalExtension();

            $request->file('signature')->move($directoryPath, $fileName);

            $signaturePath = 'assets/media/profile/' . $fileName;

            if ($user->signature && file_exists(public_path($user->signature))) {
                unlink(public_path($user->signature));
            }

            $user->signature = $signaturePath;
        }

        $user->update([
            'qualification' => $request->input('qualification'),
            'job_title' => $request->input('job_title'),
            'signature' => $signaturePath,
        ]);

        return response([
            'status' => 'success',
            'message' => 'Profile Updated Successfully!',
        ], 200);
    }

    public function destroy()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);

        $user->update([
            'email' => time() . '_' . $user->email,
        ]);

        $user->delete();

        return redirect()->route('login')->with('message', __('global.delete_account_success'));
    }
}
