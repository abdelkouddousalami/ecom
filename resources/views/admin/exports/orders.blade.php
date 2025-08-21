<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders Export</title>
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
        .status {
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
        }
        .status-pending { background: #F59E0B; }
        .status-confirmed { background: #3B82F6; }
        .status-processing { background: #8B5CF6; }
        .status-shipped { background: #06B6D4; }
        .status-delivered { background: #10B981; }
        .status-cancelled { background: #EF4444; }
        .price {
            font-weight: bold;
            color: #059669;
        }
        .order-items {
            font-size: 9px;
            color: #6B7280;
            margin-top: 2px;
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
        <h1>📦 Orders Report</h1>
        <p>l3ochaq Store - Sales & Orders Export</p>
        <p>Generated on: {{ $export_date }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ number_format($total_orders) }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($total_revenue) }} DH</div>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($orders->where('status', 'delivered')->count()) }}</div>
            <div class="stat-label">Delivered</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($orders->where('status', 'pending')->count()) }}</div>
            <div class="stat-label">Pending</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="15%">Order Number</th>
                <th width="20%">Customer</th>
                <th width="25%">Address</th>
                <th width="10%">Total</th>
                <th width="10%">Status</th>
                <th width="15%">Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->order_number }}</td>
                <td>
                    <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                    <span style="font-size: 9px; color: #6B7280;">{{ $order->phone }}</span>
                </td>
                <td style="font-size: 9px;">
                    {{ $order->address }}<br>
                    {{ $order->city }}
                </td>
                <td class="price">{{ number_format($order->total) }} DH</td>
                <td>
                    <span class="status status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('M j, Y H:i') }}</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="6" class="order-items">
                    <strong>Items:</strong>
                    @foreach($order->items as $item)
                        {{ $item->product->name ?? 'Product' }} ({{ $item->quantity }}x {{ number_format($item->price) }} DH){{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @if($order->notes)
                        <br><strong>Notes:</strong> {{ $order->notes }}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>l3ochaq Store</strong> - Orders Export</p>
        <p>Total Orders: {{ number_format($total_orders) }} | Total Revenue: {{ number_format($total_revenue) }} DH | Export Date: {{ $export_date }}</p>
    </div>
</body>
</html>
