<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'avatar',
        'password',
        'is_admin',
        'otp_code',
        'otp_expires_at',
        'otp_action',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Generate and store a new 6-digit OTP
     */
    public function generateOtp(string $action = 'verify'): string
    {
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->forceFill([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
            'otp_action' => $action,
        ])->save();

        return $otp;
    }

    /**
     * Validate an incoming OTP
     */
    public function verifyOtp(string $otp, string $action = 'verify'): bool
    {
        if (empty($this->otp_code) || empty($this->otp_expires_at)) {
            return false;
        }

        if ($this->otp_code !== trim($otp)) {
            return false;
        }

        if (now()->isAfter($this->otp_expires_at)) {
            return false;
        }

        if ($this->otp_action && $this->otp_action !== $action) {
            return false;
        }

        // Clear OTP upon successful validation
        $this->forceFill([
            'otp_code' => null,
            'otp_expires_at' => null,
            'otp_action' => null,
            'email_verified_at' => $this->email_verified_at ?? now(),
        ])->save();

        return true;
    }

    // User Orders
    public function orders()
    {
        return $this->hasMany(Order::class)->latest();
    }
}