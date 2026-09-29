<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset OTP request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'We could not find an account associated with this email address.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate OTP for password reset
        $otp = $user->generateOtp('password_reset');

        try {
            Mail::to($user->email)->send(new OtpMail($otp, 'Password Reset', $user->name));
        } catch (\Exception $e) {
            Log::error('Password reset OTP Email error: ' . $e->getMessage());
        }

        session([
            'otp_user_id' => $user->id,
            'otp_action' => 'password_reset',
        ]);

        return redirect()->route('otp.verify')->with('success', 'A 6-digit password reset code has been sent to your email.');
    }
}
