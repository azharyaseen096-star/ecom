<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Generate 6-digit OTP
        $otp = $user->generateOtp('register');

        // Send OTP Email
        $mailSent = true;
        try {
            Mail::to($user->email)->send(new OtpMail($otp, 'New Account Verification', $user->name));
        } catch (\Exception $e) {
            $mailSent = false;
            Log::error('Registration OTP Email error: ' . $e->getMessage());
        }

        // Store user ID in session for OTP verification
        session([
            'otp_user_id' => $user->id,
            'otp_action' => 'register',
        ]);

        if (!$mailSent && config('app.debug')) {
            return redirect()->route('otp.verify')->with('info', "SMTP Authentication Notice: Please update Gmail App Password in .env. Test OTP: {$otp}");
        }

        return redirect()->route('otp.verify')->with('success', 'Registration successful! A 6-digit verification code has been sent to your email.');
    }
}
