<?php
	
	include("peanAccount.php");
	include("DBCon.php");
	include ("rankingJudge.php");
	
	$_chk = true;
	if (isset($_tmpLogin)) {
		if ($_tmpLogin == 'NO') $_chk = false;
	}
	else
		$_chk = false;
	
	if ($_chk == false) {
		echo "Not login yet.";	
		exit;
	}	
?>

<!doctype html>
<html>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title> My submissions </title>
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<!-- Bootstrap for showing table --> 
	<link rel="stylesheet" type="text/css" href="table_css/site-examples.css">
	<link rel="stylesheet" type="text/css" href="table_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="table_css/dataTables.bootstrap.min.css">
	<style type="text/css" class="init">
	</style>
	<script type="text/javascript" src="table_js/site.js">
	</script>
	<script type="text/javascript" language="javascript" src="table_js/jquery-1.12.3.js">
	</script>
	<script type="text/javascript" language="javascript" src="table_js/jquery.dataTables.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="table_js/dataTables.bootstrap.min.js">
	</script>
	<script type="text/javascript" language="javascript" src="table_js/demo.js">
	</script>
	<script type="text/javascript" class="init">
	$(document).ready(function() {
	$('#example').DataTable();
	} );

	</script>
  <!-- end of bootstrap -->
</head>
<body>
	 <!-- navi bar -->
      <?php  include("naviga.php"); ?>
    <!-- end navi bar-->
    
    <!-- Show last submission of user -->
    <div class="container">
			<h1 style="text-align:center"> <?php echo $_tmpLogin; ?>'s sumissions </h1>
            </br>
            
            <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    		<thead>
      		<tr>
        	<th> # </th>
            <th> When </th>
        	<th> Problem </th>
            <th> Lang </th>
            <th> Verdict </th>
      		</tr>
    		</thead>
    		<tbody>
      		<?php 
			
				 $rs = getSubmissionByUser($_tmpLogin);
				 if (isset($rs)) {
				 	$cnt = 0;
				 	foreach($rs as $row)
				 	{
						$stt = $row["judgeState"];
						
						$col = colorState($stt);
						$msg = stateString($stt);
						$msgID = normSubID($row["subID"]);
						$pro = getSingleProblem($row["problemID"]);

						?>
                    	<tr>
                        	<td> <a href="download.php?downloadSubID=<?php echo $row["subID"] ?>"> <?php echo $msgID ?> </a> </td>
            				<td> <?php echo $row["timeSub"] ?> </td>
<td> <a href="showProblems.php?proID=<?php echo $row['problemID']?>" > <?php echo $pro["problemName"] ?> </a> </td>
            				<td> <?php echo strtoupper($row["lang"]) ?> </td>
                    		<td> <font color="<?php echo $col ?>" <?php if ($stt == 2) { ?> style="font-weight:bold" <?php }?>> <?php echo $msg ?> </td> </font>
                        </tr>
						<?php
                	}		
				 }
			?>
    		</tbody>
  			</table>
			</div>
<hr>
<?php include('footer.php') ?>
            
</body>
</html>