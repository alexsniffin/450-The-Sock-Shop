<?php
include('panel.php');
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<link rel="stylesheet" href="../css/adm-style.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
    
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?php echo $_SESSION['name']; ?> - Administrator Panel</title>
    <link rel="icon" type="image/ico" href="../img/favicon.ico">
    
    <script src="../js/jquery-1.9.1.min.js"></script>
    <script src="../js/jquery.lightbox.js"></script>
</head>

<body>
    <div class="backdrop"></div>
    
	<div id="nav">
    	<div class="menu">
        	<ul>
            	<form action="" method="post">
            	<li class="logout">
                	<button type="submit" value="logout" name="logout" class="btn logout">
                    	<i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                    </button>
                </li>
                <li><button type="submit" value="orders" name="orders" class="btn menu">Orders</button></li>
                <li><button type="submit" value="add_products" name="add_products" class="btn menu">Add Product</button></li>
                <li><button type="submit" value="edit_products" name="edit_products" class="btn menu">Edit Products</button></li>
                </form>
            </ul>
        </div>
    </div>
    
	<div id="wrapper">
    	
		<div class="content">
        	<?php echo $output ?>
        </div>
    </div>
</body>
</html>