<?php
	class Cart {

		public $items = null;
		public $totalQuantity = 0;
		public $totalPrice = 0;

		public function __construct($oldCart){
			//if cart exists
			if($oldCart){
				//set items to current cart items, price n qty;
				$this->items = $oldCart->items;
				$this->totalQuantity = $oldCart->totalQuantity;
				$this->totalPrice = $oldCart->totalPrice;
			}
		}	

		function add($item){
			//default stored item values;
			$storedItem = [ 'qty' => 0, 'total_price' => $item['price'], 'name' => $item['name'],'item' => $item,'price' => $item['price'] ];
			//if has items 
			if($this->items){
				//check for product name
				if(array_key_exists($item['name'], $this->items)){
					//use previously stored item
					$storedItem = $this->items[$item['name']];
				}
			}
			//update necessary cart & stored item values;
			$storedItem['qty']++;
			$storedItem['total_price'] = $item['price'] * $storedItem['qty'];
			$this->items[$item['name']] = $storedItem;
			$this->totalQuantity++;
			$this->totalPrice += $item['price'];
		}

		function remove($itemName)
		{
			//if product exists
			if(isset($this->items[$itemName])){
				//remove price from total
				$this->totalPrice-=$this->items[$itemName]['total_price'];
				//remove item;
				unset($this->items[$itemName]);
			}
		}

	}

?>