<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bracelets',
                'description' => 'Beautiful bracelets for all occasions - elegant, casual, and luxury designs',
                'slug' => 'bracelets',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Watches',
                'description' => 'Premium watches and timepieces - luxury, smart, and classic designs',
                'slug' => 'watches',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Gift Packs',
                'description' => 'Curated gift sets and collections - perfect for special occasions',
                'slug' => 'gift-packs',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Rings',
                'description' => 'Elegant rings and wedding bands - diamonds, gold, and precious stones',
                'slug' => 'rings',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Necklaces',
                'description' => 'Beautiful necklaces and pendants - gold, silver, and precious gems',
                'slug' => 'necklaces',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
