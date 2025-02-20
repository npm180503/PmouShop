<?php

namespace App\View\Components;

use App\Http\Business\Cart;
use App\Http\Enums\EnumStatus;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rules\Enum;
use Illuminate\View\Component;

class CartComponent extends Component
{
    public $cart = null;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $cartItems = [];
        if(auth('frontend')->id()){
            $this->cart = Cart::getInstance(auth('frontend')->id());
            $cartItems = collect($this->cart->content());
            $productIds = $cartItems->map(function($item) {
                return $item->productId;
            })->toArray();
            $products = Product::whereIn('id', $productIds)->where('active', EnumStatus::ACTIVE->value)->get()->keyBy('id');
            $cartItems->each(function($item) use($products){
                $item->product = $products[$item->productId] ?? null;
            });
            
        }

        return view('components.cart-component', [
            'cartItems' => $cartItems
        ]);
    }
}
