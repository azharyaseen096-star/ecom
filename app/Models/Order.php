<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'postal_code',
        'province',
        'delivery_notes',
        'latitude',
        'longitude',
        'products',
        'subtotal',
        'shipping_fee',
        'discount',
        'total',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_proof_image',
        'sender_account_number',
        'admin_notes',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'integer',
        'shipping_fee' => 'integer',
        'discount' => 'integer',
        'total' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . strtoupper(uniqid());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentMethodLabelAttribute()
    {
        return match ($this->payment_method) {
            'jazzcash' => 'JazzCash Mobile Account / Transfer',
            'easypaisa' => 'EasyPaisa Mobile Account / Transfer',
            'bank_transfer' => 'Direct Bank Transfer',
            'cod' => 'Cash on Delivery (COD)',
            default => strtoupper($this->payment_method ?? 'COD'),
        };
    }

    public function getGoogleMapsUrlAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
        }
        return null;
    }
}