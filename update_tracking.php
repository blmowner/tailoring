<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Masukkan No. Tracking</title>

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
        <h4 class="panel-title"><b>Masukkan No. Tracking</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['updateTracking']))
	{
		$o_tracking = $_POST['o_tracking'];
		$o_id = $_POST['o_id'];
		
		$update = mysql_query("UPDATE orders SET o_tracking = '$o_tracking', o_status = 'pakaian dihantar [ $o_tracking ]' WHERE o_id = '$o_id'");

		if($update == TRUE)
			echo "<script>swal('Terima kasih!', 'no. tracking berjaya dimasukkan...', 'success'); 		setTimeout(function () {
					       window.location.href = 'admin_manage_order.php'; 
					    }, 2000);</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); 		setTimeout(function () {
					       window.location.href = 'update_tracking.php'; 
					    }, 2000);</script>";
	}
	
	$o_id = $_GET[o_id];
	
	$queryOrder = mysql_query("SELECT * FROM orders WHERE o_id = '$o_id'");
	$rowOrder = mysql_fetch_array($queryOrder);

	echo"<form id='trackingForm' class='form-horizontal' method='post'>
		<div class='form-group'>
			<label class='col-xs-3 control-label'>ID Pelanggan</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_id' value='$rowOrder[c_id]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>ID Tempahan</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='o_id' value='$rowOrder[o_id]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>No. Tracking </label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='o_tracking' value='$rowOrder[o_tracking]' />
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
				<a href='admin_manage_order.php' class='btn btn-default'>Kembali</a>
				<button type='submit' class='btn btn-warning' name='updateTracking'>Masukkan No. Tracking</button>
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#trackingForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            o_tracking: {
                validators: {
                    notEmpty: {
                        message: 'No. Tracking adalah wajib'
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
