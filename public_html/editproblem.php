<?php
	include("peanAccount.php");
	include ("DBCon.php");
	
	$_proID = 0;
	
	if ($_tmpAdmin == "NO") {
		echo "Not permission yet.";
		exit;
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_GET['proID'])) $_proID = $_GET['proID'];
		if (checkProblem($_proID) == false) {
			echo "Problem is not exist";
			exit;
		}
	}
	
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$_proName = $_POST['txtProName'];
		$_proCont = $_POST['ten'];
		$_proScore = $_POST['txtScore'];
		
		
		updateProblem($_POST['hideID'], $_proName, $_proCont, $_proScore);
		$_newLoc = "showproblems.php?proID=".$_POST['hideID'];	
		header("location: $_newLoc");
	}
	
?>

<!doctype html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Edit problem </title>
<link href="css/bootstrap.css" rel="stylesheet">
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
</head>

<body>
	<!-- navi bar -->
   	<?php include("naviga.php"); ?>
    <!-- end navi bar-->
    
    
    <?php 
		$_data = getSingleProblem($_proID);
	?>
    
    <div class="container">
  	<div class="row text-center">
    <div class="col-sm-12 text-justify">
  	  	
  		<h1> Edit problems </h1>
    
		<form method="post">
        <h3 style="margin-bottom:10px"> <strong> Problem ID: <?php echo $_proID." ".$_data['problemName'] ?> </strong> </br> </h3>

       	<strong> New Name  </strong> <input style="margin-bottom:10px" type="text" name="txtProName" required value="<?php echo $_data["problemName"] ?>"> </br>
       	<strong> New Score </strong> <input style="margin-bottom:10px" type="text" name="txtScore" required value="<?php echo $_data['point'] ?>"> </br>

      	<textarea  name="ten" id="ten" > <?php echo $_data['statement'] ?> </textarea>
      	<script>CKEDITOR.replace('ten');</script>
        <input type="hidden" name="hideID" value="<?php echo $_proID ?>" />
        
      	<input class="btn-success" style="margin-top:10px" type="submit" name="bnAction" value="Save"/>
   		</form>          
    </div>
  	</div>
  </div>
	
   
</body>
</html>