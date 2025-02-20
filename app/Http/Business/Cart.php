<?php
namespace App\Http\Business;

use App\Http\Services\Product\ProductService;
use Exception;

class Cart
{
    const CART_PREFIX = "cart_manage";

    protected array $cartItems = [];
    protected int $userId;
    protected string $cartKey;

    
    protected function __construct($userId)
    {
        $this->userId = $userId;
        $this->cartKey = static::CART_PREFIX."_". $this->userId;
        if(session()->has($this->cartKey)){
            $this->cartItems = session($this->cartKey);
        }else{
            session()->put($this->cartKey, []);
        }
    }

    public static function getInstance(int $userId = null): Cart
    {
        return new Cart($userId);
    }

    public function addToCart(int $productId, int $sizeId, int $quantity)
    {
        $product = resolve(ProductService::class)->show($productId);

        if(empty($product)) throw new Exception("Product Not Found");

        if(!empty($this->cartItems)){
            foreach($this->cartItems as &$item){
                if($item->productId == $productId){
                    $item->increase($quantity);
                }else{
                    $cartItem = new CartItem($productId, $sizeId, $quantity);
                    $this->cartItems[] = $cartItem;
                }
            }
        }else{
            $cartItem = new CartItem($productId, $sizeId, $quantity);
            $this->cartItems[] = $cartItem;
        }
        
        $this->putToSession();
    }

    public function removeCart()
    {
        
    }

    private function putToSession()
    {
        session()->put($this->cartKey, $this->cartItems);
    }

    public function content()
    {
        return $this->cartItems;
    }
}