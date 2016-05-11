<!DOCTYPE html>
<html lang="en-US">
<head>
	<link rel="stylesheet" href="css/adm-style.css">
    
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Administrator Login</title>
    <link rel="icon" type="image/ico" href="admin/img/favicon.ico">
</head>

<body>
	<div id="wrapper" class="login">
        <div id="login">
        	<?php
			include('login.php');
			?>
            <form action="" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value=""></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" value=""></td>
                </tr>
            </table>
            <input type="submit" value="Login" class="btn login">
            </form>
        </div>
    </div>
</body>
</html>