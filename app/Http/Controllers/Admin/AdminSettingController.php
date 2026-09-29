<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $val) {
            Setting::set($key, $val ?? '');
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Store & Payment settings updated successfully!');
    }

    public function mailTest()
    {
        return view('admin.settings.mail-test');
    }

    public function sendTestMail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'app_password' => ['nullable', 'string'],
        ]);

        $targetEmail = $request->email;
        $appPassword = $request->app_password ?: config('mail.mailers.smtp.password');

        if ($request->app_password) {
            config(['mail.mailers.smtp.password' => $request->app_password]);
            
            // Optionally update .env if user requested save
            if ($request->has('save_to_env')) {
                $envPath = base_path('.env');
                if (file_exists($envPath)) {
                    $envContent = file_get_contents($envPath);
                    $envContent = preg_replace(
                        "/MAIL_PASSWORD=.*/",
                        'MAIL_PASSWORD="' . trim($request->app_password) . '"',
                        $envContent
                    );
                    file_put_contents($envPath, $envContent);
                }
            }
        }

        try {
            \Illuminate\Support\Facades\Mail::to($targetEmail)
                ->send(new \App\Mail\OtpMail('888999', 'Live Inbox Test', 'Admin Tester'));

            return back()->with('success', "🎉 SUCCESS: Test verification email has been delivered directly to {$targetEmail}! Check your Gmail Inbox.");
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Admin Mail Test Error: ' . $e->getMessage());
            
            $errorMessage = $e->getMessage();
            if (str_contains($errorMessage, '535') || str_contains($errorMessage, 'BadCredentials')) {
                $userFriendly = "Google SMTP Error (535 BadCredentials): Google rejected the App Password. Please generate a fresh 16-character App Password at https://myaccount.google.com/apppasswords and paste it here.";
            } else {
                $userFriendly = "SMTP Connection Error: " . $errorMessage;
            }

            return back()->with('error', $userFriendly)->withInput();
        }
    }
}
