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
<meta name="csrf-token" content="{{ csrf_token() }}">

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
<meta property="og:site_name" content="l3ochaq store">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.png') }}">

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

<!-- Theme Color -->
<meta name="theme-color" content="#dc2626">
