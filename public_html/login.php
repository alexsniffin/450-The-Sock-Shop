<?php
	require('db.php');
	
	session_start();
	
	if (!empty($_SESSION['logged_in']) && $_SESSION['logged_in']) // $_SESSION won't be evaluated unless the first condition is met
		header('Location: admin/index.php');
	
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		authenticate($_POST['username'], $_POST['password']);
	}
	
	function authenticate($username, $password) {
		global $conn;
		
		$stmt = $conn->prepare("SELECT username FROM Administrator WHERE username = ? AND password = ?");
		
		if ($stmt) {
			$stmt->bind_param('ss', $_POST['username'], $_POST['password']);
			$stmt->execute();
			$stmt->bind_result($name);
			if($stmt->fetch()) {
				$_SESSION['logged_in'] = true;
				$_SESSION['name'] = $name;
				$_SESSION['timeout'] = time();
				header('Location: admin/index.php');
			} else {
				echo '<div id="wrong">Wrong Username or Password!</div>';
			}
		}
	}
?>