<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products Export</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3B82F6;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #1E40AF;
            font-size: 28px;
        }
        .header p {
            margin: 5px 0;
            color: #6B7280;
        }
        .stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
            background: #F3F4F6;
            padding: 15px;
            border-radius: 8px;
        }
        .stat-item {
            text-align: center;
        }
        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #1E40AF;
        }
        .stat-label {
            font-size: 12px;
            color: #6B7280;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #E5E7EB;
            padding: 6px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #F9FAFB;
            font-weight: bold;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #F9FAFB;
        }
        .price {
            font-weight: bold;
            color: #059669;
        }
        .out-of-stock {
            color: #DC2626;
            font-weight: bold;
        }
        .low-stock {
            color: #D97706;
            font-weight: bold;
        }
        .in-stock {
            color: #059669;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #6B7280;
            border-top: 1px solid #E5E7EB;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🛍️ Products Catalog</h1>
        <p>l3ochaq Store - Product Inventory Export</p>
        <p>Generated on: {{ $export_date }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ number_format($total_products) }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($total_value) }} DH</div>
            <div class="stat-label">Total Value</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($products->where('is_active', true)->count()) }}</div>
            <div class="stat-label">Active Products</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($products->where('stock', 0)->count()) }}</div>
            <div class="stat-label">Out of Stock</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Product Name</th>
                <th width="15%">Category</th>
                <th width="12%">Price</th>
                <th width="10%">Stock</th>
                <th width="8%">Rating</th>
                <th width="10%">Reviews</th>
                <th width="8%">Status</th>
                <th width="7%">Featured</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                <td class="price">{{ number_format($product->price) }} DH</td>
                <td class="
                    @if($product->stock == 0) out-of-stock
                    @elseif($product->stock <= 10) low-stock
                    @else in-stock @endif
                ">
                    {{ $product->stock }}
                </td>
                <td>{{ $product->rating ? number_format($product->rating, 1) : 'N/A' }}</td>
                <td>{{ $product->review_count ?? 0 }}</td>
                <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>l3ochaq Store</strong> - Products Export</p>
        <p>Total Products: {{ number_format($total_products) }} | Total Value: {{ number_format($total_value) }} DH | Export Date: {{ $export_date }}</p>
    </div>
</body>
</html>
