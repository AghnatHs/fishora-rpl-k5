<?php

namespace App\Http\Controllers\CustomerAuth;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use PHPUnit\TextUI\Configuration\Constant;

class PasswordResetController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('customer.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('customers')->sendResetLink($request->only('email'));

        if ($status === Password::RESET_THROTTLED) {
            return back()->withErrors(['email' => Constants\Messages::TOO_MANY_ATTEMPTS_RESET_PASSWORD]);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', Constants\Messages::RESET_PASSWORD_LINK_SENT)
            : back()->withErrors(['email' => $status]);
    }

    public function showResetForm(Request $request, $token)
    {
        return view('customer.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::broker('customers')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($customer, $password) {
                $customer->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('customer.login')->with('success', Constants\Messages::SUCCESS_RESET_PASSWORD)
            : back()->withErrors(['email' => [__($status)]]);
    }
}
