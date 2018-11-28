
<?php 
    include('peanAccount.php');
    include('DBCon.php');
    include ('rankingJudge.php');
    
    if ($_tmpLogin == 'NO') {
        exit;
    }

    $txtSearch = "";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['txtSearch'])) 
        $txtSearch = $_GET['txtSearch'];
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

<div class="wrapper">
     <?php include('naviga_minhhy.php'); ?>

<script>
        var x = document.getElementById("x1");
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
                  <a class="navbar-brand" href="#">PROBLEMSET</a>
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
                                <h4 class="title">All problems</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content" style="overflow-x: auto;">
							
							<div class="col-md-4 pull-right">	
									 <div class="form-group">
                                                <label>Search:</label>
												<form>
                                                <input type="text" class="form-control" placeholder="Name..." name="txtSearch" />
												</form>
                                                </div>
									</div>
                          <table class="table table-striped table-bordered">
						  
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Type</th>
                      <th>State</th>
                      <th>Point</th>
                      <th>Solved</th>
                    </tr>
                  </thead>
                  <tbody>
                  


                      <?php 
                 
                 $rs = searchProblem($txtSearch);
                 $cnt = 0;
                 
                 if (isset($rs)) {
                 
                    foreach($rs as $row)
                    {
                        $n_ID = normSubID($row["problemID"]);
                        
                        ?>
                        <tr>    
                            <td> <?php echo $n_ID ?> </td>
                            <td> <a href="showproblems.php?proID=<?php echo $row['problemID']?>" > <?php echo $row["problemName"] ?> </a> </th>
                            <td> N/A </td>
                            <td> <?php if (countSolve($_tmpLogin, $row['problemID']) > 0) { ?>  <img src="img/done.png" width="20" height="20"/> <?php }?> </td>
                            <td> <?php echo $row["point"] ?> </td>
                            <td> <a href=""> <img src="img/user.png" /><?php echo $row["solved"] ?> </a></td>
                        </tr>
                        <?php
                    }       
                 }
            ?>
                  </tbody>
                </table>
				<div class="row">
				<div class="col-md-9">
                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing x to x of x entries</div>

				</div>
                <div class="col-md-3">
                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                        <ul class="pagination">
                            <li class="paginate_button previous disabled" id="example_previous">
                                <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0">Previous</a>
                            </li>
                            <li class="paginate_button active">
                                <a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">1</a>
                            </li>
                           
                            <li class="paginate_button next" id="example_next">
                                <a href="#" aria-controls="example" data-dt-idx="3" tabindex="0">Next</a></li>
                            </ul>
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
