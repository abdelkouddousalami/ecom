<!DOCTYPE html>
<html>
<head>
    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1542855409759945');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1542855409759945&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    
    <title>Test Page</title>
</head>
<body>
    <h1>Test Page Working</h1>
    <p>If you can see this, basic Laravel is working.</p>
    <p>Current time: {{ now() }}</p>
    
    @auth
        <p>Logged in as: {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
    @else
        <p>Not logged in</p>
    @endauth
    
    <h2>Database Test</h2>
    <p>Total users: {{ \App\Models\User::count() }}</p>
    <p>Total products: {{ \App\Models\Product::count() }}</p>
    <p>Total categories: {{ \App\Models\Category::count() }}</p>
</body>
</html>
