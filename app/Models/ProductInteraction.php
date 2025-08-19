<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProductInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'user_session',
        'user_id',
        'ip_address',
        'user_agent',
        'additional_data'
    ];

    protected $casts = [
        'additional_data' => 'array'
    ];

    // Interaction types
    const TYPE_CART_ADD = 'cart_add';
    const TYPE_WISHLIST_ADD = 'wishlist_add';
    const TYPE_VIEW = 'view';

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeCartAdditions($query)
    {
        return $query->where('type', self::TYPE_CART_ADD);
    }

    public function scopeWishlistAdditions($query)
    {
        return $query->where('type', self::TYPE_WISHLIST_ADD);
    }

    public function scopeViews($query)
    {
        return $query->where('type', self::TYPE_VIEW);
    }

    public function scopeForProduct($query, $productId)
    {
        return $query->where('product_id', $productId);
    }

    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeLastDays($query, $days = 30)
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays($days));
    }

    // Static methods for quick tracking
    public static function track($productId, $type, $additionalData = [])
    {
        return self::create([
            'product_id' => $productId,
            'type' => $type,
            'user_session' => session()->getId(),
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'additional_data' => $additionalData
        ]);
    }

    public static function trackCartAddition($productId, $quantity = 1)
    {
        return self::track($productId, self::TYPE_CART_ADD, ['quantity' => $quantity]);
    }

    public static function trackWishlistAddition($productId)
    {
        return self::track($productId, self::TYPE_WISHLIST_ADD);
    }

    public static function trackView($productId)
    {
        return self::track($productId, self::TYPE_VIEW);
    }
}
