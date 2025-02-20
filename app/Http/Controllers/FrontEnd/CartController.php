<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Business\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = Cart::getInstance(auth("frontend")->id());
        // Sau viet vao validate
        $productId = $request->id;
        $sizeId = $request->size_id;
        $quantity = $request->quantity;
        $cart->addToCart($productId, $sizeId, $quantity);

        return response()->json([
            'message' => 'Đã thêm vào giỏ hàng',
            'total_items' => session('cart_total')
        ]);
    }

    // public removeCart()
    // {
    //     $cart = Cart::getInstance(auth("frontend")->id());
    //     $cart->removeCart();
    // }

    public function viewCart()
    {
        return view('cart', ['cart' => session('cart', []), 'cart_total' => session('cart_total', 0)]);
    }
    
}
