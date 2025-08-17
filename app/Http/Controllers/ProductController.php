<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function welcome()
    {
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
        
        return view('welcome', compact('products'));
    }
    
    public function index()
    {
        $products = Product::with(['category', 'images'])->where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        
        return view('products', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        // Load product with all relationships
        $product->load(['category', 'images']);
        
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
        
        return view('product-detail', compact('product', 'relatedProducts', 'allProducts'));
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
    
    public function wishlist()
    {
        // Get all products for wishlist page (needed for localStorage functionality)
        $products = Product::select('id', 'name', 'price', 'image', 'slug', 'description')
            ->where('is_active', true)
            ->get();
        
        return view('wishlist', compact('products'));
    }
}
