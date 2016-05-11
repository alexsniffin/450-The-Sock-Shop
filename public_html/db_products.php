<?php // Everything about products is in here
	require_once('db.php');
	
	$result = $conn->query("SELECT product_id, name, price, image_url, quantity, description FROM Product");

	$products = array();
	
	while($row = $result->fetch_object()) $products[] = $row;
	
	function product_list() {
		global $products;
		global $result;
		
		if ($result->num_rows > 0) {
			print "<table>";
			foreach($products as $product) {
				print "<th><form action='' method='post'><img src='img/".$product->image_url."' class='item_picture' alt='".$product->description."' /><div class='space'><h1>".$product->name."</h1>$".number_format($product->price/100, 2, '.', '')."<button type='submit' name='product' value='".$product->product_id."' class='btn add'>Add to Cart</button></div></form></th>";
			}
			print "</table>";
		} else {
    		echo "0 results found...";
		}
	}
	
	function popular_list() {
		global $products;
		global $result;
		
		if ($result->num_rows > 0) {
			print "<table>";
			foreach($products as $product) {
				print "<th><form action='' method='post'><img src='img/".$product->image_url."' class='item_picture' alt='".$product->description."' /><div class='space'><h1>".$product->name."</h1>$".number_format($product->price/100, 2, '.', '')."<button type='submit' name='product' value='".$product->product_id."' class='btn add'>Add to Cart</button></div></form></th>";
			}
			print "</table>";
		} else {
    		echo "0 results found...";
		}
	}
?>