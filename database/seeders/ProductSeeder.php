<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $braceletsCategory = Category::where('slug', 'bracelets')->first();
        $watchesCategory = Category::where('slug', 'watches')->first();
        $packsCategory = Category::where('slug', 'gift-packs')->first();
        $ringsCategory = Category::where('slug', 'rings')->first();

        $products = [
            [
                'name' => 'Diamond Bracelet',
                'description' => 'Elegant 18k gold bracelet with premium diamonds, perfect for special occasions and luxury events.',
                'price' => 8999.00,
                'original_price' => 11999.00,
                'category_id' => $braceletsCategory->id,
                'image' => 'placeholder-bracelet.jpg',
                'stock' => 15,
                'rating' => 4.8,
                'review_count' => 127,
                'is_featured' => true,
                'tags' => 'luxury,gold,jewelry,diamonds',
                'specifications' => "Material: 18k Gold\nDiamonds: Premium Cut\nWeight: 25g\nSize: Adjustable",
                'slug' => 'diamond-bracelet',
            ],
            [
                'name' => 'Luxury Watch',
                'description' => 'Swiss-made automatic watch with sapphire crystal and premium leather strap, crafted for perfection.',
                'price' => 12999.00,
                'original_price' => 16999.00,
                'category_id' => $watchesCategory->id,
                'image' => 'placeholder-watch.jpg',
                'stock' => 8,
                'rating' => 4.9,
                'review_count' => 89,
                'is_featured' => true,
                'tags' => 'swiss,automatic,luxury,watch',
                'specifications' => "Movement: Swiss Automatic\nCrystal: Sapphire\nWater Resistance: 100m\nStrap: Premium Leather",
                'slug' => 'luxury-watch',
            ],
            [
                'name' => 'Jewelry Gift Pack',
                'description' => 'Complete jewelry set including necklace, earrings, and bracelet in elegant gift box.',
                'price' => 5999.00,
                'original_price' => 7999.00,
                'category_id' => $packsCategory->id,
                'image' => 'placeholder-giftpack.jpg',
                'stock' => 25,
                'rating' => 4.7,
                'review_count' => 203,
                'is_featured' => false,
                'tags' => 'gift,set,collection,jewelry',
                'specifications' => "Includes: Necklace, Earrings, Bracelet\nMaterial: Sterling Silver\nBox: Premium Gift Box\nWarranty: 2 Years",
                'slug' => 'jewelry-gift-pack',
            ],
            [
                'name' => 'Gold Chain Bracelet',
                'description' => 'Classic gold chain bracelet with elegant links, perfect for everyday wear and special occasions.',
                'price' => 3299.00,
                'original_price' => 4299.00,
                'category_id' => $braceletsCategory->id,
                'image' => 'placeholder-chain.jpg',
                'stock' => 32,
                'rating' => 4.6,
                'review_count' => 78,
                'is_featured' => false,
                'tags' => 'gold,chain,bracelet,classic',
                'specifications' => "Material: 14k Gold\nWeight: 12g\nLength: Adjustable 16-18cm\nClasp: Secure Lobster",
                'slug' => 'gold-chain-bracelet',
            ],
            [
                'name' => 'Smart Watch Elite',
                'description' => 'Advanced smartwatch with health monitoring, GPS, and premium design for the modern lifestyle.',
                'price' => 2999.00,
                'original_price' => 3999.00,
                'category_id' => $watchesCategory->id,
                'image' => 'placeholder-smartwatch.jpg',
                'stock' => 45,
                'rating' => 4.5,
                'review_count' => 156,
                'is_featured' => false,
                'tags' => 'smart,watch,health,gps',
                'specifications' => "Display: AMOLED\nBattery: 7 Days\nWater Resistance: 50m\nFeatures: Heart Rate, GPS, Sleep Tracking",
                'slug' => 'smart-watch-elite',
            ],
            [
                'name' => 'Silver Charm Bracelet',
                'description' => 'Beautiful silver bracelet with customizable charms, great for gifting and personal style.',
                'price' => 1999.00,
                'original_price' => 2799.00,
                'category_id' => $braceletsCategory->id,
                'image' => 'placeholder-charm.jpg',
                'stock' => 18,
                'rating' => 4.4,
                'review_count' => 92,
                'is_featured' => false,
                'tags' => 'silver,charm,bracelet,customizable',
                'specifications' => "Material: Sterling Silver\nCharms: 5 Included\nLength: 18cm\nStyle: Classic European",
                'slug' => 'silver-charm-bracelet',
            ],
            [
                'name' => 'Wedding Ring Set',
                'description' => 'Elegant wedding ring set with matching bands, perfect for couples and special ceremonies.',
                'price' => 9999.00,
                'original_price' => 12999.00,
                'category_id' => $packsCategory->id,
                'image' => 'placeholder-rings.jpg',
                'stock' => 12,
                'rating' => 4.9,
                'review_count' => 234,
                'is_featured' => true,
                'tags' => 'wedding,rings,set,couples',
                'specifications' => "Material: 18k White Gold\nDiamonds: Conflict-Free\nSizes: Available in all sizes\nEngraving: Free",
                'slug' => 'wedding-ring-set',
            ],
            [
                'name' => 'Classic Dress Watch',
                'description' => 'Timeless dress watch with leather strap, perfect for formal occasions and business meetings.',
                'price' => 4999.00,
                'original_price' => 6499.00,
                'category_id' => $watchesCategory->id,
                'image' => 'placeholder-dress.jpg',
                'stock' => 22,
                'rating' => 4.7,
                'review_count' => 113,
                'is_featured' => false,
                'tags' => 'dress,watch,formal,classic',
                'specifications' => "Movement: Quartz\nCase: Stainless Steel\nStrap: Genuine Leather\nWater Resistance: 30m",
                'slug' => 'classic-dress-watch',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
