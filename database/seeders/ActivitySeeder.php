<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
use Carbon\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'type' => Activity::TYPE_ORDER_CREATED,
                'title' => 'Nouvelle commande reçue',
                'description' => 'Commande #ORD-2025-000001 de Ahmed Ben Ali - 1,250.00 DH',
                'icon_type' => Activity::ICON_BLUE,
                'created_at' => Carbon::now()->subMinutes(5),
                'updated_at' => Carbon::now()->subMinutes(5),
            ],
            [
                'type' => Activity::TYPE_PRODUCT_ADDED,
                'title' => 'Nouveau produit ajouté',
                'description' => 'Montre Élégante en Or - 2,500.00 DH',
                'icon_type' => Activity::ICON_GREEN,
                'created_at' => Carbon::now()->subMinutes(15),
                'updated_at' => Carbon::now()->subMinutes(15),
            ],
            [
                'type' => Activity::TYPE_ORDER_UPDATED,
                'title' => 'Statut de commande mis à jour',
                'description' => 'Commande #ORD-2025-000002 - Statut: Confirmée',
                'icon_type' => Activity::ICON_GREEN,
                'created_at' => Carbon::now()->subMinutes(25),
                'updated_at' => Carbon::now()->subMinutes(25),
            ],
            [
                'type' => Activity::TYPE_INVENTORY_UPDATED,
                'title' => 'Stock mis à jour',
                'description' => 'Bracelet en Argent réapprovisionné - Stock: 15',
                'icon_type' => Activity::ICON_PURPLE,
                'created_at' => Carbon::now()->subHour(),
                'updated_at' => Carbon::now()->subHour(),
            ],
            [
                'type' => Activity::TYPE_ORDER_CREATED,
                'title' => 'Nouvelle commande reçue',
                'description' => 'Commande #ORD-2025-000003 de Fatima Zahra - 800.00 DH',
                'icon_type' => Activity::ICON_BLUE,
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2),
            ],
            [
                'type' => Activity::TYPE_PRODUCT_UPDATED,
                'title' => 'Produit mis à jour',
                'description' => 'Collier en Diamant modifié',
                'icon_type' => Activity::ICON_PURPLE,
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(3),
            ],
        ];

        foreach ($activities as $activity) {
            Activity::create($activity);
        }
    }
}
