<?php
    include('peanAccount.php');
    include('DBCon.php');
    include ('rankingJudge.php');
    
    if ($_tmpLogin == 'NO') {
        exit;
    }

    // check change password
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        
        if (isset($_GET["user"]) && checkExistUser($_GET["user"])) $_viewUser = $_GET["user"];
        else
            $_viewUser = $_tmpLogin;
    }

    
    $_userInfo = getSingleUser($_viewUser);

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
                                    <img class="avatar border-white" <?php if ($_userInfo['username'] != 'sonlh') { ?>
                                src="assets/img/background.jpg"
                                <?php } else { ?>
                                src = "assets/img/acc.jpg"
                                <?php } ?> alt="..."/>
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
                                        <h5>#<?php echo countRank($_viewUser) ?><br/>
                                            <small>Rank</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5><?php echo $_userInfo['point'] ?><br/>
                                            <small>Point</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo countSolveProUser($_viewUser) ?><br/>
                                            <small>Problems Solved</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><?php echo countSubmitUser($_viewUser) ?><br/>
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
                                <strong><h4 style = "text-align: center;" class="title">BADGES</h4></strong>
                            </div>
                            <div class="content">

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
