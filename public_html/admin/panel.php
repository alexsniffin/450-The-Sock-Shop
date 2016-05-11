<?php
require('../secure.php');
require('upload.php');
require_once('../db.php');

if ($_SESSION['logged_in']) {
	if (empty($output))
		$output = "";
		
	//Logout of session
	if (!empty($_POST['logout'])) {
		session_destroy();
		header('Location: ../index.php');
	//Dumps orders in a descending order, no limit is set, but could probably be added somewhat easily with pages
	} else if (!empty($_POST['orders'])) {	
		$orders = array();
		$receipt_result = $conn->query("SELECT * FROM Receipt ORDER BY time_ordered DESC");
		
		while ($row = $receipt_result->fetch_object()) { $orders[] = (array)$row; }
		
		foreach ($orders as &$receipt) {
			$customer_result = $conn->query("SELECT fname, lname, address, phone, email FROM Customer WHERE customer_id = " . $receipt['customer_id']);
			
			while ($row = $customer_result->fetch_object()) { 
				$receipt['customer_information'] = (array)$row;
			}

			$purchased_result = $conn->query("SELECT product_id, quantity FROM Purchased WHERE receipt_id = " . $receipt['receipt_id']);
			
			while ($row = $purchased_result->fetch_object()) { 
				$row = (array)$row;
				
				$product_result = $conn->query("SELECT name, price FROM Product WHERE product_id = " . $row['product_id']);
				while ($row2 = $product_result->fetch_object()) { 
					$row2 = (array)$row2;
					$row2['quantity'] = $row['quantity'];
					$receipt['products'][] = $row2;
				}
			}
		}
		
		//HTML in table format
		$output = 
		"<table>
			<tr>
				<th>Time</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Total Products</th>
				<th>Purchased (Name; Price/ea; Quantity)</th>
			</tr>";
		foreach ($orders as &$receipt) {
			if (!empty($receipt['products'])) {
				$output .= 
				"<tr>
					<td>" . $receipt['time_ordered'] . "</td>" . 
					"<td>" . $receipt['customer_information']['fname'] . "</td>" .
					"<td>" . $receipt['customer_information']['lname'] . "</td>" .
					"<td>" . $receipt['customer_information']['address'] . "</td>" .
					"<td>" . $receipt['customer_information']['phone'] . "</td>" .
					"<td>" . $receipt['customer_information']['email'] . "</td>" .
					"<td>" . count($receipt['products']) . "</td>" .
					"<td>";
					
				$total_amount = 0;
				foreach ($receipt['products'] as $product) {
					$total_amount += $product['quantity'] * $product['price'];
					$output .= 
						$product['name'] . "; " .	
						"$" . number_format((double) ($product['price'])/100, 2, '.', '') . "; " .
						$product['quantity'] . "<br />";
				}
				
				$output .= 
				"<br /><b>Total Amount = $" . number_format((double) ($total_amount)/100, 2, '.', '') . "</b></td>
				</tr>";
			}
		}
		$output .= "</table>";
	//Dumps all products with ability to edit or delete
	}  else if (!empty($_POST['edit_products'])) {
		$output = "";
	//Add a new product
	}  else if (!empty($_POST['add_products'])) {
		$output .= "
		<form method='post' enctype='multipart/form-data'>
			<table>
				<tr>
					<td>Name: *</td>
					<td><input type='text' name='name' id='fileToUpload' style='width: 100%;' required></td>
				</tr>
				<tr>
					<td>Description: *</td>
					<td><input type='text' name='description' id='fileToUpload' style='width: 100%;' required></td>
				</tr>
				<tr>
					<td>Price: *</td>
					<td><input type='number' name='price' id='fileToUpload' value='0' style='width: 100%;' required></td>
				</tr>
				<tr>
					<td>Initial Quantity: *</td>
					<td><input type='number' name='quantity' id='fileToUpload' style='width: 100%;' value='1' required></td>
				</tr>
			</table>
			Select image to upload:
    		<input type='file' name='fileToUpload' id='fileToUpload'><br /><br />
    		<button type='submit' value='Upload Product Listing' name='add_product' class='btn'>Upload Product Listing</button>
		</form>
		";
	} else if (empty($_FILES["fileToUpload"])) {
		$output = "Welcome to your administration panel, from here you can edit your products and view all orders from most recent to oldest.";
	}
}

?>