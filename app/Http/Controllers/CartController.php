<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1|max:10'
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        // Check stock availability
        if ($product->stock < $quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available. Only ' . $product->stock . ' items left.'
            ]);
        }

        $sessionId = Session::getId();
        $userId = auth()->id();

        // Check if item already exists in cart
        $cartItem = Cart::where('product_id', $product->id)
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->first();

        if ($cartItem) {
            // Update quantity if item exists
            $newQuantity = $cartItem->quantity + $quantity;
            
            if ($product->stock < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items. Stock limit exceeded.'
                ]);
            }

            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Create new cart item
            Cart::create([
                'session_id' => $userId ? null : $sessionId,
                'user_id' => $userId,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price
            ]);
        }

        // Get cart count
        $cartCount = $this->getCartCount();

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => $cartCount
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $sessionId = Session::getId();
        $userId = auth()->id();

        $cartItem = Cart::where('product_id', $request->product_id)
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'cart_count' => $this->getCartCount()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart.'
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $sessionId = Session::getId();
        $userId = auth()->id();

        $cartItem = Cart::where('product_id', $request->product_id)
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->first();

        if ($cartItem) {
            $product = $cartItem->product;
            
            if ($product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available.'
                ]);
            }

            $cartItem->update(['quantity' => $request->quantity]);
            
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'cart_count' => $this->getCartCount()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in cart.'
        ]);
    }

    public function getCart()
    {
        $sessionId = Session::getId();
        $userId = auth()->id();

        $cartItems = Cart::with(['product.images'])
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->getTotalPrice();
        });

        return response()->json([
            'success' => true,
            'cart_items' => $cartItems,
            'cart_count' => $cartItems->count(),
            'total' => $total
        ]);
    }

    public function getCartCount()
    {
        $sessionId = Session::getId();
        $userId = auth()->id();

        return Cart::where(function ($query) use ($sessionId, $userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId)->whereNull('user_id');
            }
        })->sum('quantity');
    }

    public function clear()
    {
        $sessionId = Session::getId();
        $userId = auth()->id();

        Cart::where(function ($query) use ($sessionId, $userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId)->whereNull('user_id');
            }
        })->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!',
            'cart_count' => 0
        ]);
    }
}
