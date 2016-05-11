<?php
	include('cart.php');
	include('checkout_form.php');
	
	if(empty($_COOKIE['cart'])) 
		setcookie('cart', json_encode($cart, true), time() + (86400 * 30));
?>

<!-- Javascript and PHP Validation for email, will add in more when I get the time... -->
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Please enter your information...</title>
        
        <script src="js/js.validate.js"></script>
    </head>

    <body>
    	<form id='info_form' method='post' action='' onSubmit="return validation.isEmail()">
           <p>
           		First name: * <input type='text' name='fname' required>
           </p>
           <p>
           		Last name: * <input type='text' name='lname' required>
           </p>
           <p>
           		Address: * <input type='text' name='address' required>
           </p>
           <p>
           		Phone: * <input type='text' name='phone' placeholder='(###)-###-####' required>
           </p>
           <p>
           		Email: * <input type='text' name='email' required>
           </p>
           <p>
           <input type='submit' name='submit' value='Submit' />
           </p>
        </form>
    </body>
</html>
