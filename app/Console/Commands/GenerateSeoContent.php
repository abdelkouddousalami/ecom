<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\Product;

class GenerateSeoContent extends Command
{
    protected $signature = 'seo:generate-content';
    protected $description = 'Generate SEO-friendly content for products and categories';

    public function handle()
    {
        $this->info('Starting SEO content generation...');

        // Update category descriptions with SEO content
        $this->updateCategoryDescriptions();
        
        // Update product descriptions with SEO keywords
        $this->updateProductDescriptions();

        $this->info('SEO content generation completed successfully!');
    }

    private function updateCategoryDescriptions()
    {
        $seoDescriptions = [
            'bracelets' => 'Découvrez notre collection exclusive de bracelets de luxe chez MOCLE. Bracelets en cuir, acier et argent avec gravure personnalisée "Print on Your Eyes". Livraison gratuite au Maroc.',
            'montres' => 'Montres élégantes et de qualité supérieure chez MOCLE. Collection premium de montres homme et femme avec service de gravure personnalisée. Le meilleur choix au Maroc.',
            'colliers' => 'Colliers et pendentifs de luxe chez MOCLE Store. Bijoux en or, argent et acier avec gravure personnalisée. Cadeaux parfaits avec livraison rapide au Maroc.',
            'bagues' => 'Bagues élégantes et alliances de qualité chez MOCLE. Bijoux personnalisables avec gravure "Print on Your Eyes". Collection premium au meilleur prix au Maroc.',
            'cadeaux' => 'Cadeaux uniques et personnalisés chez MOCLE Store. Bijoux gravés, montres et accessoires de luxe. Le meilleur magasin de cadeaux au Maroc.',
        ];

        foreach ($seoDescriptions as $slug => $description) {
            $category = Category::where('slug', $slug)->first();
            if ($category) {
                $category->update(['description' => $description]);
                $this->line("Updated category: {$category->name}");
            }
        }
    }

    private function updateProductDescriptions()
    {
        $products = Product::all();
        
        foreach ($products as $product) {
            $seoDescription = $this->generateProductSeoDescription($product);
            
            // Only update if current description is too short or generic
            if (strlen($product->description) < 100) {
                $product->update(['description' => $seoDescription]);
                $this->line("Updated product: {$product->name}");
            }
        }
    }

    private function generateProductSeoDescription($product)
    {
        $baseKeywords = [
            'MOCLE',
            'bijoux de luxe',
            'gravure personnalisée',
            'Print on Your Eyes',
            'livraison gratuite',
            'Maroc',
            'qualité premium'
        ];

        $categoryKeywords = [];
        if ($product->category) {
            switch (strtolower($product->category->name)) {
                case 'bracelets':
                    $categoryKeywords = ['bracelet', 'cuir', 'acier', 'élégant', 'style'];
                    break;
                case 'montres':
                    $categoryKeywords = ['montre', 'temps', 'précision', 'élégance', 'suisse'];
                    break;
                case 'colliers':
                    $categoryKeywords = ['collier', 'pendentif', 'chaîne', 'or', 'argent'];
                    break;
                case 'bagues':
                    $categoryKeywords = ['bague', 'alliance', 'solitaire', 'mariage', 'fiançailles'];
                    break;
                default:
                    $categoryKeywords = ['accessoire', 'bijou', 'cadeau'];
            }
        }

        $allKeywords = array_merge($baseKeywords, $categoryKeywords);
        
        $description = "Découvrez le {$product->name} chez MOCLE, le meilleur magasin de bijoux au Maroc. ";
        $description .= "Article de qualité premium avec possibilité de gravure personnalisée 'Print on Your Eyes'. ";
        $description .= "Prix exceptionnel à {$product->price} DH avec livraison gratuite. ";
        $description .= "Rejoignez nos clients satisfaits et offrez-vous le luxe abordable. ";
        $description .= "Commandez maintenant votre " . strtolower($product->category ? $product->category->name : 'bijou') . " unique !";

        return $description;
    }
}
