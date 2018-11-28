<?php 
    include ("DBCon.php");
    include ("rankingJudge.php");
    include("peanAccount.php");
    
    if ($_tmpAdmin == "NO") {
        echo "Not permission yet.";
        exit;
    }
    

    $fill_stt = 0;
    $fill_username = "";
    $fill_problem = 0;
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

// storage last search
        if (isset($_SESSION['FillUsername'])) $fill_username = $_SESSION['FillUsername'];
        if (isset($_SESSION['FillProblem'])) $fill_problem = $_SESSION['FillProblem'];
        if (isset($_SESSION['FillStt'])) $fill_stt = $_SESSION['FillStt'];
    

        if (isset($_GET['bnAction'])) {
            $val = $_GET['bnAction'];
            if ($val == 'Filter') {
                $fill_username = $_GET['ffUsername'];
                $fill_problem = $_GET['ffProblem'];
                $fill_stt = getStateNumber($_GET['ffStt']);
                                $_SESSION['FillUsername'] = $fill_username;
                $_SESSION['FillStt'] = $fill_stt;
                $_SESSION['FillProblem'] = $fill_problem;

            }
            else {
                // judging
                $_id = $_GET["txtSubID"];
                
                // add comment
                $_cmt = $_GET["cmt"];
                addCmt($_id, $_cmt);

                // judge state
                $_stt = $_GET["newJudge"];
                $_newStt = getStateNumber($_stt);   
                judgeSubmission($_id, $_newStt);    
        
                $_proID = getProIDbySub($_id);
                $_userID = getUserIDbySub($_id);
        
                $_cntSolve = countSolve($_userID, $_proID);
        
                $_curStt = $_GET["curStt"];
        
                if ($_curStt != $_newStt && ($_newStt == 2 || $_curStt == 2)) {
                // if make AC
                if ($_newStt == 2) {    
                    $_cntSolve++;
                }
                else // if make other
                    {
                        if ($_cntSolve > 0) $_cntSolve--;
                    }
                updateSolve($_userID, $_proID, $_cntSolve);
                }           
            }
        }
    }
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
        var x = document.getElementById("x5");
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
                  <a class="navbar-brand" href="#">JUDGEMENT</a>
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
                    <div class="col-md-15">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ALL LAST SUBMISSIONS</h4>
                               
                            </div>
                            <div class="content">
							
                 <form action=""  >
                    <select name="ffStt" style="display:inline; height:30px;">
                                    <option <?php if ( $fill_stt == 0 ) {?> selected <?php } ?> > All </option>
                                    <option <?php if ( $fill_stt == 2 ) {?> selected <?php } ?> > Accepted </option>
                                    <option <?php if ( $fill_stt == 3 ) {?> selected <?php } ?> > Wrong Answer</option>
                                    <option <?php if ( $fill_stt == 4 ) {?> selected <?php } ?> > Run-error </option>
                                    <option <?php if ( $fill_stt == 1 ) {?> selected <?php } ?> > Pending </option>
                                    
                                    <option <?php if ( $fill_stt == 5 ) {?> selected <?php } ?> > Reject </option>
                     </select>

                     

             <input type="text" placeholder="username" name = "ffUsername" value="<?php if (isset($_SESSION['FillUsername'])) echo $_SESSION['FillUsername'] ?>" style="height:30px"/>
             <input type="text" placeholder="problem" name = "ffProblem" value="<?php if (isset($_SESSION['FillProblem'])) echo $_SESSION['FillProblem'] ?>" style="height:30px"/>
             
            <button type="submit" class="btn btn-success" style="height:30px" value="Filter" name="bnAction">Filter</button>
            </form>
            <br>
            
                 <table id="tableData" class="table table-striped table-bordered">

            <thead>
            <tr>
            <th> # </th>
            <th> View </th>
            <th> When </th>
            <th> Who </th>
            <th> Problem </th>
            <th> Lang </th>
            <th> Current verdict </th>
            <th> Make verdict </th>
            <th> Comment </th>
            <th style="background-color: white"> Action </th>
            </tr>
            </thead>
            
            <tbody>
            <?php 
                 //$rs = getAllSubmissions();
                 
                 $rs = fillSubmissions('%'.$fill_username.'%', $fill_problem, $fill_stt);
                 
                 if (isset($rs)) {
                    $dem = 0;                   
                    $cnt = 0;
                    
                    foreach($rs as $row)
                    {
                        $dem++;
                        //if ($dem > 100) break;
                        $stt = $row["judgeState"];
                        
                        $col = colorState($stt);
                        $msg = stateString($stt);
                        $msgID = normSubID($row["subID"]);
                        $pro = getSingleProblem($row["problemID"]);
                        ?>
                        
                        <tr>
                            <form method="get">
                            <td> <a href="download.php?downloadSubID=<?php echo $row["subID"] ?>"> <?php echo $msgID ?> </a> </td>
                            <td> <a href="showcode.php?id=<?php echo $row["subID"]?>">source</a></td>
                            <td> <?php echo $row["timeSub"] ?> </td>
                            <td> <strong> <font color="<?php echo judge(getPoints($row['username'])) ?>"> <?php echo getFullName($row["username"])." (".$row["username"].")"; ?> </font> </strong> </td>
                            <td> <a href="showProblems.php?proID=<?php echo $row['problemID']?>" > <?php echo $pro["problemName"] ?> </a> </td>
                            <td> <?php echo strtoupper($row["lang"]) ?> </td>
                            <td> 
                                <?php if ($stt == 1) { ?> <span class="label label-default">Waiting</span> <?php } ?>

                                <?php if ($stt == 2) { ?> <span class="label label-success">Accept</span> <?php } ?>

                                <?php if ($stt == 5) { ?> <span class="label label-danger">Reject</span> <?php } ?>

                                <?php if ($stt == 4) { ?> <span class="label label-danger">Run-error</span> <?php } ?>

                                <?php if ($stt == 3) { ?> <span class="label label-warning">Wrong Answer</span>  <?php } ?>
                                <input type = "hidden" value = "<?php echo $stt ?>" name="curStt"/>
                            </td> 
                                     

                            <td> 
                                <select class = "form-control" name="newJudge" style="width: 155px">
                                    <option> Accepted </option>
                                    <option> Wrong Answer</option>
                                    <option> Run-error </option>
                                    <option> Pending </option>
                                    <option> Reject </option>
                                </select>
                            </td>
                            <td>
                                <textarea style = "width: 155px" name="cmt" class="form-control"><?php echo $row['cmt']?></textarea>
                            </td>
                            <td> 
                                <input class = "btn btn-fill btn-danger" type = "submit" value = "Judge" name="bnAction"/>     
                                <input type="hidden" value="<?php echo $row["subID"] ?>" name="txtSubID"/>           
                            </td>
                            </form>
                        </tr>
                        
                        <?php
                    }       
                 }
            ?>
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
