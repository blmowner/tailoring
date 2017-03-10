<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kemaskini Jenis Kain</title>

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
        <h4 class="panel-title"><b>Kemaskini Jenis Kain</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['updateFabric']))
	{
		$f_id = $_POST['f_id'];
		$f_name = $_POST['f_name'];
		
		$update = mysql_query("UPDATE fabric SET f_name = '$f_name' WHERE f_id = '$f_id'");

		if($update == TRUE)
			echo "<script>swal('Terima kasih!', 'jenis kain berjaya dikemaskini...', 'success'); window.location=('manage_fabric.php')</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); window.location=('update_fabric.php')</script>";
	}
	
	$f_id = $_GET[f_id];
	
	$queryFabric = mysql_query("SELECT * FROM fabric WHERE f_id = '$f_id'");
	$rowFabric = mysql_fetch_array($queryFabric);

	echo"<form id='fabricForm' class='form-horizontal' method='post'>
		<input type='hidden' class='form-control' name='f_id' value='$rowFabric[f_id]' />
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jenis Kain</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='f_name' placeholder='Jenis Kain' value='$rowFabric[f_name]' />
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
				<button type='submit' class='btn btn-warning' name='updateFabric'>Kemaskini</button>
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#fabricForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            f_name: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Kain adalah wajib'
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
