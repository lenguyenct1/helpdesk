<?php
if (isset($_SESSION['id'])== false) {
	// Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
	header('Location: ../Login.php');
	}
  else if(isset($_SESSION['level']))
  {
		$role=$_SESSION['level'];
      if($role!=2){
				header('Location: ../Admin/Errorpage.php');
      }
  }
  ?>
