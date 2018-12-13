<?php 

	include('DBCon.php');



	/*
	 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_GET['username'])) {
			$username = $_GET['username'];
			$pass = $_GET['password'];
			$name = $_GET['name'];;
			$role = 0; //$_GET['role'];
            addNewAccount($username, $pass, $name, $role);
		}
	}
	*/

	//add batch account
    $accounts = array("se140823",
"se140867",
"se140827",
"se140867",
"se140736",
"se140125",
"se141031",
"se141009",
"se140830",
"se140831",
"se140556",
"se140954",
"se140372",
"se140092",
"se140205",
"se140260",
"se140297",
"se140868",
"se140848",
"se140737",
"se140910",
"se140919",
"se140745",
"se140286",
"se140809",
"se140196",
"se140956",
"se140647",
"se140775",
"se140832",
"se141088",
"se140784");

    foreach ($accounts as $acc) {
        addNewAccountWithBatch($acc, "abc", $acc, 0, 14);
        echo $acc;
    }

    exit;

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