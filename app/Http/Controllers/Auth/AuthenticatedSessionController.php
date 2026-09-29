<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\OtpMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        if (Auth::check()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = auth()->user();

        // Check if user email is not yet verified, send OTP
        if (empty($user->email_verified_at)) {
            $otp = $user->generateOtp('register');

            $mailSent = true;
            try {
                Mail::to($user->email)->send(new OtpMail($otp, 'Account Verification', $user->name));
            } catch (\Exception $e) {
                $mailSent = false;
                Log::error('Login unverified OTP error: ' . $e->getMessage());
            }

            session([
                'otp_user_id' => $user->id,
                'otp_action' => 'register',
            ]);

            Auth::logout();

            if (!$mailSent && config('app.debug')) {
                return redirect()->route('otp.verify')->with('info', "SMTP Notice: Check Gmail App Password in .env. Test OTP: {$otp}");
            }

            return redirect()->route('otp.verify')->with('info', 'Please verify your email address to continue.');
        }

        $request->session()->regenerate();

        if ($user->is_admin == 1) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'Welcome back, ' . $user->name . '!');
    }

    /**
     * Send OTP for passwordless login
     */
    public function sendLoginOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $user = User::where('email', $request->email)->first();

        $otp = $user->generateOtp('login');

        $mailSent = true;
        try {
            Mail::to($user->email)->send(new OtpMail($otp, 'One-Click Login', $user->name));
        } catch (\Exception $e) {
            $mailSent = false;
            Log::error('Login OTP Email error: ' . $e->getMessage());
        }

        session([
            'otp_user_id' => $user->id,
            'otp_action' => 'login',
        ]);

        if (!$mailSent && config('app.debug')) {
            return redirect()->route('otp.verify')->with('info', "SMTP Notice: Check Gmail App Password in .env. Test OTP: {$otp}");
        }

        return redirect()->route('otp.verify')->with('success', 'A 6-digit login OTP has been sent to your email.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'You have been logged out securely.');
    }
}
