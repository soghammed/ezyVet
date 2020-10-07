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
				
				//if has qty larger than 1 update qty and stored total prices
				if($this->items[$itemName]['qty'] > 1){
					$this->items[$itemName]['qty']--;
					$this->items[$itemName]['total_price'] = $this->items[$itemName]['price'] * $this->items[$itemName]['qty']; 
					$this->totalPrice-=$this->items[$itemName]['price'];
				}else{
					//else update total cart price & remove item;
					$this->totalPrice-=$this->items[$itemName]['total_price'];
					unset($this->items[$itemName]);
				}
			}
		}

	}

?>