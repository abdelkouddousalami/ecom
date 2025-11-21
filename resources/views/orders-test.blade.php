<!DOCTYPE html>
<html lang="en">
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
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Commandes - l3ochaq Store</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Cinzel:wght@400;600&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50" style="font-family: 'Playfair Display', serif;">
    
    <!-- Navigation -->
    <x-navbar active-page="orders" />

    <!-- Page Header -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-center">Mes Commandes</h1>
            <p class="text-blue-100 text-center mt-2">Suivez l'état de vos commandes</p>
        </div>
    </div>

    <!-- Orders Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($orders->isEmpty())
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Aucune commande</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore passé de commandes</p>
                <a href="/products" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Commencer à acheter
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $order->order_number }}</h3>
                                <p class="text-gray-600">Commande passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-4 mt-4 lg:mt-0">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'processing') bg-purple-100 text-purple-800
                                    @elseif($order->status === 'shipped') bg-indigo-100 text-indigo-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $order->getStatusLabel() }}
                                </span>
                                <span class="text-xl font-bold text-blue-600">{{ number_format($order->total, 2) }} DH</span>
                            </div>
                        </div>
                        
                        <div class="border-t pt-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Livraison à:</p>
                                    <p class="text-gray-600">{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p class="text-gray-600">{{ $order->address }}</p>
                                    <p class="text-gray-600">{{ $order->city }} {{ $order->postal_code }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Contact:</p>
                                    <p class="text-gray-600">{{ $order->email }}</p>
                                    <p class="text-gray-600">{{ $order->phone }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Mode de paiement:</p>
                                    <p class="text-gray-600">{{ $order->getPaymentMethodLabel() }}</p>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <h4 class="font-semibold text-gray-900 mb-3">Articles commandés:</h4>
                                <div class="space-y-2">
                                    @foreach($order->items as $item)
                                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16 rounded-lg overflow-hidden bg-white border">
                                                    <img src="{{ Storage::url($item->product->image) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="w-full h-full object-cover"
                                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0yMS4zMzMzIDIxLjMzMzNIMjMuOTk5OUMyNC4zNjgzIDIxLjMzMzMgMjQuNzIxIDIxLjMzMzMgMjUuMDU3NiAyMS4zNTU5QzI1LjcxMTUgMjEuMzk5OSAyNi4zMjI1IDIxLjY0NTIgMjYuNzkwMiAyMi4wNzEzTDQyLjY2NjYgMzcuOTk5OVY0OEMzMS40NjY2IDQ4IDE5LjMzMzMgNDggMTYgNDhWMjYuNjY2NkMxNiAyNC45MjI5IDE2IDI0LjA1MTMgMTYuMzk4MSAyMy4zNTE5QzE2LjUwMTEgMjMuMTUxNyAxNi42Mjg0IDIyLjk2MyAxNi43Nzc4IDIyLjc4ODlMMTYuODg4OSAyMi42NjY2QzE3LjU4NDcgMjEuOTcwNyAxOC42OTAzIDIxLjMzMzMgMjEuMzMzMyAyMS4zMzMzWiIgZmlsbD0iIzlDQTNBRiIvPgo8Y2lyY2xlIGN4PSIyNiIgY3k9IjI5LjMzMzMiIHI9IjMuOTk5OSIgZmlsbD0iI0Q5RDlEOSIvPgo8L3N2Zz4K'">
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-900">{{ $item->product->name }}</h5>
                                                    <p class="text-gray-600">{{ number_format($item->price, 2) }} DH × {{ $item->quantity }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-green-600">{{ number_format($item->total, 2) }} DH</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
    </div>

    <!-- Footer -->
    <x-footer />
</body>
</html>
