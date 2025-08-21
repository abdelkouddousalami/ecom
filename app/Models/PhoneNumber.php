<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'source',
        'notes',
        'is_active',
        'collected_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'collected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getFormattedPhoneAttribute()
    {
        // Format phone number for display
        return preg_replace('/(\d{3})(\d{2})(\d{2})(\d{2})(\d{2})/', '+212 $1 $2 $3 $4 $5', $this->phone);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySource($query, $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Collect phone numbers from all existing orders
     */
    public static function collectFromOrders()
    {
        $orders = \App\Models\Order::whereNotNull('phone')
            ->where('phone', '!=', '')
            ->get();

        $collected = 0;
        foreach ($orders as $order) {
            // Skip if phone number already exists
            if (self::where('phone', $order->phone)->exists()) {
                continue;
            }

            // Create name - handle missing names gracefully
            $name = trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''));
            if (empty($name)) {
                $name = 'Customer #' . $order->id;
            }

            // Create address
            $address = trim(($order->address ?? '') . ' ' . ($order->city ?? ''));
            if (empty($address)) {
                $address = 'No address provided';
            }

            // Create phone number record
            self::create([
                'name' => $name,
                'phone' => $order->phone,
                'address' => $address,
                'source' => 'order',
                'notes' => "Collected from order " . ($order->order_number ?? "#" . $order->id),
                'collected_at' => $order->created_at,
                'is_active' => true,
            ]);
            
            $collected++;
        }

        return $collected;
    }

    /**
     * Collect phone number from a specific order
     */
    public static function collectFromOrder($order)
    {
        // Skip if phone number already exists or phone is empty
        if (self::where('phone', $order->phone)->exists() || empty($order->phone)) {
            return false;
        }

        // Create name - handle missing names gracefully
        $name = trim(($order->first_name ?? '') . ' ' . ($order->last_name ?? ''));
        if (empty($name)) {
            $name = 'Customer #' . $order->id;
        }

        // Create address
        $address = trim(($order->address ?? '') . ' ' . ($order->city ?? ''));
        if (empty($address)) {
            $address = 'No address provided';
        }

        return self::create([
            'name' => $name,
            'phone' => $order->phone,
            'address' => $address,
            'source' => 'order',
            'notes' => "Collected from order " . ($order->order_number ?? "#" . $order->id),
            'collected_at' => now(),
            'is_active' => true,
        ]);
    }
}
