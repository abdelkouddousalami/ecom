<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductInteraction;
use App\Services\SeoService;

class ProductController extends Controller
{
    public function welcome()
    {
        try {
            // Get featured products for the home page
            $products = Product::with(['category', 'images'])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->take(6)
                ->get();
            
            // If no featured products, get random products
            if ($products->isEmpty()) {
                $products = Product::with(['category', 'images'])
                    ->where('is_active', true)
                    ->inRandomOrder()
                    ->take(6)
                    ->get();
            }
            
            // Get categories for the Shop by Category section
            $categories = Category::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->orderBy('name', 'asc')
                ->take(3) // Limit to 3 categories for the home page
                ->get();
            
            // Generate SEO meta for homepage
            $seoMeta = [
                'title' => 'L3OCHAQ - Meilleurs Cadeaux Couples & Bijoux | www.l3ochaq.ma',
                'description' => 'L3OCHAQ - Le meilleur magasin marocain pour cadeaux couples et bijoux. Découvrez nos collections uniques parfaites pour couples. Livraison gratuite au Maroc.',
                'keywords' => 'L3OCHAQ, cadeaux couples, bijoux Maroc, meilleurs cadeaux, bracelets couples, montres assorties, cadeau saint valentin, l3ochaq.ma, livraison gratuite',
                'canonical' => url('/'),
                'ogImage' => asset('images/l3ochaq-homepage.jpg')
            ];
            
            return view('welcome', compact('products', 'categories', 'seoMeta'));
        } catch (\Exception $e) {
            Log::error('Welcome page error: ' . $e->getMessage());
            
            // Return with empty collections to prevent 500 error
            $products = collect();
            $categories = collect();
            $seoMeta = [
                'title' => 'L3OCHAQ - Meilleurs Cadeaux Couples & Bijoux',
                'description' => 'L3OCHAQ - Le meilleur magasin marocain pour cadeaux couples et bijoux.',
                'keywords' => 'L3OCHAQ, cadeaux couples, bijoux Maroc',
                'canonical' => url('/'),
                'ogImage' => asset('images/default.jpg')
            ];
            
            return view('welcome', compact('products', 'categories', 'seoMeta'))
                ->with('error', 'Some content could not be loaded.');
        }
    }
    
