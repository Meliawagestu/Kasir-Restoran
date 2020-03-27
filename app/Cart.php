<?php

namespace App;
use App\Masakan;

class Cart 
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
    	if ($oldCart){
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }

    public function add($item, $id_masakan)
    {
    	$storedItem = ['qty' => 0, 'harga' => $item->harga, 'item' =>$item];
    	if ($this->items) {
    		if (array_key_exists($id_masakan, $this->items)) {
    			$storedItem = $this->items[$id_masakan];
    		}
    	}
    	$storedItem['qty']++;
    	$storedItem['harga'] = $item->harga * $storedItem['qty'];
    	$this->items[$id_masakan] = $storedItem;
    	$this->totalQty++;
    	$this->totalPrice += $item->harga;
    }

    public function reduceByOne($id_masakan)
    {
        $this->items[$id_masakan]['qty']--;
        $this->items[$id_masakan]['harga'] -= $this->items[$id_masakan]['item']['harga'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id_masakan]['item']['harga'];

        if ($this->items[$id_masakan]['qty'] <= 0) {
            unset($this->items[$id_masakan]);
        }
    }

    public function addOne($id_masakan)
    {
        $this->items[$id_masakan]['qty']++;
        $this->items[$id_masakan]['harga'] += $this->items[$id_masakan]['item']['harga'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id_masakan]['item']['harga'];
    }

    public function removeItem($id_masakan)
    {
        $this->totalQty -= $this->items[$id_masakan]['qty'];
        $this->totalPrice -= $this->items[$id_masakan]['harga'];
        unset($this->items[$id_masakan]);
    }
    
}
