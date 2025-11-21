<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'l3ochaq store - Bijoux de Luxe & Cadeaux Personnalisés | Maroc',
    'description' => 'l3ochaq store - Le meilleur magasin de bijoux au Maroc. Découvrez nos bracelets de luxe, montres élégantes et cadeaux personnalisés avec gravure "Print on Your Eyes". Livraison gratuite.',
    'keywords' => 'l3ochaq store, bijoux, meilleur magasin, bracelets, montres, cadeaux, luxe, gravure personnalisée, print on your eyes, Maroc',
    'canonical' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
    'structuredData' => null,
    'breadcrumbData' => null
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => 'l3ochaq store - Bijoux de Luxe & Cadeaux Personnalisés | Maroc',
    'description' => 'l3ochaq store - Le meilleur magasin de bijoux au Maroc. Découvrez nos bracelets de luxe, montres élégantes et cadeaux personnalisés avec gravure "Print on Your Eyes". Livraison gratuite.',
    'keywords' => 'l3ochaq store, bijoux, meilleur magasin, bracelets, montres, cadeaux, luxe, gravure personnalisée, print on your eyes, Maroc',
    'canonical' => null,
    'ogTitle' => null,
    'ogDescription' => null,
    'ogImage' => null,
    'structuredData' => null,
    'breadcrumbData' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!-- Primary Meta Tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo e($title); ?></title>
<meta name="description" content="<?php echo e($description); ?>">
<meta name="keywords" content="<?php echo e($keywords); ?>">
<meta name="author" content="l3ochaq store">
<meta name="robots" content="index, follow">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- Canonical URL -->
<?php if($canonical): ?>
<link rel="canonical" href="<?php echo e($canonical); ?>">
<?php else: ?>
<link rel="canonical" href="<?php echo e(url()->current()); ?>">
<?php endif; ?>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(url()->current()); ?>">
<meta property="og:title" content="<?php echo e($ogTitle ?? $title); ?>">
<meta property="og:description" content="<?php echo e($ogDescription ?? $description); ?>">
<meta property="og:image" content="<?php echo e($ogImage ?? asset('images/l3ochaq-og-image.jpg')); ?>">
<meta property="og:site_name" content="l3ochaq store">

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon.png')); ?>">

<!-- Structured Data -->
<?php if($structuredData): ?>
<script type="application/ld+json">
<?php echo $structuredData; ?>

</script>
<?php endif; ?>

<?php if($breadcrumbData): ?>
<script type="application/ld+json">
<?php echo $breadcrumbData; ?>

</script>
<?php endif; ?>

<!-- Theme Color -->
<meta name="theme-color" content="#dc2626">
<?php /**PATH C:\xampp\htdocs\Breifs\l3och\ecommerce\resources\views\components\seo-meta-safe.blade.php ENDPATH**/ ?>