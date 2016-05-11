<?php
require ('validation.php');

//Initialize a cart as an array
$cart = array();

$totalCart = 0;

//If the cart is not empty, fill it with the data from the cookie
if(!empty($_COOKIE['cart'])) 
	$cart = json_decode($_COOKIE['cart'], true);

//Check if the products in the POST are empty or not, if not add them to the cart array
if(!empty($_POST['product'])) {
	if (validateItem($_POST['product'])) {
		
		//Increment if item exists, else add it to the cookie
		!empty($cart[$_POST['product']]) ? $cart[$_POST['product']]['qty']++ : $cart[$_POST['product']] = array('qty'=>1);
		
		if ($cart[$_POST['product']]['qty'] <= 0) //Check if quantity has been altered with
			$cart[$_POST['product']]['qty'] = 1;
			
        setcookie('cart',json_encode($cart, true), time() + (86400 * 30)); //Update the cookie
	}
}

if(!empty($_POST['remove'])) {
	unset($cart[$_POST['remove']]);
	setcookie('cart',json_encode($cart, true), time() + (86400 * 30)); //Update the cookie
}

//Because empty() and php is dumb and uses 0 as false and causes conditional problems
//assume that if update_product isn't empty then check update if it's 0, if so remove the item
if (!empty($_POST['update_product']) && $_POST['update'] == 0) {
	unset($cart[$_POST['update_product']]);
	setcookie('cart',json_encode($cart, true), time() + (86400 * 30));
}

if(!empty($_POST['update']) && !empty($_POST['update_product'])) {
	if ($_POST['update'] >= 1000) {
		echo '<script type="text/javascript">alert("Sorry, limit for a single purchase is 1000.")</script>';
	} else {
		if ($_POST['update'] < 0)
			$cart[$_POST['update_product']]['qty'] = 1;
		else
			$cart[$_POST['update_product']]['qty'] = $_POST['update'];
		
		setcookie('cart',json_encode($cart, true), time() + (86400 * 30)); //Update the cookie
	}
}

function showCart($cart) {
	global $products;
	global $totalCart;
	
	$idcount = 0;
	
	if(empty($_COOKIE['cart']) || empty($cart)) 
		echo 'You currently don\'t have any items in your cart! Start shopping <a href="products.php">here</a>!';
	else {
		echo '<table>';
		
		//Nest loop is bad, but not sure if there would be a better solution. Will try to improve this in the future.
		foreach ($cart as $key => $item) {
			foreach($products as $product) {
				if ($key == $product->product_id) {
					echo '<tr>';
					echo '<td>';
					echo $product->name;
					echo '</td>';
					echo '<td style="text-align: center">';
					echo 'Amount: <form action="" method="post" onsubmit="return validation.isNumber('.$idcount.')"><input id="'.$idcount++.'" type="number" name="update" value="'. $item['qty'] .'"><input type="hidden" name="update_product" value="'. $key .'"><input type="submit" value="Update" class="btn update"></form>';
					echo '</td>';
					echo '<td>';
					echo 'Price: $'. number_format((double) ($item['qty'] * $product->price)/100, 2, '.', '') .'';
					echo '</td>';
					echo '<td>';
					echo '<form action="" method="post"><button type="submit" name="remove" value="'. $key .'" class="btn remove">Remove</button></form>';
					echo '</td>';
					echo '</tr>';
					
					$totalCart = $totalCart + ($item['qty'] * $product->price);
				}
			}
		}
		echo '</table>';
	}
}
?>