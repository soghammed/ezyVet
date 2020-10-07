<?php
	require 'Cart.php';	
	session_start();
	// session_unset();
	$products = [
	 [ "name" => "Sledgehammer", "price" => 125.75 ],
	 [ "name" => "Axe", "price" => 190.50 ],
	 [ "name" => "Bandsaw", "price" => 562.131 ],
	 [ "name" => "Chisel", "price" => 12.9 ],
	 [ "name" => "Hacksaw", "price" => 18.45 ],
	];

	$oldCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
	$cart = new Cart($oldCart);
	
	if(isset($_GET['name']) && isset($_GET['price'])){
		$item = array(
			'name' => $_GET['name'],
			'price' => $_GET['price']
		);
		$cart->add($item);
		$_SESSION['cart'] = $cart;
	}

	if(isset($_GET['remove']) && $_GET['remove']!=''){
		$cart->remove($_GET['remove']);
		$_SESSION['cart'] = $cart;
	}

?>

<!DOCTYPE html>
<html>
<head>

	<title>Cart Sample</title>
	<meta http-equiv="refresh" content="5;url=">
	<style>
		body{
			margin:4rem;
		}
		.products-grid,.cart-products{
			display:grid;
			grid-template-columns: repeat(3, 1fr);
			text-align:center;
		}
		.product{
			margin:2rem;
			border-radius:20px;
			padding:1rem;
			background-color:#2d2d2d;
			color:white;
		}
	</style>
</head>
<body>
	<h2> Products </h2>
	<div class="products-grid">
		<?php foreach($products as $product){ ?> 
			<div class="product">
				<div>Name: <?php echo $product['name'] ?></div>
				<div>Price: <?php echo number_format($product['price'], 2, '.', ''); ?></div>
				<div>
					<a href="?<?php echo http_build_query($product)?>"><button>Add Product</button></a>
				</div>
			</div>
		<?php } ?>
	</div>

	<?php if($cart->items){ ?>
		<h2>Cart - Total: <?php echo $cart->totalPrice ?> </h2>
		<div class="cart-products">
			<?php foreach($cart->items as $item){ ?>
				<div class="product">
					<div>Name: <?php echo $item['name'] ?></div>
					<div>Price: <?php echo number_format($item['price'], 2, '.', ''); ?></div>
					<div>Quantity: <?php echo $item['qty'] ?></div>
					<div>Total: <?php echo number_format($item['total_price'], 2, '.', ''); ?></div>
					<div><a href="?remove=<?php echo $item['name'] ?>"><button>Remove</button></a></div>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<script>
		//remove url params on refresh to not duplicate cart action.
		let url = window.location.href;
		let splitURL = url.split('?');
		if(splitURL.length > 1){
			window.location.href = splitURL[0];
		}
	</script>
</body>
</html>