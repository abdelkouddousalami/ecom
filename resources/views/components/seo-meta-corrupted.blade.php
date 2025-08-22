@props([
    'title' => 'l3ochaq store - Bijoux de Luxe & Cadeaux Personnalisés | Maroc',
    'description' => 'l3ochaq store - Le meilleur magasin de bijoux au Maroc. Découvrez nos bracelets de luxe, montres élégantes et cadeaux personnalisés avec gravure "Print on Your Eyes". Livraison gratuite.',
    'keywords' => 'l3ochaq store, bijoux, meilleur magasin, bracelets, montres, cadeaux, luxe, gravure personnalisée, print on your eyes, Maroc',
    'canonical' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
    'structuredData' => null,
    'breadcrumbData' => null
])

<!-- Primary Meta Tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="l3ochaq store">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Language and Region -->
<meta name="language" content="French">
<meta name="geo.region" content="MA">
<meta name="geo.country" content="Morocco">
<meta name="geo.placename" content="Morocco">

<!-- Canonical URL -->
@if($canonical)
<link rel="canonical" href="{{ $canonical }}">
@else
<link rel="canonical" href="{{ url()->current() }}">
@endif

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="{{ $ogTitle ?? $title }}">
<meta property="og:description" content="{{ $ogDescription ?? $description }}">
<meta property="og:image" content="{{ $ogImage ?? asset('images/l3ochaq-og-image.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="l3ochaq store">
<meta property="og:locale" content="fr_FR">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="{{ $ogTitle ?? $title }}">
<meta property="twitter:description" content="{{ $ogDescription ?? $description }}">
<meta property="twitter:image" content="{{ $ogImage ?? asset('images/l3ochaq-og-image.jpg') }}">
<meta name="twitter:creator" content="@l3ochaqstore">

<!-- Favicon and App Icons -->
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">

<!-- DNS Prefetch for Performance -->
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

<!-- Preconnect for Critical Resources -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Structured Data -->
@if($structuredData)
<script type="application/ld+json">
{!! $structuredData !!}
</script>
@endif

@if($breadcrumbData)
<script type="application/ld+json">
{!! $breadcrumbData !!}
</script>
@endif

<!-- Organization Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "l3ochaq store",
  "alternateName": "l3ochaq",
  "url": "https://www.l3ochaq.ma",
  "logo": "{{ asset('images/l3ochaq-logo.png') }}",
  "description": "Le meilleur magasin de bijoux au Maroc spécialisé dans les bracelets de luxe, montres élégantes et cadeaux personnalisés avec gravure.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Boulevard Mohammed V",
    "addressLocality": "Casablanca",
    "addressRegion": "Casablanca-Settat",
    "postalCode": "20000",
    "addressCountry": "MA"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+212710817503",
    "contactType": "customer service",
    "availableLanguage": ["French", "Arabic"]
  },
  "sameAs": [
    "https://www.facebook.com/l3ochaqstore",
    "https://www.instagram.com/l3ochaq_store",
    "https://www.tiktok.com/@l3ochaq_store"
  ]
}
</script>

<!-- Website Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "l3ochaq store",
  "url": "https://www.l3ochaq.ma",
  "description": "Le meilleur magasin de bijoux au Maroc. Découvrez nos bracelets de luxe, montres élégantes et cadeaux personnalisés.",
  "publisher": {
    "@type": "Organization",
    "name": "l3ochaq store"
  },
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "{{ route('products') }}?search={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>

<!-- Store Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Store",
  "name": "l3ochaq store",
  "description": "Magasin de bijoux de luxe au Maroc - Bracelets, montres, cadeaux avec gravure personnalisée",
  "url": "https://www.l3ochaq.ma",
  "telephone": "+212710817503",
  "priceRange": "50 MAD - 5000 MAD",
  "image": "{{ asset('images/l3ochaq-store.jpg') }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Boulevard Mohammed V",
    "addressLocality": "Casablanca",
    "addressRegion": "Casablanca-Settat",
    "postalCode": "20000",
    "addressCountry": "MA"
  },
  "openingHoursSpecification": [
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
      "opens": "09:00",
      "closes": "18:00"
    },
    {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": "Saturday",
      "opens": "10:00",
      "closes": "17:00"
    }
  ],
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Bijoux et Accessoires",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Product",
          "name": "Bracelets de Luxe",
          "category": "Jewelry"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Product",
          "name": "Montres Élégantes",
          "category": "Watches"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Product",
          "name": "Cadeaux Personnalisés",
          "category": "Gifts"
        }
      }
    ]
  }
}
</script>

<!-- Google Fonts -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"></noscript>

<!-- Critical CSS Inline (if any) -->
<style>
    /* Critical above-the-fold CSS */
    body { 
        font-family: 'Playfair Display', serif; 
        margin: 0; 
        padding: 0;
    }
    .loading { 
        opacity: 0; 
        transition: opacity 0.3s ease; 
    }
    .loaded { 
        opacity: 1; 
    }
</style>

<!-- Preload Critical Resources -->
<link rel="preload" href="{{ asset('images/l3ochaq-logo.png') }}" as="image">
<link rel="preload" href="{{ asset('css/app.css') }}" as="style">
<link rel="preload" href="{{ asset('js/app.js') }}" as="script">

<!-- Theme Color -->
<meta name="theme-color" content="#dc2626">
<meta name="msapplication-TileColor" content="#dc2626">
<meta name="msapplication-navbutton-color" content="#dc2626">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

<!-- Performance Hints -->
<meta http-equiv="x-dns-prefetch-control" content="on">

<!-- Security Headers -->
<meta http-equiv="X-Content-Type-Options" content="nosniff">
<meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
<meta http-equiv="X-XSS-Protection" content="1; mode=block">

<!-- Additional Meta for E-commerce -->
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="l3ochaq">
