<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Add debug logging
        Log::info('Order creation attempt', [
            'request_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'payment_method' => 'required|in:cod,bank,card',
                'cart_items' => 'required|array',
                'cart_items.*.id' => 'required|exists:products,id',
                'cart_items.*.quantity' => 'required|integer|min:1'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Order validation failed', [
                'errors' => $e->errors()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', Arr::flatten($e->errors()))
            ], 422);
        }

        try {
            DB::beginTransaction();

            $sessionId = Session::getId();
            $subtotal = 0;
            
            // Validate cart items and calculate total
            $validatedItems = [];
            foreach ($request->cart_items as $cartItem) {
                $product = Product::findOrFail($cartItem['id']);
                
                // Check stock availability
                if ($product->stock < $cartItem['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stock insuffisant pour le produit: {$product->name}. Stock disponible: {$product->stock}"
                    ]);
                }
                
                $itemTotal = $product->price * $cartItem['quantity'];
                $subtotal += $itemTotal;
                
                $validatedItems[] = [
                    'product' => $product,
                    'quantity' => $cartItem['quantity'],
                    'price' => $product->price,
                    'total' => $itemTotal
                ];
            }

            // Create order (removed user_id dependency)
            $order = Order::create([
                'session_id' => $sessionId,
                'order_number' => 'ORD-' . date('Y') . '-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'shipping_cost' => 0, // Free shipping
                'total' => $subtotal,
                'status' => Order::STATUS_PENDING
            ]);

            // Create order items and update product stock
            foreach ($validatedItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['total']
                ]);

                // Update product stock
                $item['product']->decrement('stock', $item['quantity']);
            }

            // Note: Cart is managed via localStorage on frontend, so no database cart clearing needed

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Commande créée avec succès!',
                'order_number' => $order->order_number,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the error with more details
            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la commande: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('order-details', compact('order'));
    }

    public function index()
    {
        $sessionId = Session::getId();
        
        $orders = Order::with(['items.product'])
            ->where('session_id', $sessionId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders', compact('orders'));
    }
    
    public function success(Order $order)
    {
        return view('order-success', compact('order'));
    }
}
