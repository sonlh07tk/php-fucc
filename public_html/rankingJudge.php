<?php 
	function judge($point) {
		//if ($point >= 110) return "black";
		if ($point >= 78) return "red";
		if ($point >= 55) return "#ff1494";
		if ($point >= 35) return "orange";
		if ($point >= 20) return "purple";
		if ($point >= 10) return "blue";
		if ($point > 0) return "green";
		return "gray";	
	}
	
	function colorState($stt) {
		if ($stt == 1) return "gray"; //  Pending
		if ($stt == 2) return "green"; // Accepted
		if ($stt == 3) return "orange"; // Wrong Answer
		if ($stt == 4) return "purple"; // Run-error
		return "black"; // Reject
	}
	
	function stateString($stt) {
		if ($stt == 1) return "Pending";
		if ($stt == 2) return "Accepted";
		if ($stt == 3) return "Wrong Answer";
		if ($stt == 4) return "Run-error";
		return "Reject";
	}
	
	function normSubID($id) {
		$_normStr = (string) $id;
		while (strlen($_normStr) < 4) {
			$_normStr = "0".$_normStr;	
		}
		return $_normStr;
	}
	
	function getStateNumber($stt) {
		if (strcmp($stt, "All") == 0) return 0;
		if (strcmp($stt, "Accepted") == 0) return 2;
		if (strcmp($stt, "Wrong Answer") == 0) return 3;
		if (strcmp($stt, "Run-error") == 0) return 4;
		if (strcmp($stt, "Pending") == 0) return 1;
		return 5;
	}
?>