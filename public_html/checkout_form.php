<?php
require_once('db_products.php');

if(!empty($_POST['fname']) || !empty($_POST['lname'])  || !empty($_POST['address'])  || !empty($_POST['phone'])  || !empty($_POST['email'])) {
	
	if (validate()) {
		addOrders();
		header('Location: thankyou.html');
	}
		
}

function validate() {
	if (!validateAlpha($_POST['fname'])) {
		echo '<script type="text/javascript">alert("Not a valid firstname!")</script>';
		return false;
	}
	if (!validateAlpha($_POST['lname'])) {
		echo '<script type="text/javascript">alert("Not a valid lastname!")</script>';
		return false;
	}
	if (!validateAlphaNumeric($_POST['address'])) {
		echo '<script type="text/javascript">alert("Not a valid address!")</script>';
		return false;
	}
	if (!validatePhone($_POST['phone'])) {
		echo '<script type="text/javascript">alert("Not a valid phone number, use ###-###-####!")</script>';
		return false;
	}
	if (!validateEmail($_POST['email'])) {
		echo '<script type="text/javascript">alert("Not a valid email!")</script>';
		return false;
	}
		
	return true;
}

function addOrders() {
	global $products;
	global $conn;
	global $cart;
	
	$login = $conn->query("SELECT newCustomer('".$_POST['fname']."', '".$_POST['lname']."', '".$_POST['address']."', ".$_POST['phone'].", '".$_POST['email']."')");
	
	$login_result = mysqli_fetch_array($login);
	
	$receipt = $conn->query("SELECT newReceipt(".$login_result[0].", NOW())");
	
	$receipt_result = mysqli_fetch_array($receipt);

	foreach ($cart as $key => $item) {
		foreach($products as $product) {
			if ($key == $product->product_id) {
				$purchase = $conn->query("CALL newPurchase(".$receipt_result[0].", ".$product->product_id.", ".$item['qty'].")");
			}
		}
	}
}
?>