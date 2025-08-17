<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $sessionId = Session::getId();
        $userId = auth()->user() ? auth()->user()->id : null;

        // Check if item already exists in wishlist
        $wishlistItem = Wishlist::where('product_id', $product->id)
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->first();

        if ($wishlistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist!'
            ]);
        }

        // Create new wishlist item
        Wishlist::create([
            'session_id' => $userId ? null : $sessionId,
            'user_id' => $userId,
            'product_id' => $product->id
        ]);

        // Get wishlist count
        $wishlistCount = $this->getWishlistCount();

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist!',
            'wishlist_count' => $wishlistCount
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $sessionId = Session::getId();
        $userId = auth()->user() ? auth()->user()->id : null;

        $wishlistItem = Wishlist::where('product_id', $request->product_id)
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Product removed from wishlist!',
                'wishlist_count' => $this->getWishlistCount()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found in wishlist.'
        ]);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $sessionId = Session::getId();
        $userId = auth()->user() ? auth()->user()->id : null;

        $wishlistItem = Wishlist::where('product_id', $request->product_id)
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->first();

        if ($wishlistItem) {
            // Remove from wishlist
            $wishlistItem->delete();
            $message = 'Product removed from wishlist!';
            $inWishlist = false;
        } else {
            // Add to wishlist
            Wishlist::create([
                'session_id' => $userId ? null : $sessionId,
                'user_id' => $userId,
                'product_id' => $request->product_id
            ]);
            $message = 'Product added to wishlist!';
            $inWishlist = true;
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'in_wishlist' => $inWishlist,
            'wishlist_count' => $this->getWishlistCount()
        ]);
    }

    public function getWishlist()
    {
        $sessionId = Session::getId();
        $userId = auth()->user() ? auth()->user()->id : null;

        $wishlistItems = Wishlist::with(['product.images'])
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId)->whereNull('user_id');
                }
            })
            ->get();

        return response()->json([
            'success' => true,
            'wishlist_items' => $wishlistItems,
            'wishlist_count' => $wishlistItems->count()
        ]);
    }

    public function getWishlistCount()
    {
        $sessionId = Session::getId();
        $userId = auth()->user() ? auth()->user()->id : null;

        return Wishlist::where(function ($query) use ($sessionId, $userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId)->whereNull('user_id');
            }
        })->count();
    }

    public function clear()
    {
        $sessionId = Session::getId();
        $userId = auth()->user() ? auth()->user()->id : null;

        Wishlist::where(function ($query) use ($sessionId, $userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId)->whereNull('user_id');
            }
        })->delete();

        return response()->json([
            'success' => true,
            'message' => 'Wishlist cleared successfully!',
            'wishlist_count' => 0
        ]);
    }
}
