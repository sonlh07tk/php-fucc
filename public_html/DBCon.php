<?php 
	
	// all query in database
	// config file
	include("configDB.php");

	// count limit submit
	function getLimitSubmit($_proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM problems WHERE problemID = '$_proID' ";
		$rs = mysqli_query($db, $sql);

		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["lim"];
		}
		else
			return 0;

	}
	// check login
	function checkLogin($_user, $_pass) {
		GLOBAL $db;	
		$sql = "SELECT * FROM account";
   		$rs = mysqli_query($db, $sql);

   		foreach ($rs as $acc) {
   			if ($acc['username'] == $_user && $acc['password'] == $_pass) return true;
   		}
		return false;
	}

	function checkExistUser($_user) {
		GLOBAL $db;	
		$sql = "SELECT * FROM account WHERE username = '$_user' ";
   		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			return true;
		}
		else
			return false;
	}

	function checkExistSubmission($_subID) {
		GLOBAL $db;	
		$sql = "SELECT * FROM submissions WHERE subID = '$_subID' ";
   		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			return true;
		}
		else
			return false;
	}

	function checkOwnerSubmission($_subID, $_username) {
		GLOBAL $db;	
		$sql = "SELECT * FROM submissions WHERE subID = '$_subID' AND username = '$_username' ";
   		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			return true;
		}
		else
			return false;
	}

	// check Admin
	function checkAdmin($_user) {
		GLOBAL $db;	
		$sql = "SELECT * FROM account WHERE username = '$_user'";
   		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["role"];
		}
	}
	
	// cmpPoint
	function cmpPoint($a, $b) {
		return $a["point"] < $b["point"];
	}
					
	// get list user for ranking
	function getListUser() {
		GLOBAL $db;
		$sql = "SELECT * FROM account";
   		$rs = mysqli_query($db, $sql);
		$listUser = array();
		if (isset($rs)) {
			while($row = $rs->fetch_assoc()) {
				$listUser[] = $row;
			}
		}
		usort($listUser, "cmpPoint");
		return $listUser;		
	}
	// get single user
	
	function getSingleUser($username) {
		GLOBAL $db;
		$sql = "SELECT * FROM account WHERE username = '$username' ";
   		$rs = mysqli_query($db, $sql);
		
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row;
			}	
		}	
	}
	
	function getClassName($classID) {
		GLOBAL $db;
		$sql = "SELECT * FROM class WHERE classID = '$classID' ";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row['className'];
			}	
		}	
	}
	// count submission
	function getIDSubmit() {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions";
		$rs = mysqli_query($db, $sql);
		if (!isset($rs)) return 1;
		else
			return (mysqli_num_rows($rs) + 1);	
	}
	
	// insert submission to db
	function addSubmit($user, $problem, $attFile, $subTime, $lang) {
		GLOBAL $db;	
		$subID = getIDSubmit();
		$sql = "INSERT INTO submissions(subID, problemID, attFile, judgeState, timeSub, lang, username)".
		"VALUES('$subID', '$problem', '$attFile', '1', '$subTime', '$lang', '$user')";	
		mysqli_query($db, $sql);
		return $subID;		
	}
		
	// add comment to submissions
	function addCmt($_subID, $_cmt) {
		GLOBAL $db;
		$sql = "UPDATE submissions SET cmt = '$_cmt' WHERE subID = '$_subID' ";
		mysqli_query($db, $sql);
	}
	// add log
	function addLog($_ip, $_time, $_query) {
		//echo $_ip." ".$_time." ".$_query."<br>";
		GLOBAL $db;
		$sql = "INSERT INTO accessLog(IP, time, query) VALUES('$_ip', '$_time', '$_query') ";
		mysqli_query($db, $sql);
		//echo "done!!!";
	}
	// get content file to download
	function getSubFile($subID) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE subID = '$subID' ";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row;
			}	
		}
	}
	
	
	// cmpTime
	function cmpTime($a, $b) {
		return $a["timeSub"] < $b["timeSub"];
	}
	// get problem ID by submission ID
	function getProIDbySub($_subID) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE subID = '$_subID' ";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["problemID"];	
		}
		else
			return 0;
	}
	// get Username by submission
	function getUserIDbySub($_subID) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE subID = '$_subID' ";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			$row = $rs->fetch_assoc();
			return $row["username"];	
		}
	}
	
	// get submission of user
	function getSubmissionByUser($user) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE username ='$user' ";
   		$rs = mysqli_query($db, $sql);
		$listSub = array();
		if (isset($rs)) {
			while($row = $rs->fetch_assoc()) {
				$listSub[] = $row;
			}
		}
		// make sort by date
		usort($listSub, "cmpTime");
		return $listSub;
	}
	
	// get All submission (for admin)
	function getAllSubmissions() {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions";
   		$rs = mysqli_query($db, $sql);
		$listSub = array();
		if (isset($rs)) {
			while($row = $rs->fetch_assoc()) {
				$listSub[] = $row;
			}
		}
		// make sort by date
		usort($listSub, "cmpTime");
		return $listSub;
	}
	
	// Filter submission (for admin)
	function fillSubmissions($username, $problemID, $stt) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE username LIKE '$username'".($stt > 0 ? "AND judgeState = '$stt'" : "").($problemID == 0 ? "" : "AND problemID = '$problemID'");
					
   		$rs = mysqli_query($db, $sql);
		$listSub = array();
		if (isset($rs)) {
			while($row = $rs->fetch_assoc()) {
				$listSub[] = $row;
			}
		}
		// make sort by date
		usort($listSub, "cmpTime");
		return $listSub;
	}
	// judge 1 submission
	function judgeSubmission($id, $verdict) {
		GLOBAL $db;
		$sql = "UPDATE submissions SET judgeState = '$verdict' WHERE subID = '$id' ";
		mysqli_query($db, $sql);
	}
	// get single problem by proID
	function getSingleProblem($id) {
		GLOBAL $db;
		$sql = "SELECT * FROM problems WHERE problemID = '$id'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row;
			}	
		}
	}
	// check exits problem
	function checkProblem($id) {
		GLOBAL $db;
		$sql = "SELECT * FROM problems WHERE problemID = '$id'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			return true;	
		}
		return false;
	}
	
	// search problem by Name
	function searchProblem($proName) {
		GLOBAL $db;
		$name = "%".$proName."%";
		$sql = "SELECT * FROM problems WHERE problemName LIKE '$name'";
   		$rs = mysqli_query($db, $sql);
		$listPro = array();
		if (isset($rs)) {
			while($row = $rs->fetch_assoc()) {
				$listPro[] = $row;
			}
		}
		return $listPro;
	}
	// FOR SUBMIT
	// check exist solve
	function checkSolve($username, $proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM mapping WHERE username = '$username' AND problemID = '$proID'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			return true;
		}
		else
			return false;
	}
	
	// count
	function countSolve($username, $proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM mapping WHERE username = '$username' AND problemID = '$proID'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row["cnt"];
			}		
		}
		else
			return 0;
	}
	
	// update or add	
	function updateSolve($username, $proID, $newVal) {	
		GLOBAL $db;		
		// add new
		if (checkSolve($username, $proID) == false) {
			$sql = "INSERT INTO mapping(username, problemID) VALUES('$username', '$proID')";
			mysqli_query($db, $sql);
		}
		
		$lastVal = countSolve($username, $proID);
		//update	
		$sql = "UPDATE mapping SET cnt = '$newVal' WHERE username = '$username' AND problemID = '$proID' ";	
		mysqli_query($db, $sql);
		
		$proScore = getProPoint($proID);
		
		if ($newVal == 0 && $lastVal == 1) {
			// ac a problem
			updateProSolved($proID, -1);
			updateScore($username, -$proScore);
		}
		else
			if ($newVal == 1 && $lastVal == 0) {
				// reject a problem
				updateProSolved($proID, 1);
				updateScore($username, $proScore);
		}
	}
	
	// get Full-name
	
	function getFullName($username) {
		GLOBAL $db;
		$sql = "SELECT * FROM account WHERE username = '$username'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row["fullname"];
			}		
		}
		else
			return 0;
	}
	// get points
	function getPoints($username) {
		GLOBAL $db;
		$sql = "SELECT * FROM account WHERE username = '$username'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row["point"];
			}		
		}
		else
			return 0;
	}
	
	// get Problems - point
	function getProPoint($proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM problems WHERE problemID = '$proID'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row["point"];
			}		
		}
		else
			return 0;
	}
	
	// get solved of Problems
	function getProSolved($proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM problems WHERE problemID = '$proID'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row["solved"];
			}		
		}
		else
			return 0;
	}
	
	// update new solve to Problems	
	function updateProSolved($proID, $deltaVal) {
		GLOBAL $db;
		$nw = getProSolved($proID) + $deltaVal;
		$sql = "UPDATE problems SET solved = '$nw' WHERE problemID = '$proID'";
		$rs = mysqli_query($db, $sql);
	}
	
	// get score of User
	function getScore($username) {
		GLOBAL $db;
		$sql = "SELECT * FROM account WHERE username = '$username'";
		$rs = mysqli_query($db, $sql);
		if (isset($rs) && mysqli_num_rows($rs) > 0) {
			if ($row = $rs -> fetch_assoc()) {
				return $row["point"];
			}		
		}
		else
			return 0;
	}
	
	// update new point to User	
	function updateScore($username, $deltaVal) {
		GLOBAL $db;
		$np = getScore($username) + $deltaVal;
		$sql = "UPDATE account SET point = '$np' WHERE username = '$username'";
		$rs = mysqli_query($db, $sql);
	}
	
	function updateName($username, $_firstName, $_lastName) {
		$_fullName = trim($_lastName." ".$_firstName);
		GLOBAL $db;
		$sql = "UPDATE account SET firstName = '$_firstName', lastName = '$_lastName', fullname = '$_fullName' WHERE username = '$username' ";
		$_rs = mysqli_query($db, $sql);
	}

	function updateAbout($username, $_about) {
		GLOBAL $db;
		$sql = "UPDATE account SET about = '$_about' WHERE username = '$username' ";
		$_rs = mysqli_query($db, $sql);
	}

	function updateEmail($username, $email) {
		GLOBAL $db;
		$sql = "UPDATE account SET email = '$email' WHERE username = '$username' ";
		$_rs = mysqli_query($db, $sql);
	}

	// ADDING PROBLEMS
	// auto increment id problems
	function getIDPro() {
		GLOBAL $db;
		$sql = "SELECT * FROM problems";
		$rs = mysqli_query($db, $sql);
		if (!isset($rs)) return 1;
		else
			return (mysqli_num_rows($rs) + 1);	
	}
	
	// insert problems to db
	function addNewProblem($user_add, $problem_name, $problem_cont, $problem_score) {
		GLOBAL $db;	
		$proID = getIDPro();
		$sql = "INSERT INTO problems(problemID, problemName, statement, point, solved, author)".
		"VALUES('$proID', '$problem_name', '$problem_cont', '$problem_score', '0', '$user_add')";	
		mysqli_query($db, $sql);
	}

	function addNewProblemWithBatch($user_add, $problem_name, $problem_cont, $problem_score, $_batch) {
    	GLOBAL $db;
    	$proID = getIDPro();
    	$sql = "INSERT INTO problems(problemID, problemName, statement, point, solved, author, batch, lim)".
        	"VALUES('$proID', '$problem_name', '$problem_cont', '$problem_score', '0', '$user_add', '$_batch', 3)";
    	mysqli_query($db, $sql);
	}

	// update problems
	function updateProblem($problem_id, $problem_name, $problem_cont, $problem_score) {
		GLOBAL $db;	
		$sql = "UPDATE problems ".
		" SET problemName = '$problem_name', point = '$problem_score', statement = '$problem_cont' WHERE problemID = '$problem_id'; ";	
		mysqli_query($db, $sql);
	}
	
	// update limit
	function updateProblemLimit($_proID, $_num) {	
		GLOBAL $db;
		$sql = "UPDATE problems SET lim = '$_num' WHERE problemID = '$_proID' ";
		mysqli_query($db, $sql);
	}

	// change password
	function changePass($user, $newpass) {
		GLOBAL $db;
		$sql = "UPDATE account SET password = '$newpass' WHERE username = '$user' ";
		mysqli_query($db, $sql);
	}
	
	// CREATE NEW ACCOUNT
	function addNewAccount($username, $password, $fullname, $role) {
		GLOBAL $db;	
		$sql = "INSERT INTO account(username, password, role, fullname, solve, point)".
		"VALUES('$username', '$password', '$role', '$fullname', '0', '0')";	
		mysqli_query($db, $sql);			
	}

	function addNewAccountWithBatch($username, $password, $fullname, $role, $batch) {
        GLOBAL $db;
        $sql = "INSERT INTO account(username, password, role, fullname, solve, point, batch)".
            "VALUES('$username', '$password', '$role', '$fullname', '0', '0', $batch)";
        mysqli_query($db, $sql);
    }

	// COUNTING
	function countSubmitUser($username) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE username = '$username' ";
		
		$rs = mysqli_query($db, $sql);
		
		if (isset($rs)) 
			return mysqli_num_rows($rs);
	}
	
	function countSubmitProUser($username, $proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM submissions WHERE username = '$username' and problemID = '$proID' ";
		
		$rs = mysqli_query($db, $sql);
		
		if (isset($rs)) 
			return mysqli_num_rows($rs);
	}
	
	function countSolveProUser($username) {
		GLOBAL $db;
		$sql = "SELECT * FROM mapping WHERE username = '$username' AND cnt > 0";
		
		$rs = mysqli_query($db, $sql);
		
		if (isset($rs)) 
			return mysqli_num_rows($rs);
	}
	
	function countSolveProInProUser($username, $proID) {
		GLOBAL $db;
		$sql = "SELECT * FROM mapping WHERE username = '$username' AND problemID = '$proID' AND cnt > 0";
		
		$rs = mysqli_query($db, $sql);
		
		if (isset($rs)) 
			return mysqli_num_rows($rs);
	}
	
// place of ranking
	function countRank($username) {
		$myscore = getScore($username);
		GLOBAL $db;
		$sql = "SELECT * FROM account WHERE point > '$myscore' ";
		$rs = mysqli_query($db, $sql);
		if (isset($rs)) 
			return mysqli_num_rows($rs) + 1;
	}

	function countRankWithBatch($username, $_batch)
    {
        $myscore = getScore($username);
        GLOBAL $db;
        $sql = "SELECT * FROM account WHERE point > '$myscore'  and batch = '$_batch'";
        $rs = mysqli_query($db, $sql);
        if (isset($rs))
            return mysqli_num_rows($rs) + 1;
    }
?>

