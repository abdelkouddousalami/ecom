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
    
    <meta charset="utf-8">
    <title>Phone Numbers Export</title>
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
            font-size: 24px;
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
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #F9FAFB;
            font-weight: bold;
            color: #374151;
        }
        tr:nth-child(even) {
            background-color: #F9FAFB;
        }
        .active {
            color: #10B981;
            font-weight: bold;
        }
        .inactive {
            color: #EF4444;
            font-weight: bold;
        }
        .source {
            background: #E0E7FF;
            color: #3730A3;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
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
        <h1>📱 Phone Numbers Database</h1>
        <p>l3ochaq Store - Customer Contact Export</p>
        <p>Generated on: {{ now()->format('F j, Y \a\t g:i A') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ number_format($stats['total_phone_numbers']) }}</div>
            <div class="stat-label">Total Numbers</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($stats['from_orders']) }}</div>
            <div class="stat-label">From Orders</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($stats['active_numbers']) }}</div>
            <div class="stat-label">Active Numbers</div>
        </div>
        <div class="stat-item">
            <div class="stat-value">{{ number_format($stats['manual_entries']) }}</div>
            <div class="stat-label">Manual Entries</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Name</th>
                <th width="20%">Phone Number</th>
                <th width="35%">Address</th>
                <th width="10%">Source</th>
                <th width="5%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($phoneNumbers as $index => $phoneNumber)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $phoneNumber->name ?: 'N/A' }}</td>
                <td style="font-family: monospace; font-weight: bold;">{{ $phoneNumber->phone }}</td>
                <td>{{ $phoneNumber->address ?: 'No address provided' }}</td>
                <td>
                    <span class="source">{{ ucfirst($phoneNumber->source) }}</span>
                </td>
                <td class="{{ $phoneNumber->is_active ? 'active' : 'inactive' }}">
                    {{ $phoneNumber->is_active ? '✓' : '✗' }}
                </td>
            </tr>
            @if($phoneNumber->notes)
            <tr>
                <td></td>
                <td colspan="5" style="font-style: italic; color: #6B7280; font-size: 10px;">
                    Notes: {{ $phoneNumber->notes }}
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>l3ochaq Store</strong> - Customer Database Export</p>
        <p>This document contains confidential customer information. Handle with care.</p>
        <p>Total Records: {{ number_format($stats['total_phone_numbers']) }} | Active: {{ number_format($stats['active_numbers']) }} | From Orders: {{ number_format($stats['from_orders']) }} | Export Date: {{ now()->format('M j, Y') }}</p>
    </div>
</body>
</html>
