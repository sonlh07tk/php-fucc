<?php 
	class foo {
		public $user;
		public $pass;
		
		function _foo() {
			echo "123";
		}
		
		function _doo() {
			echo "111";
		}
		
		function outInfo() {
			echo $this->user;
			echo $this->pass;
		}
	}
	
	$demo = new foo();
	$demo->user = 'sonlh';
	$demo->pass = '123';
	$demo->outInfo();
?>


