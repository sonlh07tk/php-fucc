<?php
	include("peanAccount.php");
	include ("DBCon.php");
	
	if ($_tmpAdmin == "NO") {
		echo "Not permission yet.";
		exit;
	}
		
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$_proName = $_POST['txtProName'];
		$_proCont = $_POST['ten'];
		$_proScore = $_POST['txtScore'];
		
		
		addNewProblem($_tmpLogin, $_proName, $_proCont, $_proScore);
		header("location: problemset.php");
		
	}
?>

<!doctype html>
<html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Create new problem </title>
<link href="css/bootstrap.css" rel="stylesheet">
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
</head>

<body>
	<!-- navi bar -->
   	<?php include("naviga.php"); ?>
    <!-- end navi bar-->
    
    <div class="container">
  	<div class="row text-center">
    <div class="col-sm-12 text-justify">
  	  	
  		<h1> Create new problem </h1>
    
		<form method="post">
       	<strong> Name  </strong> <input style="margin-bottom:10px" type="text" name="txtProName" required> </br>
       	<strong> Score </strong> <input style="margin-bottom:10px" type="text" name="txtScore" required> </br>

      	<textarea  name="ten" id="ten"> </textarea>
      	<script>CKEDITOR.replace('ten');</script>
      	<input class="btn-success" style="margin-top:10px" type="submit" name="bnAction" value="Create"/>
   		</form>          
    </div>
  	</div>
  </div>
	
   
</body>
</html>