<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class OtpVerificationController extends Controller
{
    /**
     * Show the OTP verification form
     */
    public function show(Request $request): View|RedirectResponse
    {
        $userId = session('otp_user_id');
        $action = session('otp_action', 'register');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Session expired. Please try again.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        // Mask email e.g. a***r@gmail.com
        $emailParts = explode('@', $user->email);
        $name = $emailParts[0];
        $domain = $emailParts[1] ?? 'gmail.com';
        $maskedName = substr($name, 0, 1) . str_repeat('*', max(strlen($name) - 2, 2)) . substr($name, -1);
        $maskedEmail = $maskedName . '@' . $domain;

        return view('auth.verify-otp', [
            'user' => $user,
            'maskedEmail' => $maskedEmail,
            'action' => $action,
        ]);
    }

    /**
     * Verify the entered OTP code
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $userId = session('otp_user_id');
        $action = session('otp_action', 'register');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Session expired. Please start over.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        if (!$user->verifyOtp($request->otp_code, $action)) {
            return back()->withErrors(['otp_code' => 'Invalid or expired OTP code. Please enter the latest 6-digit code or request a new one.']);
        }

        // Handle successful OTP verification based on action
        if ($action === 'register' || $action === 'login') {
            session()->forget(['otp_user_id', 'otp_action']);
            Auth::login($user);
            $request->session()->regenerate();

            if ($user->is_admin) {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome to Admin Panel!');
            }

            return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Email verified successfully! Welcome to ' . config('app.name', 'LuxeStore') . '!');
        }

        if ($action === 'password_reset') {
            // Keep user in session for the reset password step
            session(['password_reset_user_id' => $user->id]);
            session()->forget(['otp_user_id', 'otp_action']);
            return redirect()->route('otp.reset-password-form')->with('success', 'OTP verified! Now choose a new password.');
        }

        return redirect()->route('home');
    }

    /**
     * Resend OTP to user's email
     */
    public function resend(Request $request): RedirectResponse
    {
        $userId = session('otp_user_id');
        $action = session('otp_action', 'register');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Session expired. Please try again.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $otp = $user->generateOtp($action);

        $mailSent = true;
        try {
            Mail::to($user->email)->send(new OtpMail($otp, ucfirst(str_replace('_', ' ', $action)), $user->name));
        } catch (\Exception $e) {
            $mailSent = false;
            Log::error('OTP Resend Email failed: ' . $e->getMessage());
        }

        if (!$mailSent && config('app.debug')) {
            return back()->with('info', "SMTP Notice: Check Gmail App Password in .env. Fresh OTP: {$otp}");
        }

        return back()->with('success', 'A fresh 6-digit OTP has been sent to your email!');
    }

    /**
     * Show Password Reset form after OTP verification
     */
    public function showResetPasswordForm(): View|RedirectResponse
    {
        $userId = session('password_reset_user_id');
        if (!$userId) {
            return redirect()->route('password.request')->with('error', 'Please request a password reset OTP first.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('password.request')->with('error', 'User not found.');
        }

        return view('auth.reset-password-otp', ['user' => $user]);
    }

    /**
     * Update user password after OTP verification
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $userId = session('password_reset_user_id');
        if (!$userId) {
            return redirect()->route('password.request')->with('error', 'Session expired. Please try again.');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('password.request')->with('error', 'User not found.');
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_action' => null,
        ])->save();

        session()->forget('password_reset_user_id');

        // Auto login
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Password reset successfully!');
    }
}
