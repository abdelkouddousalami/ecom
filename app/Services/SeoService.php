<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SeoService
{
    /**
     * Generate SEO meta tags for products
     */
    public function generateProductMeta($product)
    {
        $title = $this->generateProductTitle($product);
        $description = $this->generateProductDescription($product);
        $keywords = $this->generateProductKeywords($product);
        
        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'og_title' => $title,
            'og_description' => $description,
            'og_image' => $this->getProductImage($product),
            'canonical' => route('product.show', $product->slug),
            'structured_data' => $this->generateProductStructuredData($product)
        ];
    }

    /**
     * Generate SEO meta tags for categories
     */
    public function generateCategoryMeta($category = null)
    {
        if ($category) {
            $title = "Bijoux {$category->name} - Collection Exclusive | L3OCHAQ";
            $description = "Découvrez notre collection exclusive de {$category->name} chez L3OCHAQ. Les meilleurs cadeaux pour couples et bijoux de qualité supérieure au Maroc. Livraison gratuite.";
            $keywords = "{$category->name}, bijoux, cadeaux couples, L3OCHAQ, Maroc, livraison gratuite";
        } else {
            $title = "L3OCHAQ - Meilleurs Cadeaux Couples & Bijoux | www.l3ochaq.ma";
            $description = "L3OCHAQ - Le meilleur magasin marocain pour cadeaux couples et bijoux. Découvrez nos collections uniques de bracelets, montres et accessoires. Livraison gratuite au Maroc.";
            $keywords = "L3OCHAQ, cadeaux couples, bijoux Maroc, meilleurs cadeaux, bracelets couples, montres, accessoires, livraison gratuite, l3ochaq.ma";
        }

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'og_title' => $title,
            'og_description' => $description,
            'canonical' => $category ? route('products', ['category' => $category->slug]) : route('products')
        ];
    }

    /**
     * Generate product title for SEO
     */
    private function generateProductTitle($product)
    {
        $categoryName = $product->category ? $product->category->name : 'Cadeaux';
        return "{$product->name} - {$categoryName} Couples | L3OCHAQ Store";
    }

    /**
     * Generate product description
     */
    private function generateProductDescription($product)
    {
        $baseDescription = substr($product->description, 0, 120);
        $categoryName = $product->category ? $product->category->name : 'cadeaux';
        
        return "{$baseDescription} ✨ {$categoryName} parfait pour couples chez L3OCHAQ. Meilleurs cadeaux au Maroc. Prix: {$product->price} DH. Livraison gratuite.";
    }

    /**
     * Generate product keywords
     */
    private function generateProductKeywords($product)
    {
        $keywords = [
            $product->name,
            'L3OCHAQ',
            'cadeaux couples',
            'bijoux Maroc',
            'meilleurs cadeaux',
            'livraison gratuite',
            'l3ochaq.ma'
        ];

        if ($product->category) {
            $keywords[] = $product->category->name;
        }

        // Add specific keywords based on category
        if ($product->category) {
            switch (strtolower($product->category->name)) {
                case 'bracelets':
                    $keywords = array_merge($keywords, ['bracelet couple', 'bracelet amour', 'bracelet duo', 'bracelet assortis']);
                    break;
                case 'montres':
                    $keywords = array_merge($keywords, ['montre couple', 'montres assorties', 'montre amour', 'montre duo']);
                    break;
                case 'colliers':
                    $keywords = array_merge($keywords, ['collier couple', 'pendentif amour', 'collier duo', 'collier coeur']);
                    break;
                case 'bagues':
                    $keywords = array_merge($keywords, ['bague couple', 'alliance', 'bague amour', 'bague promesse']);
                    break;
                default:
                    $keywords = array_merge($keywords, ['cadeau saint valentin', 'cadeau anniversaire', 'cadeau romantique']);
            }
        }

        return implode(', ', $keywords);
    }

    /**
     * Get product image for social media
     */
    private function getProductImage($product)
    {
        if ($product->images && $product->images->count() > 0) {
            return Storage::url($product->images->first()->image_path);
        }
        
        if ($product->image) {
            return \Illuminate\Support\Facades\Storage::url($product->image);
        }

        return asset('images/l3ochaq-default-product.jpg');
    }

    /**
     * Generate structured data for products
     */
    private function generateProductStructuredData($product)
    {
        $structuredData = [
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => $product->name,
            "description" => $product->description,
            "image" => $this->getProductImage($product),
            "brand" => [
                "@type" => "Brand",
                "name" => "L3OCHAQ"
            ],
            "offers" => [
                "@type" => "Offer",
                "price" => $product->price,
                "priceCurrency" => "MAD",
                "availability" => $product->stock > 0 ? "https://schema.org/InStock" : "https://schema.org/OutOfStock",
                "seller" => [
                    "@type" => "Organization",
                    "name" => "L3OCHAQ Store"
                ]
            ]
        ];

        if ($product->rating) {
            $structuredData["aggregateRating"] = [
                "@type" => "AggregateRating",
                "ratingValue" => $product->rating,
                "bestRating" => 5,
                "worstRating" => 1,
                "ratingCount" => rand(10, 100)
            ];
        }

        return json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Generate sitemap
     */
    public function generateSitemap()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= $this->addSitemapUrl('/', '1.0', 'daily', now()->toISOString());

        // Products page
        $xml .= $this->addSitemapUrl('/products', '0.9', 'daily', now()->toISOString());

        // Categories
        $categories = Category::all();
        foreach ($categories as $category) {
            $xml .= $this->addSitemapUrl("/products?category={$category->slug}", '0.8', 'weekly', $category->updated_at->toISOString());
        }

        // Products (exclude test/demo products from sitemap)
        $products = Product::with('category')
            ->where('slug', 'not like', '%test%')
            ->where('slug', 'not like', '%demo%')
            ->where('slug', 'not like', '%sample%')
            ->where('slug', 'not like', '%placeholder%')
            ->where('name', 'not like', '%test%')
            ->where('name', 'not like', '%demo%')
            ->where('name', 'not like', '%sample%')
            ->where('name', 'not like', '%placeholder%')
            ->get();
        foreach ($products as $product) {
            $xml .= $this->addSitemapUrl("/products/{$product->slug}", '0.7', 'monthly', $product->updated_at->toISOString());
        }

        // Static pages
        $xml .= $this->addSitemapUrl('/cart', '0.5', 'never');
        $xml .= $this->addSitemapUrl('/wishlist', '0.5', 'never');

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Add URL to sitemap
     */
    private function addSitemapUrl($url, $priority = '0.5', $changefreq = 'monthly', $lastmod = null)
    {
        // Use the configured APP_URL from .env for production domain
        $baseUrl = config('app.url');
        
        // Ensure we use the production domain for sitemap
        if (config('app.env') === 'production' || request()->getHost() !== '127.0.0.1') {
            $baseUrl = 'https://l3ochaq.ma';
        }
        
        $fullUrl = rtrim($baseUrl, '/') . $url;
        
        $xml = "  <url>\n";
        $xml .= "    <loc>{$fullUrl}</loc>\n";
        
        if ($lastmod) {
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
        }
        
        $xml .= "    <changefreq>{$changefreq}</changefreq>\n";
        $xml .= "    <priority>{$priority}</priority>\n";
        $xml .= "  </url>\n";

        return $xml;
    }

    /**
     * Generate robots.txt content
     */
    public function generateRobotsTxt()
    {
        // Use the production domain for robots.txt
        $baseUrl = config('app.env') === 'production' || request()->getHost() !== '127.0.0.1' 
            ? 'https://l3ochaq.ma' 
            : config('app.url');
            
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /samad\n";
        $content .= "Disallow: /samad1\n";
        $content .= "Disallow: /cart/\n";
        $content .= "Disallow: /checkout/\n";
        $content .= "Disallow: /orders/\n";
        $content .= "Disallow: /profile/\n";
        $content .= "\n";
        $content .= "Sitemap: " . rtrim($baseUrl, '/') . '/sitemap.xml' . "\n";

        return $content;
    }

    /**
     * Get breadcrumbs for a product
     */
    public function getProductBreadcrumbs($product)
    {
        $breadcrumbs = [
            ['name' => 'Accueil', 'url' => url('/')],
            ['name' => 'Produits', 'url' => route('products')]
        ];

        if ($product->category) {
            $breadcrumbs[] = [
                'name' => $product->category->name,
                'url' => route('products') . '?category=' . $product->category->slug
            ];
        }

        $breadcrumbs[] = ['name' => $product->name, 'url' => null];

        return $breadcrumbs;
    }

    /**
     * Generate structured data for breadcrumbs
     */
    public function generateBreadcrumbStructuredData($breadcrumbs)
    {
        $items = [];
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $item = [
                "@type" => "ListItem",
                "position" => $index + 1,
                "name" => $breadcrumb['name']
            ];
            
            if ($breadcrumb['url']) {
                $item['item'] = $breadcrumb['url'];
            }
            
            $items[] = $item;
        }

        $structuredData = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $items
        ];

        return json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
