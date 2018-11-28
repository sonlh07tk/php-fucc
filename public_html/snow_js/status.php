<?php 
    include ("DBCon.php");
    include ("rankingJudge.php");
    include("peanAccount.php");
    
    if ($_tmpLogin == 'NO') {
        exit;
    }

    $fill_stt = 0;
    $fill_username = "";
    $fill_problem = 0;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />

	<title>Train C PROBLEMSET</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
 <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
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

<style type="text/css">
    .paging-nav {
  text-align: right;
  padding-top: 2px;
  font-size: 22px;

}

.paging-nav a {
  margin: auto 1px;
  text-decoration: none;
  display: inline-block;
  padding: 7px 7px 7px 7px;
  background: white;
  color: #3174c7;
  border-radius: 3px;
  border: 1px solid rgb(221, 221, 221);
}

.paging-nav a:hover{
  background: rgb(221, 221, 221);
}



.paging-nav .selected-page {
  background: #187ed5;
  font-weight: bold;
  color: white;
}


</style>
<div class="wrapper">
    <?php include('naviga_minhhy.php'); ?>
    <script>
        var x = document.getElementById("x3");
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
                  <a class="navbar-brand" href="#">STATUS</a>
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
                                <h4 class="title">ALL LAST SUBMISSIONS</h4>
                               
                            </div>
                            <div class="content" style="overflow-x: auto;">
							
                           <table id="tableData" class="table table-striped table-bordered">
						  
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Time</th>
					   <th>Author</th>
                      <th>Problem</th>
                      <th>Language</th>
                      <th>Verdict</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                        $rs = fillSubmissions('%'.$fill_username.'%', $fill_problem, $fill_stt);
                 
                        if (isset($rs)) {
                            $dem = 0;                   
                            $cnt = 0;
                    
                        foreach($rs as $row) {
                                $dem++;
                                $stt = $row["judgeState"];
                        
                                $col = colorState($stt);
                                $msg = stateString($stt);
                                $msgID = normSubID($row["subID"]);
                                $pro = getSingleProblem($row["problemID"]);
                        ?>
                        
                        <tr>
                            <td>  
                                <?php if ($_tmpAdmin != 'NO' || checkOwnerSubmission($row["subID"],$_tmpLogin)) { ?>
                                <a href="showcode.php?id=<?php echo $row["subID"]?>"> 
                                <?php } ?>

                                <?php echo $msgID ?> 
                                
                                <?php if ($_tmpAdmin != 'NO' || checkOwnerSubmission($row["subID"],$_tmpLogin)) { ?>
                                </a> 
                                <?php } ?>

                                </td>

                            <td style="text-align: center;"> <?php 
                                    $ts = explode(" ", $row["timeSub"]);  
                                    echo $ts[0]."<br>".$ts[1];
                                ?> 
                            </td>

                            <td> 
                               <a href="view.php?user=<?php echo $row['username']?>">  <strong> <font color="<?php echo judge(getPoints($row['username'])) ?>"> <?php echo getFullName($row["username"])." (".$row["username"].")"; ?> </font> </strong> </a>
                            </td>
                            
                            <td> 
                                <a href="showproblems.php?proID=<?php echo $row['problemID']?>" > <?php echo $pro["problemName"] ?> </a> 
                            </td>
                            
                            <td> <?php echo strtoupper($row["lang"]) ?> </td>
                            
                            <td> 

                                <?php if ($stt == 1) { ?> <span class="label label-default">Waiting</span> <?php } ?>

                                <?php if ($stt == 2) { ?> <span class="label label-success">Accept</span> <?php } ?>

                                <?php if ($stt == 5) { ?> <span class="label label-danger">Reject</span> <?php } ?>

                                <?php if ($stt == 4) { ?> <span class="label label-danger">Run-error</span> <?php } ?>

                                <?php if ($stt == 3) { ?> <span class="label label-warning">Wrong Answer</span>  <?php } ?>

                            </td>
                            
                            
                        </tr>


                        <?php } } ?>
                  </tbody>
                </table>
				<div class="row">
				<div class="col-md-9"><div class="dataTables_info" id="example_info" role="status" aria-live="polite"></div>
				</div>
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


    <!-- paging -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="paging.js"></script> 
<script type="text/javascript">
            $(document).ready(function() {
                $('#tableData').paging({limit:50});
            });
        </script>

</html>
