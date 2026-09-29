<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Verification Code - {{ config('app.name', 'BazaarPK') }}</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #030712;
            color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .preheader {
            display: none !important;
            visibility: hidden;
            mso-hide: all;
            font-size: 1px;
            line-height: 1px;
            max-height: 0px;
            max-width: 0px;
            opacity: 0;
            overflow: hidden;
        }
        .wrapper {
            width: 100%;
            background-color: #030712;
            padding: 30px 12px;
            box-sizing: border-box;
        }
        .container {
            max-width: 520px;
            margin: 0 auto;
            background: linear-gradient(165deg, #111827 0%, #0f172a 100%);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(249, 115, 22, 0.35);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8), 0 0 30px rgba(249, 115, 22, 0.15);
        }
        .header {
            background: linear-gradient(135deg, #ea580c 0%, #f97316 50%, #f59e0b 100%);
            padding: 32px 24px;
            text-align: center;
        }
        .logo-title {
            color: #ffffff;
            font-size: 26px;
            font-weight: 900;
            letter-spacing: 1.5px;
            margin: 0;
            text-transform: uppercase;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .logo-subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 12px;
            margin-top: 6px;
            letter-spacing: 1px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .content {
            padding: 32px 26px;
        }
        .greeting {
            font-size: 18px;
            color: #ffffff;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 12px;
        }
        .text {
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 20px;
        }
        .otp-card {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 2px dashed #f97316;
            border-radius: 20px;
            padding: 24px 16px;
            text-align: center;
            margin: 24px 0;
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.4);
        }
        .otp-label {
            color: #fdba74;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .otp-code {
            font-size: 40px;
            font-weight: 900;
            letter-spacing: 8px;
            color: #ffffff;
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            text-shadow: 0 0 25px rgba(249, 115, 22, 0.6);
            margin: 8px 0;
        }
        .otp-expiry {
            font-size: 12px;
            color: #fb7185;
            font-weight: 700;
            margin-top: 8px;
            display: inline-block;
            background: rgba(244, 63, 94, 0.12);
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid rgba(244, 63, 94, 0.25);
        }
        .security-notice {
            background: rgba(15, 23, 42, 0.8);
            border-left: 4px solid #f97316;
            padding: 14px 16px;
            border-radius: 12px;
            margin-top: 22px;
        }
        .security-text {
            color: #d1d5db;
            font-size: 12px;
            margin: 0;
            line-height: 1.55;
        }
        .footer {
            background: #090d16;
            padding: 22px 24px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.06);
        }
        .footer-text {
            color: #6b7280;
            font-size: 11px;
            margin: 0;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- Gmail Inbox Preview Preheader -->
    <span class="preheader">Your verification code is {{ $otp }}. Use this 6-digit code to verify your {{ config('app.name', 'BazaarPK') }} account.</span>

    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1 class="logo-title">🛍️ {{ config('app.name', 'BazaarPK') }}</h1>
                <div class="logo-subtitle">Official Verification Service</div>
            </div>
            
            <div class="content">
                <h2 class="greeting">Hello {{ $userName }},</h2>
                <p class="text">
                    You have requested a security authorization code for <strong>{{ $purpose }}</strong> on <strong>{{ config('app.name', 'BazaarPK') }}</strong>. Please use the one-time verification password below:
                </p>

                <div class="otp-card">
                    <div class="otp-label">6-Digit Verification Code</div>
                    <div class="otp-code">{{ $otp }}</div>
                    <div class="otp-expiry">⏳ Enter this code on the verification screen</div>
                </div>

                <p class="text">
                    Enter this 6-digit code on the verification screen to securely authenticate and access your account.
                </p>

                <div class="security-notice">
                    <p class="security-text">
                        <strong>🛡️ Security Notice:</strong> Never share this verification code with anyone. Our team will never ask for your password or OTP. If you did not make this request, you can safely disregard this email.
                    </p>
                </div>
            </div>

            <div class="footer">
                <p class="footer-text">
                    &copy; {{ date('Y') }} {{ config('app.name', 'BazaarPK') }}. All rights reserved.<br>
                    Automated security notification &bull; Do not reply directly.
                </p>
            </div>
        </div>
    </div>
</body>
</html>
