<?php include("peanAccount.php"); ?>
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
        var x = document.getElementById("x6");
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
                    <a class="navbar-brand" href="#">HALL OF FAME</a>
                </div>
                <div class="collapse navbar-collapse">
                    <?php if ($_tmpLogin == 'YES') { ?>
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
                    <?php } ?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Hall of fame</h4>

                            </div>
                            <div class="content" style="overflow-x: auto;">

                                <table class="table table-striped">

                                    <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Solved</th>
                                        <th>Score</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php 
                                    include("DBCon.php");
                                    $rs = getListUser();
                                        include("rankingJudge.php");
                $lastPoint = 1000000000;
                $cnt = 0;
                foreach($rs as $row)
                 {
                    if ($row['point'] < $lastPoint) $cnt++;
                    $lastPoint = $row['point'];
                    
                    $col = judge($row["point"]);
                    ?>
                    <tr <?php if ($row['username'] == $_tmpLogin) {?> style="background-color:#ffff99"<?php } ?> >
                        <td> <?php echo countRank($row['username']) ?> </td>
                        <td> <strong><font color="<?php echo $col ?>"> <?php echo $row["fullname"] ?> </td> </font> </strong>
                        <td> <?php echo getClassName($row['class']) ?></td>
                        <td> <?php echo countSolveProUser($row['username']) ?>  </td>
                        <td> <?php echo $row["point"] ?> </td>
                    </tr>
                    <?php
                }       
            ?>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-9"><div class="dataTables_info" id="example_info" role="status" aria-live="polite"></div>
                                    </div><div class="col-md-3"><div class="dataTables_paginate paging_simple_numbers" id="example_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example_previous"><a href="#" aria-controls="example" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="3" tabindex="0">Next</a></li></ul></div></div></div>
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
