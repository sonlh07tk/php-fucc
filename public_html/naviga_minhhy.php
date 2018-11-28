 <div class="sidebar" data-background-color="white" data-active-color="danger">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    Fcode Training C Course
                </a>
            </div>

            <ul class="nav">
                 <?php if ($_tmpLogin != 'NO') { ?>
                <li id = "x1">
                    <a href="problemset.php">
                        <i class="ti-panel"></i>
                        <p>PROBLEMSET</p>
                    </a>
                </li>
                <?php } ?>

                 <?php if ($_tmpLogin != "NO") { ?>
                <li id = "x2">
                    <a href="submissions.php">
                        <i class="ti-check-box"></i>
                        <p>Submissions</p>
                    </a>
                </li>
                <?php } ?>

                <?php if ($_tmpLogin != "NO") { ?>
                <li id = "x3">
                    <a href="status.php">
                        <i class="ti-flag-alt-2"></i>
                        <p>Status</p>
                    </a>
                </li>
                <?php } ?>

                <?php if ($_tmpAdmin == "YES") { ?>
                <li id = "x4">
                    <a href="add.php">
                        <i class="ti-text"></i>
                        <p>Add Exercise</p>
                    </a>
                </li>
                <?php } ?>

                <?php if ($_tmpAdmin == "YES") { ?>
                <li id = "x5">
                    <a href="judgement.php">
                        <i class="ti-stamp"></i>
                        <p>Judge</p>
                    </a>
                </li>
                 <?php } ?>

                 <?php if ($_tmpLogin != "NO") { ?>
                <li id = "x6">
                    <a href="ranking.php">
                        <i class="ti-cup"></i>
                        <p>Hall of fame</p>
                    </a>
                </li>
                  <?php } ?>
            </ul>
        </div>
    </div>
      
    