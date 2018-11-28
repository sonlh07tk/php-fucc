<?php
	include("peanAccount.php");
	include("DBCon.php");
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$_canDown = false;
		if ($_tmpAdmin != 'NO') $_canDown = true;
	
	
		if (isset($_GET['downloadSubID']))
			$_user = getUserIDbySub($_GET['downloadSubID']);
		
		
		if (isset($_user))
			if ($_user == $_tmpLogin) $_canDown = true;
	
		if ($_canDown == false) exit;
	}
	
	if(isset($_GET['downloadSubID'])) 
	{
		
		$id = $_GET['downloadSubID'];
		
		$row = getSubFile($id);	
		$content = $row["attFile"];
		
		$pro = getSingleProblem($row['problemID']);
		
		$name = $pro['problemName']."_".getFullName($row['username'])."_".$id.".".$row["lang"];
		//echo $type;
		header("Content-Disposition: attachment; filename=$name");	
		
		echo $content;
		exit;
	} 
?>