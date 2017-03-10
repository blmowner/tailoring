<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tukar Kata Laluan</title>

	<!-- css & script -->
	<?php include "layout/css_&_script.php"; ?>

</head>
<?php
	include "inc/conn.php";
	error_reporting(0);
	session_start();

	if (empty($_SESSION[user_id]) AND empty($_SESSION[user_password]))
	{
	  echo "<center>Login Required!<br>";
	  echo "<a href=index.php><b>LOGIN</b></a></center>";
	}
	else
	{
?>

<body>
  <div class="container">

	 <!-- header & logo -->
	<?php include "layout/header_logo.php"; ?>

	<!-- navigator -->
	<?php include "layout/navigator.php"; ?>


	<div class="panel panel-warning">
      <div class="panel-heading">
        <h4 class="panel-title"><b>Tukar Kata Laluan</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['updatePassword']))
	{
		// check password confirmation
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		
		if($password == $cpassword)
		{
			//encrypt password
			$encrypt_pass = md5($_POST['password']);
			
			$update = mysql_query("UPDATE user SET password = '$encrypt_pass'
												WHERE user_id = '$_SESSION[user_id]'");
			
			if($update == TRUE)
				echo "<script>swal('Terima kasih!', 'kata laluan anda berjaya dikemaskini...', 'success');</script>";
		}
		else if($password != $cpassword)
			echo "<script>swal('Maaf!', 'kata laluan tidak sepadan...', 'error');</script>";
	}
	

	echo"<form id='passwordForm' class='form-horizontal' method='post'>
	

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Kata Laluan</label>
			<div class='col-xs-5'>
				<input type='password' name='password' class='form-control' placeholder='kata laluan baru' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pengesahan Kata Laluan</label>
			<div class='col-xs-5'>
				<input type='password' name='cpassword' class='form-control' placeholder='sahkan kata laluan baru'>
			</div>
		</div>
		

		<!-- messages is where the messages are placed inside -->
		<div class=\"form-group\">
			<div class=\"col-md-9 col-md-offset-3\">
				<div id=\"messages\"></div>
			</div>
		</div>

		<div class='form-group'>
			<div class='col-xs-9 col-xs-offset-3'>
				<button type='reset' class='btn btn-default'>Reset</button>
				<button type='submit' class='btn btn-warning' name='updatePassword'>Tukar Kata Laluan</button>
			</div>
		</div>
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#passwordForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'Kata Laluan adalah wajib'
                    }
                }
            },
			cpassword: {
                validators: {
                    notEmpty: {
                        message: 'Pengesahan Kata Laluan adalah wajib'
                    }
                }
            }
        }
    });
});
</script>

<hr>
<!-- footer -->
<?php include "layout/footer.php"; ?>

</body>
</html>
<?php
	}
?>
