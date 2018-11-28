<?php
	include('peanAccount.php');
	include('DBCon.php');
	include ('rankingJudge.php');
	
	if ($_tmpLogin == 'NO') {
		exit;
	}
	
	// check change password
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
   		$_user = $_tmpLogin;
		$_pass = $_POST["oldPass"];
		if (checkLogin($_user, $_pass)) {
			$pat = '/^[a-zA-Z0-9_]{4,}$/';
			$_newpass = $_POST['newPass'];
			$_conpass = $_POST['conPass'];
			if (strlen($_newpass) < 4 || strlen($_newpass) > 20) {
				$err = 'Password length must be in range 4 - 20';
			}
			else {
				
				if (!preg_match($pat, $_newpass, $mat))
					$err = "Password contains only letter, number and underscore.";
				
				else
					if (strcmp($_newpass, $_conpass) != 0) 
						$err = "New password and confirm is not matches."; 
					
					else {
						$scc = 'Success';
						changePass($_user, $_newpass);
					}
			}
		}
		else {
			$err = "Password is not correct.";
		}
	}
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/bootstrap.css" rel="stylesheet">
<title> Profile </title>
</head>
<body>
	<?php 
		include('naviga.php');	
	?>
    
  
  

    <div class="container">
    	<div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center"> 
      		Profile
      	</h1>
        
    	</div>
  		</div>
  		<hr>
  
    
    	<div class="row">
    <div class="text-justify col-sm-3">  
    	<img src="img/acc.jpg" width="250px" height="250px"/>
    </div>
    <?php $allInfo = getSingleUser($_tmpLogin); ?>
    
    <div class="col-sm-9 text-justify"> 
    	<font color="<?php echo judge($allInfo['point']) ?>">
        <h2> <?php echo $allInfo['fullname'] ?> </h2>
        </font>
        
        <h4> @<?php echo $_tmpLogin ?></h4>
        <table style="font-size:16px;">
         <tr> <td> <strong>  <img src="img/rank.PNG"  width="25" height="25"/> Rank  </strong> </td> <td style="padding-left:100px">  <a href="ranking.php"> #<?php echo countRank($_tmpLogin) ?>  </a> (<?php echo $allInfo['point'] ?> points) </td> </tr>
         
        <tr> <td> <strong> <img src="img/solved.PNG" width="25" height="25"/> Problems solved  </strong> </td> <td style="padding-left:100px"> <?php echo countSolveProUser($_tmpLogin) ?> </td> </tr>
            
      	<tr> <td> <strong>  <img src="img/sub.PNG" width="25" height="25" /> Solutions submitted  </strong> </td> <td style="padding-left:100px"> <?php echo countSubmitUser($_tmpLogin) ?> </td> </tr>
            
        <tr> <td> <strong>  <img src="img/int.PNG"  width="25" height="25"/> Institution  </strong> </td> <td style="padding-left:100px"> FPT University </td> </tr>
                   


        </table>
    </div>
    
    <div class="col-sm-12 text-justify"> 
    	<hr>
    	<strong>
        <h3> Change password </h3>
        </strong>
        <form class="navbar-form navbar-left" role="search"  method="post">
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Old password" name="oldPass" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="New password" name="newPass" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Confirm password" name="conPass" required>
        </div>
        <button type="submit" class="btn btn-success"> Submit </button>
      </form>
      
    </div>
    <?php if (isset($err)) { ?>
    <div class="col-sm-12 text-justify">
    	<font color = "red" > <?php echo $err ?> </font>
    </div>
    <?php } ?>
    
    <?php if (isset($scc)) {?>
    <div class="col-sm-12 text-justify">
    	<font color="green" > &#10003; Successful change </font>
    </div>
    <?php } ?>
    
  </div>
  
    </div>
</body>
</html>