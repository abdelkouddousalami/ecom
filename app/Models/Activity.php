<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'icon_type',
        'related_id',
        'related_type',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    // Activity types
    const TYPE_ORDER_CREATED = 'order_created';
    const TYPE_ORDER_UPDATED = 'order_updated';
    const TYPE_PRODUCT_ADDED = 'product_added';
    const TYPE_PRODUCT_UPDATED = 'product_updated';
    const TYPE_INVENTORY_UPDATED = 'inventory_updated';
    const TYPE_USER_REGISTERED = 'user_registered';

    // Icon types for UI
    const ICON_BLUE = 'blue';
    const ICON_GREEN = 'green';
    const ICON_PURPLE = 'purple';
    const ICON_ORANGE = 'orange';
    const ICON_RED = 'red';

    /**
     * Get the related model
     */
    public function related()
    {
        return $this->morphTo();
    }

    /**
     * Create a new activity log entry
     */
    public static function log($type, $title, $description, $iconType = self::ICON_BLUE, $relatedModel = null, $metadata = [])
    {
        return self::create([
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'icon_type' => $iconType,
            'related_id' => $relatedModel ? $relatedModel->id : null,
            'related_type' => $relatedModel ? get_class($relatedModel) : null,
            'metadata' => $metadata
        ]);
    }

    /**
     * Scope to get recent activities
     */
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Scope to get activities by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get human readable time ago
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
