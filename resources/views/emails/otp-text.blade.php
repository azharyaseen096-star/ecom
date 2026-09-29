Hello {{ $userName }},

Your one-time verification code for {{ $purpose }} on {{ config('app.name', 'BazaarPK') }} is:

====================
{{ $otp }}
====================

Please enter this 6-digit code on the verification screen to authenticate your account.

Security Note:
This code is valid for your current verification session. Never share this code with anyone.

Regards,
{{ config('app.name', 'BazaarPK') }} Team
