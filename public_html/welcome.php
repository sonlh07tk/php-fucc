<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
	  
      //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Không chấp nhận định dạng ảnh có đuôi này, mời bạn chọn JPEG hoặc PNG.";
      }
      
      if($file_size > 2097152){
         $errors[]='Kích cỡ file nên là 2 MB';
		}
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Thành công!!!";
      }
      else{
         print_r($errors);
      }
   }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Welcome Page </title>
</head>
	<font color="red" > <h1> Submit code </h1> </font>
    
    <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
			
         <ul>
            <li>Gửi file có tên: <?php echo $_FILES['image']['name'];  ?>
            <li>Kích cỡ file   : <?php echo $_FILES['image']['size'];  ?>
            <li>Kiểu file      : <?php echo $_FILES['image']['type'] ?>
         </ul>
	</form>

<body>
</body>
</html>