<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;

class NewProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing products and their images (handle foreign key constraints)
        ProductImage::query()->delete();
        
        // Clear cart items that reference products
        DB::table('carts')->delete();
        DB::table('wishlists')->delete();
        DB::table('order_items')->delete();
        
        // Now we can safely delete products
        Product::query()->delete();

        // Get categories
        $categories = Category::all();
        if ($categories->isEmpty()) {
            // Create some basic categories if they don't exist
            $categories = collect([
                Category::create(['name' => 'Bracelets', 'slug' => 'bracelets', 'description' => 'Beautiful handcrafted bracelets']),
                Category::create(['name' => 'Watches', 'slug' => 'watches', 'description' => 'Elegant timepieces']),
                Category::create(['name' => 'Gift Packs', 'slug' => 'gift-packs', 'description' => 'Perfect gift combinations']),
            ]);
        }

        // Product data with luxury jewelry names and descriptions
        $products = [
            [
                'name' => 'Elegant Gold Bracelet',
                'description' => 'A stunning 18k gold bracelet with intricate detailing, perfect for special occasions. Handcrafted with precision and designed to last a lifetime.',
                'price' => 2500,
                'stock' => 15,
                'category' => 'Bracelets',
                'rating' => 4.8
            ],
            [
                'name' => 'Diamond Tennis Bracelet',
                'description' => 'Luxurious diamond tennis bracelet featuring brilliant cut diamonds set in white gold. A timeless piece that adds sparkle to any outfit.',
                'price' => 4200,
                'stock' => 8,
                'category' => 'Bracelets',
                'rating' => 4.9
            ],
            [
                'name' => 'Silver Chain Watch',
                'description' => 'Classic silver chain watch with Roman numerals and precision Swiss movement. Combines traditional craftsmanship with modern reliability.',
                'price' => 1800,
                'stock' => 12,
                'category' => 'Watches',
                'rating' => 4.6
            ],
            [
                'name' => 'Rose Gold Charm Bracelet',
                'description' => 'Delicate rose gold charm bracelet with personalized charms. Each charm tells a story, making this piece truly unique and meaningful.',
                'price' => 1200,
                'stock' => 20,
                'category' => 'Bracelets',
                'rating' => 4.7
            ],
            [
                'name' => 'Luxury Gift Set Premium',
                'description' => 'Exquisite gift set containing matching bracelet and earrings in premium packaging. Perfect for anniversaries and special celebrations.',
                'price' => 3500,
                'stock' => 6,
                'category' => 'Gift Packs',
                'rating' => 4.9
            ],
            [
                'name' => 'Vintage Pearl Bracelet',
                'description' => 'Elegant vintage-inspired pearl bracelet with Swarovski crystals. A sophisticated piece that complements both casual and formal attire.',
                'price' => 950,
                'stock' => 18,
                'category' => 'Bracelets',
                'rating' => 4.5
            ],
            [
                'name' => 'Sports Chronograph Watch',
                'description' => 'Professional sports chronograph with titanium case and sapphire crystal. Water-resistant and built for active lifestyles.',
                'price' => 2800,
                'stock' => 10,
                'category' => 'Watches',
                'rating' => 4.8
            ],
            [
                'name' => 'Crystal Infinity Bracelet',
                'description' => 'Modern crystal bracelet featuring infinity symbol design. Represents eternal love and friendship with sparkling crystal accents.',
                'price' => 680,
                'stock' => 25,
                'category' => 'Bracelets',
                'rating' => 4.4
            ],
            [
                'name' => 'Platinum Wedding Set',
                'description' => 'Exclusive platinum wedding set with matching rings and bracelet. Designed for couples who appreciate the finest in luxury jewelry.',
                'price' => 5200,
                'stock' => 4,
                'category' => 'Gift Packs',
                'rating' => 5.0
            ],
            [
                'name' => 'Smart Luxury Watch',
                'description' => 'High-end smartwatch with premium materials and advanced features. Combines cutting-edge technology with elegant design.',
                'price' => 3200,
                'stock' => 14,
                'category' => 'Watches',
                'rating' => 4.7
            ],
            [
                'name' => 'Emerald Statement Bracelet',
                'description' => 'Bold statement bracelet featuring genuine emeralds set in 14k gold. A showstopping piece for those who love to make an impression.',
                'price' => 3800,
                'stock' => 7,
                'category' => 'Bracelets',
                'rating' => 4.8
            ],
            [
                'name' => 'Classic Leather Watch',
                'description' => 'Timeless leather strap watch with automatic movement and exhibition caseback. Perfect blend of traditional watchmaking and modern style.',
                'price' => 1500,
                'stock' => 16,
                'category' => 'Watches',
                'rating' => 4.6
            ],
            [
                'name' => 'Anniversary Gift Collection',
                'description' => 'Special anniversary collection featuring coordinated jewelry pieces in elegant presentation box. Celebrates milestone moments beautifully.',
                'price' => 2900,
                'stock' => 9,
                'category' => 'Gift Packs',
                'rating' => 4.8
            ],
            [
                'name' => 'Sapphire Tennis Bracelet',
                'description' => 'Exquisite sapphire tennis bracelet with alternating diamonds. Deep blue sapphires create a stunning contrast with brilliant diamonds.',
                'price' => 4600,
                'stock' => 5,
                'category' => 'Bracelets',
                'rating' => 4.9
            ],
            [
                'name' => 'Minimalist Gold Watch',
                'description' => 'Ultra-thin minimalist watch with 18k gold case and leather strap. Clean design that speaks to contemporary sophistication.',
                'price' => 2200,
                'stock' => 13,
                'category' => 'Watches',
                'rating' => 4.7
            ],
            [
                'name' => 'Luxury Charm Collection',
                'description' => 'Complete charm collection with interchangeable charms and premium chain. Build your own story with this versatile jewelry system.',
                'price' => 1800,
                'stock' => 11,
                'category' => 'Gift Packs',
                'rating' => 4.6
            ],
            [
                'name' => 'Ruby Heritage Bracelet',
                'description' => 'Heritage-inspired ruby bracelet passed down through generations. Features antique setting techniques with modern craftsmanship.',
                'price' => 4100,
                'stock' => 6,
                'category' => 'Bracelets',
                'rating' => 4.8
            ],
            [
                'name' => 'Diamond Luxury Watch',
                'description' => 'Ultimate luxury watch with diamond-set bezel and mother-of-pearl dial. The pinnacle of horological excellence and jewelry artistry.',
                'price' => 8500,
                'stock' => 3,
                'category' => 'Watches',
                'rating' => 5.0
            ]
        ];

        // Create products
        foreach ($products as $index => $productData) {
            $category = $categories->where('name', $productData['category'])->first();
            
            // Add product image using the corresponding image file
            $imageNumber = $index + 1;
            $imagePath = "images/products/img/detaille{$imageNumber}.jpg";
            
            $product = Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'category_id' => $category->id,
                'rating' => $productData['rating'],
                'is_active' => true,
                'is_featured' => rand(0, 1),
                'image' => $imagePath,
            ]);

            // Also add to product_images table for gallery
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
                'is_primary' => true,
                'sort_order' => 1
            ]);
        }

        $this->command->info('Successfully created 18 new products with images!');
    }
}
