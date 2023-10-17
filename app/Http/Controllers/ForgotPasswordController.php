<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    // public function forgotpassword()
    // {
    //     return view('auth.forgot');
    // }

    // public function PostForgotPassword(UserRequest $request)
    // {
    //     $status = Password::broker('users_custom')->sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? back()->with('status', __($status))
    //         : back()->withErrors(['email' => __($status)]);

    // }
}
