<?php
    
    include("peanAccount.php");
    include("DBCon.php");
    
    if ($_tmpLogin == 'NO') {
        echo "Not login yet.";
        exit;
    }
    $proID = 0;
    $proName = "";
    $username = "";
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['proID'])) $proID = $_GET['proID']; 
        if (isset($_GET['proName'])) $proName = $_GET['proName'];
    }
    
    if (isset($_SESSION["login_user"])) {
        $username = $_SESSION["login_user"];
    }
    
    // back to problems Page
    if (isset($_POST['backBut'])) {
        
        $proID = $_POST['saveID'];
        $url = "showproblems.php?proID=".$proID;
        
        header("location: $url");
    }
    // upload File
    
    if(isset($_POST['upload']) && $_FILES['subFile']['size'] > 0)
    {
        
        if (isset($_POST['saveID'])) $proID = $_POST['saveID'];

        $fileName = $_FILES['subFile']['name'];
        $tmpName  = $_FILES['subFile']['tmp_name'];
        $fileSize = $_FILES['subFile']['size'];
        
        
        // read content
        $fp      = fopen($tmpName, 'r');
        $content = fread($fp, filesize($tmpName));
        $content = addslashes($content);
        fclose($fp);

        // check file valid
         $breakName = explode(".", $fileName);
         $fileType = array_pop($breakName);
         
         if (strcmp($fileType, "java") != 0  && strcmp($fileType, "c") != 0) 
            {
                $errors = "Please choose a C or JAVA file.";
                
            }
         else 
         if ($fileSize > 2000000) { // 2MB
            $errors = "File is too large. Maximum size of file allowed is 2MB";
         }
         else
         if (countSubmitProUser($username, $proID) >= getLimitSubmit($proID)) {
            $errors = "Maximum submission allowed in this problem is ".getLimitSubmit($proID)."."; 
         }
         else {
            // insert submission to DB
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $today = date("Y-m-d H:i:s"); 
            $rs = addSubmit($username, $proID, $content, $today,$fileType);
            
            if (isset($rs)) 
                $notify = "✓ Submission recieve with ID  ".$rs;
            else
                $errors = "Some error occurs when submit. Please try again";    
          }
    }
    
    if (isset($_POST['upload']) && $_FILES['subFile']['size'] == 0) {
        $errors = "Empty file.";
    }
    
    if (isset($_POST['saveID'])) $proID = $_POST['saveID'];
    if (isset($_POST['saveName'])) $proName = $_POST['saveName'];

    if (checkProblem($proID) == false) {
        echo "Problem is not exist";
        exit;
    }
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
                    <a class="navbar-brand" href="#">SUBMIT CODE</a>
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
                                <h4 class="title">Problem <?php echo $proID." - ".$proName ?> </h4>
                                <p class="category">Username: <?php echo $username ?> </p>
                            </div>
                            <div class="content" >
                                <form method="post" enctype="multipart/form-data">
                                <input name="subFile" type="file" id="subFile" style="padding: 1%;">

                                <?php 
                                if (isset($errors)) {
                                ?>
                                <font color="red"> <?php echo $errors ?> </font> </br>
                            <?php           
                            }
                        ?>
            
                    <?php 
                        if (isset($notify)) {
                            ?>
                            <font color="green"> <?php echo $notify ?> </font> </br>
                        <?php           
                        }
                    ?>
                                <input name="saveID" type="hidden" value="<?php echo $proID ?>" />
                                <input name="saveName" type="hidden" value="<?php echo $proName ?>" />
            
                                <div class="row" style="padding-left: 2%; padding-top:1%;padding-bottom: 1%; ">
                                    <button class="btn btn-danger" name="backBut" >Back To Problem</button>
                                    <button class="btn btn-success" name="upload">Submit</button>
                                </div>
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
