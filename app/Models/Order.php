<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'order_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'postal_code',
        'payment_method',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . date('Y') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
                $order->save();
            }
        });
    }

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';

    // Payment method constants
    const PAYMENT_COD = 'cod';
    const PAYMENT_BANK = 'bank';
    const PAYMENT_CARD = 'card';

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class)->nullable();
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', self::STATUS_CONFIRMED);
    }

    // Helper methods
    public function generateOrderNumber()
    {
        if (empty($this->order_number)) {
            $this->order_number = 'ORD-' . date('Y') . '-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
            $this->save();
        }
        return $this->order_number;
    }

    public function getPaymentMethodLabel()
    {
        return match($this->payment_method) {
            self::PAYMENT_COD => 'Paiement à la livraison',
            self::PAYMENT_BANK => 'Virement bancaire',
            self::PAYMENT_CARD => 'Carte bancaire',
            default => 'Non défini'
        };
    }

    public function getStatusLabel()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'En attente',
            self::STATUS_CONFIRMED => 'Confirmée',
            self::STATUS_PROCESSING => 'En préparation',
            self::STATUS_SHIPPED => 'Expédiée',
            self::STATUS_DELIVERED => 'Livrée',
            self::STATUS_CANCELLED => 'Annulée',
            default => 'Non défini'
        };
    }
}
