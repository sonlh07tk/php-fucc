<?php 
exit;
	include('DBCon.php');
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_GET['username'])) {
			$username = $_GET['username'];
			$pass = $_GET['password'];
			$name = $_GET['name'];;
			$role = 0; //$_GET['role'];
addNewAccount($username, $pass, $name, $role);
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
	<form >
    	<input type="text" name="username" placeholder="Username"/> </br>
        <input type="text" name="password" placeholder="Password"/> </br>
        <input type="text" name="name" placeholder="Fullname"/> </br>
        <input type="text" name="role" placeholder="Role (0 or 1)"/> </br>
        <input type="submit" name="bnAction" />
    </form>
<body>
</body>
</html>				