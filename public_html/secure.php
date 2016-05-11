<?php // the secure.php script
	session_start(); // Won't hurt if it is already started
	
	if (empty($_SESSION['logged_in'])) // Default to NOT logged in
		$_SESSION['logged_in'] = false;
		
	if (!empty($_POST['user']) && !empty($_POST['pass'])) {
		// We will assume that the login function returns
		// true if the user's login is valid.
		if(authenticate($_POST['user'], $_POST['pass']))
			$_SESSION['logged_in'] = true;
	}
	
	if (!$_SESSION['logged_in'] || ($_SESSION['timeout'] + 360 * 60) < time()) {
		session_destroy();
		header('Location: ../admin.php');
		die("<html><head>
		<meta http-equiv='refresh' content='0;../admin.php'>
		<script language='javascript'>
		window.location = '../admin.php';
		</script></head>
		<body><a href='../admin.php'>Click Here</a></body>
		</html>");
}
?>