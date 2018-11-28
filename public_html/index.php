<?php 

    include("peanAccount.php");
    include("DBCon.php");   

    if ($_tmpLogin != 'NO') {
        header("location: profile.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $_user = $_POST["username"];
        $_pass = $_POST["password"];

        // add log
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        addLog("".$_SERVER['REMOTE_ADDR'], date("Y-m-d H:i:s"), addslashes($_user." + ".$_pass)); 

        if (checkLogin($_user, $_pass)) {
            $_SESSION["login_user"] = $_user;
            if (checkAdmin($_user))
                $_SESSION["admin"] = "YES";
                else
                    $_SESSION["admin"] = "NO";
                    
            header("location: profile.php");
        }
        else {
            $err = "Username or password is not correct";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <title>Fcode Train C</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

   <body>

        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>Fcode Train C</strong></h1>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Username</label>
			                        	<input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn">Sign in!</button>
                                    <br> 
                                    <font color="red">
                                        <p><?php if (isset($err)) echo $err ?> </p> 
                                    </font>
			                    </form>
		                    </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
            

<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 356px; width: 1349px; z-index: -999999; position: fixed;"><img src="assets/img/backgrounds/1.jpg" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1349px; height: 899.333px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -271.667px;"></div>
</body>

</html>