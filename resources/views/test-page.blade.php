<!DOCTYPE html>
<html>
<head>
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
