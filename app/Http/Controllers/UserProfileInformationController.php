<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileInformationController extends Controller
{
    public function show(Request $request)
    {
        return view('profile.show', [
            'request' => $request,
            'user' => $request->user()
        ]);
    }

    public function email_verification($id, $token)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->email_verified_at) {
                return "Email sudah diverifikasi";
            }

            $user->update([
                'email_verified_at' => now(),
                'remember_token' => $token
            ]);
        }

        return "Email berhasil diverifikasi";
    }
}
