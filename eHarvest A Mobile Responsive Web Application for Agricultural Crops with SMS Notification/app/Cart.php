<?php

namespace App;
use App\Product;
class Cart 
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty; 
            $this->totalPrice = $oldCart->totalPrice;            
        }
    }

    public function add($id, $price, $cartQuantity)
    {
        $product = Product::find($id);
        $storedItem = ['qty' => 0, 'price' => $product->price, 'item' => $product];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $cartQuantity;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $cartQuantity;
        $this->totalPrice += $price * $cartQuantity;
    }

    public function getBasketDetails($cart)
    {

        return $cart->totalQty . "Items - ₱" . number_format($cart->totalPrice, 2, '.', ','); 

    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }

    public function editTotalPrice($total)
    {
        $this->totalPrice = $total;
    }
    public function editTotalQty($total)
    {
        $this->totalQty = $total;
    }
}
