<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'whatsapp_number',
        'delivery_address',
        'delivery_notes',
        'payment_method',
        'subtotal',
        'delivery_fee',
        'tax_amount',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'subtotal' => 'float',
        'delivery_fee' => 'float',
        'tax_amount' => 'float',
        'total_amount' => 'float',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match ($this->payment_method) {
            'qris' => 'QRIS Instant',
            'bank_transfer' => 'Bank Transfer (BCA / Mandiri)',
            'ewallet' => 'E-Wallet (GoPay / OVO / Dana)',
            'cod' => 'Cash on Delivery',
            default => ucfirst($this->payment_method),
        };
    }
}

