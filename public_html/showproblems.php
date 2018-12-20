
<?php 
    include ("DBCon.php");
    include("peanAccount.php");
    if ($_tmpLogin == 'NO') {
        echo "Not login yet";
        exit;
    }
    $proID = 1;
    
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET["proID"])) $proID = $_GET["proID"];
    }

    $_current_batch = 14;
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
    <!-- Bootstrap for showing table -->
    <link rel="stylesheet" type="text/css" href="assets/css/site-examples.css">
    <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
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
    
    <?php include('naviga_minhhy.php') ?>

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
                    <a class="navbar-brand" href="#">SHOW PROBLEM</a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <?php

                                if (checkProblem($proID) == false) {
                                    echo "Problem is not exist.<br><br>";
                                    exit;
                                }

                                    $_data = getSingleProblem($proID);

                                if ($_data['batch'] != $_current_batch) {
                                    echo "Problem is not available.<br><br>";
                                    exit;
                                }
                                ?>

                                <h2 class="title">Problem <?php echo $_data["problemID"]?>: <?php echo $_data["problemName"]?>
                                    
                                    <?php if ($_tmpAdmin == "YES") { ?>
                                     <form  action="edit.php"> <button class="btn btn-info">Edit</button>
                                        <input type="hidden" name="proID" value="<?php echo $_data['problemID']?>"/>

                                     </form>
                                    <?php } ?>

                                    
                                    
                                </h2>
                                <div class="content" style="text-align: center;">

                                    <a href=""status.php?proID=<?php echo $_data['problemID']?>"" class="btn btn-primary btn-lg active" role="button">Status</a>


                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="solved.php?proID=<?php echo $_data['problemID']?>"> Ranking </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="submissions.php?proID=<?php echo $_data['problemID']?>"> My submissions</a>
                                </div>
                            </div>
                            <div class="content">
                                <div class="text-justify">
                                    <?php echo $_data["statement"] ?> 
                                </div>
                                <br>
                                <div class = "text-justify">
                                    <font color="green"> Allow submissions remaining: <strong> <?php 
                                    echo max(0, (getLimitSubmit($proID)-countSubmitProUser($_tmpLogin, $proID))) ?>
                                    </strong></font>
                                </div>
                                <hr style="height:1px; background-color:gray;">

                                    <table>
                                        <tbody><tr> 

                                            

                                            <th style="width:100px"> Add by: </th> <td> <a href="view.php?user=<?php echo $_data["author"]?>">  <?php echo getFullName($_data["author"]) ?></a></td> </tr>
                                        <tr>  <th> Point: </th> <td> <strong> <font color="red"> <?php echo $_data["point"] ?> </font> </strong></td>   </tr>
                                        <tr> <th> Solved:  </th> <td>  <strong> <font color="blue"><a href="solved.php?proID=<?php echo $proID?>">   <?php echo $_data["solved"] ?> </a> </font></strong></td>  </tr>
                                        <tr> <th> Lang: </th> <td> C </td> </tr>
                                        <tr> <th> Size Limit: </th> <td> 2MB </td> </tr>
                                        <tr>  <th> Submit Limit: </th> <td> <strong> <font color="green"> <?php echo getLimitSubmit($proID)?></font> </strong></td>   </tr>
                                        </tbody></table>


                                <hr style="height:1px; background-color:gray;">
<div class="row text-center">
     <form action="submit.php">
     <input type="hidden" value="<?php echo $proID ?>" name="proID" />
     <input type="hidden" value="<?php echo $_data["problemName"] ?>" name = 'proName'/>

    <button class="btn btn-fill btn-danger">Submit Solutions</button>
</form>
</div>
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
