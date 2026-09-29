<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\QrCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OtpAuthenticationTest extends TestCase
{
    public function test_user_can_generate_and_verify_otp()
    {
        $user = User::factory()->create([
            'email' => 'azhar_test_' . time() . '@example.com',
            'email_verified_at' => null,
        ]);

        $otp = $user->generateOtp('register');

        $this->assertEquals(6, strlen($otp));
        $this->assertEquals($otp, $user->otp_code);
        $this->assertNotNull($user->otp_expires_at);

        // Test invalid OTP fails
        $this->assertFalse($user->verifyOtp('000000', 'register'));

        // Test valid OTP succeeds
        $this->assertTrue($user->verifyOtp($otp, 'register'));
        $this->assertNull($user->fresh()->otp_code);
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_qr_code_generation_includes_fixed_amount()
    {
        $easyPaisaQr = QrCodeService::generateEasyPaisaQrUrl(4500, 'ORD-TEST123');
        $this->assertEquals('easypaisa', $easyPaisaQr['type']);
        $this->assertEquals(4500, $easyPaisaQr['amount']);
        $this->assertStringContainsString('PKR', $easyPaisaQr['qr_image_url']);
        $this->assertStringContainsString('Fixed+Amount', $easyPaisaQr['qr_image_url']);

        $jazzCashQr = QrCodeService::generateJazzCashQrUrl(7200, 'ORD-TEST456');
        $this->assertEquals('jazzcash', $jazzCashQr['type']);
        $this->assertEquals(7200, $jazzCashQr['amount']);
        $this->assertStringContainsString('Fixed+Amount', $jazzCashQr['qr_image_url']);
    }

    public function test_registration_sends_otp_and_redirects_to_verify_screen()
    {
        Mail::fake();

        $email = 'newuser_' . time() . '@example.com';

        $response = $this->post('/register', [
            'name' => 'New Customer',
            'email' => $email,
            'phone' => '03009998877',
            'password' => 'SecurePass123!',
            'password_confirmation' => 'SecurePass123!',
        ]);

        $response->assertRedirect('/verify-otp');

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user);
        $this->assertNotNull($user->otp_code);

        Mail::assertSent(\App\Mail\OtpMail::class);

        // Now test verifying the OTP
        $verifyResponse = $this->withSession([
            'otp_user_id' => $user->id,
            'otp_action' => 'register',
        ])->post('/verify-otp', [
            'otp_code' => $user->otp_code,
        ]);

        $verifyResponse->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_password_reset_sends_otp_and_allows_reset()
    {
        Mail::fake();

        $user = User::factory()->create([
            'email' => 'resetuser_' . time() . '@example.com',
            'password' => bcrypt('OldPassword123!'),
        ]);

        $response = $this->post('/forgot-password', [
            'email' => $user->email,
        ]);

        $response->assertRedirect('/verify-otp');
        $user->refresh();
        $this->assertNotNull($user->otp_code);
        $this->assertEquals('password_reset', $user->otp_action);

        Mail::assertSent(\App\Mail\OtpMail::class);

        // Verify OTP
        $verifyResponse = $this->withSession([
            'otp_user_id' => $user->id,
            'otp_action' => 'password_reset',
        ])->post('/verify-otp', [
            'otp_code' => $user->otp_code,
        ]);

        $verifyResponse->assertRedirect('/reset-password-otp');

        // Submit new password
        $resetResponse = $this->withSession([
            'password_reset_user_id' => $user->id,
        ])->post('/reset-password-otp', [
            'password' => 'BrandNewPassword123!',
            'password_confirmation' => 'BrandNewPassword123!',
        ]);

        $resetResponse->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_passwordless_login_sends_otp()
    {
        Mail::fake();

        $user = User::factory()->create([
            'email' => 'loginuser_' . time() . '@example.com',
        ]);

        $response = $this->post('/login/otp', [
            'email' => $user->email,
        ]);

        $response->assertRedirect('/verify-otp');
        $user->refresh();
        $this->assertNotNull($user->otp_code);
        $this->assertEquals('login', $user->otp_action);

        Mail::assertSent(\App\Mail\OtpMail::class);
    }
}
