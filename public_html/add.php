
<?php 
    include("peanAccount.php");
    include ("DBCon.php");

    $_current_batch = 14;

    if ($_tmpAdmin == "NO") {
        echo "Not permission yet.";
        exit;
    }
        
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $_proName = $_POST['txtProName'];
        $_proCont = $_POST['ten'];
        $_proScore = $_POST['txtScore'];
        

        addNewProblemWithBatch($_tmpLogin, $_proName, $_proCont, $_proScore, $_current_batch);
        header("location: problemset.php");
        
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- code forces -->
    <link href="css/bootstrap.css" rel="stylesheet">
<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>

      <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/gollum.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/editor.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/dialog.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/template.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/print.css" media="print">
 
  <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>

    <link rel="stylesheet" href="styles/default.css"/>
    <script src="highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <style>
        pre, code {
            white-space: pre-wrap;
            tab-size: 2;
        }
        code {
            display: block;
        }
    </style>

    <!-- end -->
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
    <script>
        var x = document.getElementById("x4");
        x.className += " active";
    </script>

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
                    <a class="navbar-brand" href="#"> ADD EXERCISE </a>
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
                                
                            </div>

                            <div class="content" style="overflow-x: auto;">
                                <form method="post">
                                    <div class="col-md-6">
                                    <label> Name  </label> <input style="margin-bottom:10px" type="text" name="txtProName" required class = "form-control border-input"> 
                                    </div>
                                   
                                     <div class="col-md-6">
                                    <label> Score </label> <input style="margin-bottom:10px" type="text" name="txtScore" required class = "form-control border-input"> 
                                    </div>

                                    <div>
                                    <textarea  name="ten" id="ten"> </textarea>
                                    <script>CKEDITOR.replace('ten');</script>
                                    </div>

                                    <input class="btn btn-info btn-fill btn-wd" style="margin-top:10px" type="submit" name="bnAction" value="Create"/>
                                </form> 
                            </div>
            

                            <div class="content">
                                <div class="text-justify">
                                     

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
