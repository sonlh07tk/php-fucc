
<?php 
    include ("DBCon.php");
    include("peanAccount.php");
    if ($_tmpLogin == 'NO') {
        echo "Not login yet";
        exit;
    }
    
    $_canView = False;

    if ($_tmpAdmin != 'NO') $_canView = True;

    $id = -1;

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (isset($_GET["id"])) $id = $_GET["id"];
    }

    if (checkExistSubmission($id)) {
            if (checkOwnerSubmission($id, $_tmpLogin)) $_canView = True;
    }
    else
        $_canView = False;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- code forces -->
      <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/gollum.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/editor.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/dialog.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/template.css" media="all">
  <link rel="stylesheet" type="text/css" href="http://vnoi.info/wiki/css/print.css" media="print">
 
  <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>


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
                                

                                <h2 class="title">  View source
                                    
                                </h2>
                            </div>

                            <div class="content" style="overflow-x: auto;">
                            <?php if ($_canView) { ?>
                           <table id="tableData" class="table table-striped table-bordered">
                          
                  <thead >
                    <tr>
                      <th style="text-align: center;">#</th>
                      <th style="text-align: center;">Time</th>
                       <th style="text-align: center;">Author</th>
                      <th style="text-align: center;">Problem</th>
                      <th style="text-align: center;">Language</th>
                      <th style="text-align: center;">Verdict</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $_row = getSubFile($id);
                            $stt = $_row['judgeState'];
                            $_prob = getSingleProblem($_row['problemID']);

                            include("rankingJudge.php");
                            $_userInfo = getSingleUser($_row['username']);
                            $col = judge($_userInfo["point"])
                        ?>

                        <tr>
                            <td style="text-align: center;"> <?php echo $_row['subID'] ?></td>
                            <td style="text-align: center;"><?php 
                                    $ts = explode(" ", $_row["timeSub"]);  
                                    echo $ts[0]."<br>".$ts[1];
                                ?>  </td>
                            
                            <td style="text-align: center;"><a href="view.php?user=<?php echo $_row['username']?>"> 
                                <strong><font color="<?php echo $col ?>">
                                    <?php echo getfullname($_row['username']) ?> 
                                </font></strong>
                                </a> </td>

                            <td style="text-align: center;"> 
                                <a href="showproblems.php?proID=<?php echo $_row['problemID']?>"> 
                                    <?php echo $_prob['problemName']?> </a> 
                            </td>
                            <td style="text-align: center;"> <?php echo strtoupper($_row['lang']) ?> </td>
                            <td style="text-align: center;"> 

                                <?php if ($stt == 1) { ?> <span class="label label-default">Waiting</span> <?php } ?>

                                <?php if ($stt == 2) { ?> <span class="label label-success">Accept</span> <?php } ?>

                                <?php if ($stt == 5) { ?> <span class="label label-danger">Reject</span> <?php } ?>

                                <?php if ($stt == 4) { ?> <span class="label label-danger">Run-error</span> <?php } ?>

                                <?php if ($stt == 3) { ?> <span class="label label-warning">Wrong Answer</span>  <?php } ?>
                            </td>
                            
                        </tr>

                  </tbody>
                </table>
                <?php } ?>

                <div class="row">
                <div class="col-md-9"><div class="dataTables_info" id="example_info" role="status" aria-live="polite"></div>
                </div>
            </div>
            </div>
            

                            <div class="content">
                                <div class="text-justify">
                                     <?php if ($_canView) { ?>
                                     <pre class="prettyprint lang-cpp program-source" style="padding: 0.5em;"><?php echo htmlentities($_row['attFile']); ?></pre>
                                    <?php } else { ?>
                                        <span>Submission is not exists...</span>
                                    <?php } ?>
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
