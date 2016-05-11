<?php
require_once('db_products.php');
include('cart.php');

if(empty($_COOKIE['cart'])) 
	setcookie('cart', json_encode($cart, true), time() + (86400 * 30));
?>

<!DOCTYPE html>
<html lang="en-US">

<!-- Head information -->
<head>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/jquery.excoloSlider.css">
    
    <noscript>
        <link rel="stylesheet" href="css/mobile.min.css" />
    </noscript>   
     
	<link rel="icon" type="image/ico" href="img/favicon.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="Sock Shop Charleston SC South Carolina Socks Feet">
	<meta name="description" content="The Sock Shop on the upscale Market Street in Charleston, SC.">
	<meta name="author" content="Alexander Sniffin">
	<meta charset="UTF-8">
    
	<title>The Sock Shop - Home</title>
    
    <script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery.excoloSlider.min.js"></script>
    <script src="js/jquery.excoloSlider.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/js.validate.js"></script>
    
    <script>
        $(function() {
            $("#slider").excoloSlider({
				interval: 3500,
				autoSize: true
			});
        });
		
		function updateCart() {
			if ($(window).width() < 600) {
				$('.lightbox_content table').css({'zoom': ($(window).width()/650), '-moz-transform': ($(window).width()/650)});
				$('#footer').css({'zoom': '0.60', '-moz-transform': 'scale(0.60)'});
			} else {
				$('.lightbox_content table').css({'zoom': '1.0', '-moz-transform': 'scale(1.0)'});
				$('#footer').css({'zoom': '1.0', '-moz-transform': 'scale(1.0)'});
			}
		}
		
		$(document).ready(function() {
			updateCart();
		});
		
		$(window).resize(function() {
			updateCart();
		});
    </script>
</head>

<body>

<div class="backdrop"></div>
<div class="lightbox_content about">
	<div class="lightbox_close"><img src="img/closeicon.png" alt="Close About" /></div>
    <div class="lightbox_info">
        <img src="img/logo.jpg" class="lightbox_logo" alt="The Sock Shop Banner">
        <p>
			<?php readfile('content/about.txt'); ?>
        </p>
    </div>
</div>

<div class="lightbox_content cart">
	<div class="lightbox_close"><img src="img/closeicon.png" alt="Close About" /></div>
    <div class="lightbox_info">
    	<h1>
        Shopping Cart 
        (<?php 
        	echo (count($cart) > '0') ? count($cart) : '0';
        ?> items added)
		</h1>
        
		<div class="textwrapper cart">
			<?php showCart($cart); ?>
		</div>
        
        <div class="checkout">
        	<form action="checkout.php" method="post">
            <p>Your total price is: $<?php echo number_format($totalCart/100, 2, '.', '') ?></p>
            	<button type="submit" name="finish" value="checkout" class="btn checkout">Checkout</button>
            </form>
        </div>
    </div>
</div>

<div id="wrapper">

    <div id="account-header">
    	<a href="#" class="lightbox cart">
            <div class="bag">
                (
                  <?php 
                    echo (count($cart) > '0') ? count($cart) : '0';
                  ?>
                )
            </div>
        </a>
    </div>
    
    <div id="header">
        <a href="index.php"><img src="img/logo_2.png" class="logo" alt="The Sock Shop Banner"></a>
    </div>
    
    <div id="content-wrapper">
    
        <div id="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php" class="acurrent">Shop</a></li>
                <li><a href="#" class="lightbox about">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            
        </div>
    
        <div id="content">
            
            <div class="trending">
            	<h2>Socks</h2>
                <?php product_list(); ?>
            </div>
            
        </div>
    
        <div id="footer">
        
            <div class="column">
                <h1>Need Assistance</h1>
                <ul>
                    <li><a href="#">FAQS</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Customer Service</a></li>
                </ul>
            </div>
            
            <div class="column">
                <h1>About Us</h1>
                <ul>
                    <li><a href="#" class="lightbox about">About</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Safety</a></li>
                    <li><a href="#">Product Materials</a></li>
                </ul>
            </div>
           
            <div id="media">
                <img src="img/fb.png" class="social" />
                <img src="img/pin.png" class="social" />
                <img src="img/tw.png" class="social" />
                <img src="img/yt.png" class="social" />
            </div>
            
        </div>
        
    </div>
    
</div>

</body>

</html>