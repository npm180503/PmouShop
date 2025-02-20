<?php

namespace App\Http\Business;

use App\Models\Size;

class CartItem
{
    protected int $productId;
    protected int $sizeId;
    protected int $quantity;
    public function __construct(int $productId, int $sizeId, int $quantity)
    {
        $this->productId = $productId;
        $this->sizeId = $sizeId;
        $this->quantity = $quantity;
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function increase(int $quantity)
    {
        $this->quantity += $quantity;
    }

    public function getSize()
    {
        return Size::find($this->sizeId); // Lấy size từ database
    }
}
