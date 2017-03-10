
	<?php
		include "inc/conn.php";
		error_reporting(0);
		$encrypt_pass = md5($_POST['user_password']);
		$user_password = $encrypt_pass;

		$login = mysql_query("SELECT * FROM user WHERE user_id ='$_POST[user_id]' AND password = '$user_password'");
		$success = mysql_num_rows($login);
		$row = mysql_fetch_array($login);

		if ($success > 0){
			session_start();
			$_SESSION[user_id]= $row[user_id];
			$_SESSION[user_password] = $row[password];
			$_SESSION[user_level] = $row[level];			
			
			header('location:dashboard.php');
		}
		else
			echo "<script>window.alert('Authentication failed!'); window.location=('index.php')</script>";
	?>