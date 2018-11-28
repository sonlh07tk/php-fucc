<?php
   include("configLocalDB.php");
   session_start();
   
   /*if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT * FROM Account WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      if($count == 1) {
         //session_register("myusername");
         //$_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      } else {
         $error = "Your Login Name or Password is invalid";
      }
   }
   */
   if ($_SERVER['REQUEST_METHOD'] == "POST") {
   		
	}
   //$result = $db->query($query);
?>

<html>
   
   <head>
      <title>Login Page</title>
   </head>
   <body>
               <form action = "" method = "post">
                  <label>UserName:</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password:</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>		
   </body>
</html>