    public function index(Request $request)
    {
        $seoService = new SeoService();
        
        $query = Product::with(['category', 'images'])->where('is_active', true);
        
        $currentCategory = null;
        
        // Apply filters if provided
        if ($request->has('category') && $request->category) {
            $currentCategory = Category::where('slug', $request->category)->first();
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        if ($request->has('sort') && $request->sort) {
            switch ($request->sort) {
                case 'price-low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'popular':
                    $query->orderBy('rating', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // Paginate with 6 products per page
        $products = $query->paginate(6);
        $categories = Category::where('is_active', true)->get();
        
        // Get all products for JavaScript functionality (cart, wishlist)
        $allProducts = Product::select('id', 'name', 'price', 'image', 'slug')
            ->where('is_active', true)
            ->get();
        
        // Generate SEO meta for products page
        $seoMeta = $seoService->generateCategoryMeta($currentCategory);
        
        return view('products', compact('products', 'categories', 'allProducts', 'seoMeta'));
    }

    public function show($slug)
    {
        try {
            // Handle invalid slugs gracefully for social media bots
            $product = Product::where('slug', $slug)->where('is_active', true)->first();
            
            if (!$product) {
                // If the slug looks like an image file, redirect to products page
                if (preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $slug)) {
                    return redirect()->route('products')->with('error', 'Product not found');
                }
                
                // For other invalid slugs, throw 404
                abort(404);
            }
            
            $seoService = new SeoService();
            
            // Load product with all relationships
            $product->load(['category', 'images']);
            
            // Track product view (only if not a bot)
            $userAgent = request()->header('User-Agent', '');
            $isBotRequest = $this->isBotRequest($userAgent);
            
            if (!$isBotRequest) {
                ProductInteraction::trackView($product->id);
            }
            
            // Get related products from the same category
            $relatedProducts = Product::with(['category', 'images'])
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('is_active', true)
                ->limit(4)
                ->get();
            
            // Get all products for cart modal functionality
            $allProducts = Product::select('id', 'name', 'price', 'image', 'slug')
                ->where('is_active', true)
                ->get();
            
            // Generate SEO meta for product with Instagram optimization
            $seoMeta = $seoService->generateProductMeta($product);
            
            // Add Instagram-specific meta tags
            $seoMeta['og:type'] = 'product';
            $seoMeta['og:price:amount'] = $product->price;
            $seoMeta['og:price:currency'] = 'MAD';
            $seoMeta['product:brand'] = 'l3ochaq';
            $seoMeta['product:availability'] = $product->stock > 0 ? 'in stock' : 'out of stock';
            $seoMeta['product:condition'] = 'new';
            $seoMeta['product:retailer_item_id'] = $product->id;
            
            // Generate breadcrumbs
            $breadcrumbs = $seoService->getProductBreadcrumbs($product);
            $breadcrumbData = $seoService->generateBreadcrumbStructuredData($breadcrumbs);
            
            return view('product-detail', compact('product', 'relatedProducts', 'allProducts', 'seoMeta', 'breadcrumbs', 'breadcrumbData'));
            
        } catch (\Exception $e) {
            Log::error('Product show error: ' . $e->getMessage() . ' - Slug: ' . $slug);
            
            // If there's any error, redirect to products page instead of showing 500
            return redirect()->route('products')->with('error', 'Product could not be loaded');
        }
    }
    
    /**
     * Check if the request is from a bot/crawler
     */
    private function isBotRequest($userAgent)
    {
        $bots = [
            'facebookexternalhit', 'Facebot', 'Twitterbot', 'LinkedInBot',
            'WhatsApp', 'TelegramBot', 'SkypeUriPreview', 'SlackBot',
            'Instagram', 'Googlebot', 'Bingbot', 'YandexBot'
        ];
        
        foreach ($bots as $bot) {
            if (stripos($userAgent, $bot) !== false) {
                return true;
            }
        }
        
        return false;
    }
    
    public function cart()
    {
        // Get all products for cart page (needed for localStorage functionality)
        $products = Product::select('id', 'name', 'price', 'image', 'slug')
            ->where('is_active', true)
            ->get();
        
        return view('cart', compact('products'));
    }
    
    public function checkout()
    {
        // Get all products for checkout page (needed for localStorage functionality)
        $products = Product::select('id', 'name', 'price', 'image', 'slug')
            ->where('is_active', true)
            ->get();
        
        return view('checkout', compact('products'));
    }
    
    public function buyNowCheckout($id, Request $request)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
        
        // Get the quantity from the request, default to 1
        $quantity = $request->get('quantity', 1);
        
        // Get the custom name from the request
        $customName = $request->get('custom_name', '');
        
        // Ensure quantity is at least 1 and not more than available stock
        $quantity = max(1, min($quantity, $product->stock));
        
        // Create a single item for direct checkout
        $directItem = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => $quantity,
            'total' => $product->price * $quantity,
            'custom_name' => $customName,
            'is_customizable' => $product->is_customizable
        ];
        
        // Get all products for general functionality
        $products = Product::select('id', 'name', 'price', 'image', 'slug')
            ->where('is_active', true)
            ->get();
        
        return view('checkout', compact('products', 'directItem'));
    }
    
    public function wishlist()
    {
        // Get all products for wishlist page (needed for localStorage functionality)
        $products = Product::select('id', 'name', 'price', 'image', 'slug', 'description')
            ->where('is_active', true)
            ->get();
        
        return view('wishlist', compact('products'));
    }
    
    public function categoryRedirect($category)
    {
        // Redirect to products page with category filter
        return redirect()->route('products', ['category' => $category]);
    }
}
