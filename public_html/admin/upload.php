<?php
require_once('../db.php');

//File that will be uploaded
if (!empty($_FILES["fileToUpload"])) {
	$target_dir = "../img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
}
//Check if image is valid and then upload it into the database
if(!empty($_POST["add_product"])) {
	$output = "";
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
	
	if (file_exists($target_file)) {
    	$output .= "Sorry, image file already exists. ";
    	$uploadOk = 0;
	}
	
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		$output .= "Sorry, your image file is too large, limit is 5000kb. ";
		$uploadOk = 0;
	}
	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		$output .= "Sorry, only JPG, JPEG, and PNG files are allowed. ";
		$uploadOk = 0;
	}
	
	if ($uploadOk == 0) {
		$output .= "Your product was not uploaded, try again.";
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$sql = $conn->query("INSERT INTO Product VALUES (NULL, '" . $_POST['name'] . "', '" . $_POST['price'] . "', '" . $_FILES['fileToUpload']['name'] . "', '" . $_POST['quantity'] . "', '" . $_POST['description'] . "')");
			
			if ($sql !== true) {
				unlink($target_file);
				$output = "Error inserting product into database, please try again. " . $_POST['name'] . ", " . $_POST['price'] . ", " . $_POST['quantity'] . ", " . $_FILES['fileToUpload']['name'] . ", " . $_POST['description'];
			} else {
				$output = "Product has successfully been added into the database.";
			}
		} else {
			$output = "Sorry, there was an error uploading your image, product not submitted.";
		}
	}
}
?>