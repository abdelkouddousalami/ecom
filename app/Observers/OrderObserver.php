<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Activity;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        Activity::log(
            Activity::TYPE_ORDER_CREATED,
            'Nouvelle commande reçue',
            "Commande #{$order->order_number} de {$order->first_name} {$order->last_name} - " . number_format($order->total, 2) . " DH",
            Activity::ICON_BLUE,
            $order,
            [
                'order_number' => $order->order_number,
                'customer_name' => $order->first_name . ' ' . $order->last_name,
                'total' => $order->total
            ]
        );
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        // Only log if status was changed
        if ($order->isDirty('status')) {
            $iconType = match($order->status) {
                Order::STATUS_CONFIRMED => Activity::ICON_GREEN,
                Order::STATUS_PROCESSING => Activity::ICON_PURPLE,
                Order::STATUS_SHIPPED => Activity::ICON_BLUE,
                Order::STATUS_DELIVERED => Activity::ICON_GREEN,
                Order::STATUS_CANCELLED => Activity::ICON_RED,
                default => Activity::ICON_BLUE
            };

            Activity::log(
                Activity::TYPE_ORDER_UPDATED,
                'Statut de commande mis à jour',
                "Commande #{$order->order_number} - Statut: {$order->getStatusLabel()}",
                $iconType,
                $order,
                [
                    'order_number' => $order->order_number,
                    'old_status' => $order->getOriginal('status'),
                    'new_status' => $order->status,
                    'status_label' => $order->getStatusLabel()
                ]
            );
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        Activity::log(
            Activity::TYPE_ORDER_UPDATED,
            'Commande supprimée',
            "Commande #{$order->order_number} supprimée",
            Activity::ICON_RED,
            null,
            [
                'order_number' => $order->order_number,
                'customer_name' => $order->first_name . ' ' . $order->last_name
            ]
        );
    }
}
