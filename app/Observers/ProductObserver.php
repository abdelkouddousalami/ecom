<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Activity;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        Activity::log(
            Activity::TYPE_PRODUCT_ADDED,
            'Nouveau produit ajouté',
            "{$product->name} - " . number_format($product->price, 2) . " DH",
            Activity::ICON_GREEN,
            $product,
            [
                'product_name' => $product->name,
                'price' => $product->price,
                'category' => $product->category->name ?? 'Non définie'
            ]
        );
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        // Log inventory updates specifically
        if ($product->isDirty('stock')) {
            $oldStock = $product->getOriginal('stock');
            $newStock = $product->stock;
            $change = $newStock - $oldStock;
            
            $iconType = $change > 0 ? Activity::ICON_GREEN : Activity::ICON_ORANGE;
            $action = $change > 0 ? 'réapprovisionné' : 'stock diminué';
            
            Activity::log(
                Activity::TYPE_INVENTORY_UPDATED,
                'Stock mis à jour',
                "{$product->name} {$action} - Stock: {$newStock}",
                $iconType,
                $product,
                [
                    'product_name' => $product->name,
                    'old_stock' => $oldStock,
                    'new_stock' => $newStock,
                    'change' => $change
                ]
            );
        }
        
        // Log general product updates (excluding stock changes to avoid duplicates)
        elseif ($product->isDirty(['name', 'price', 'description', 'category_id'])) {
            Activity::log(
                Activity::TYPE_PRODUCT_UPDATED,
                'Produit mis à jour',
                "{$product->name} modifié",
                Activity::ICON_PURPLE,
                $product,
                [
                    'product_name' => $product->name,
                    'price' => $product->price
                ]
            );
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        Activity::log(
            Activity::TYPE_PRODUCT_UPDATED,
            'Produit supprimé',
            "{$product->name} supprimé du catalogue",
            Activity::ICON_RED,
            null,
            [
                'product_name' => $product->name,
                'price' => $product->price
            ]
        );
    }
}
