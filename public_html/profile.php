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
        
        if (isset($_pass) && strlen($_pass) > 0) {

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

        $_aboutInfo = $_POST['about'];
        if (isset($_aboutInfo) && strlen($_aboutInfo) > 0) {
            updateAbout($_tmpLogin, $_aboutInfo);
        }

        $_firstName = $_POST['firstname'];
        $_lastName = $_POST['lastname'];
        updateName($_tmpLogin, $_firstName, $_lastName);
        
        // email
        $email = $_POST["email"];
        updateEmail($_tmpLogin, $email);

    }

    $_userInfo = getSingleUser($_SESSION["login_user"]);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Train C PROBLEMSET</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
   <?php include('naviga_minhhy.php'); ?>
   
   

    <div class="main-panel">
        <nav class="navbar navbar-default">

            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">PROFILE</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="submissions.php">
                                <i class="ti-export"></i>
                                <p>Submissons</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-settings"></i>
                                <p>Account</p>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="logout.php">Log out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/background.jpg"/>
                            </div>
                            <div class="content">
                                <div class="author">
                                    <img class="avatar border-white" src="assets/img/acc.jpg" alt="..."/>
                                    <h4 class="title"><?php echo $_userInfo['fullname'] ?><br/>
                                        <a href="status.php?user=<?php echo $_userInfo['username']?>">
                                            <small>@<?php echo $_userInfo['username']?></small>
                                        </a>
                                    </h4>
                                </div>
                                <p class="description text-center">
                                   <?php if (strlen($_userInfo['about']) > 0) { ?> "<?php echo $_userInfo['about'] ?>" <?php } ?> <br>

                                </p>
                            </div>
                            <hr>
                             <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>#<?php echo countRank($_tmpLogin) ?><br/>
                                            <small>Rank</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5><?php echo $_userInfo['point'] ?><br/>
                                            <small>Point</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo countSolveProUser($_tmpLogin) ?><br/>
                                            <small>Problems Solved</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo countSubmitUser($_tmpLogin) ?><br/>
                                            <small>Solutions Submitted</small>
                                        </h5>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Class</label>
                                                <input type="text" class="form-control border-input" disabled
                                                       value="<?php echo getClassName($_userInfo['class'])?>" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control border-input" disabled
                                                       value="<?php echo $_userInfo['username']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" class="form-control border-input"
                                                       placeholder="Email" name = "email" value="<?php echo $_userInfo['email'] ?>">
                                            </div>
                                             <div>
                                            <font color="red">
                                                <p> <?php if (isset($emailErr)) echo $emailErr ?> </p> 
                                            </font>
                                        </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control border-input"
                                                       placeholder="First Name" value="<?php echo $_userInfo['firstName']?>" required name = "firstname">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control border-input"
                                                       placeholder="Last Name" value="<?php echo $_userInfo['lastName']?>" name="lastname">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Old Password</label>
                                                <input type="password" class="form-control border-input"
                                                       placeholder="Old password" name="oldPass" \>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control border-input"
                                                       placeholder="New password" name="newPass" \>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control border-input"
                                                       placeholder="Confirm password" name="conPass" \>
                                            </div>
                                        </div>
                                        <div>
                                            <font color="red">
                                                <p> <?php if (isset($err)) echo $err ?> </p> 
                                            </font>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control border-input"
                                                          placeholder="Here can be your description"
                                                          name = "about"><?php echo $_userInfo['about'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Update Profile
                                        </button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

</html>
