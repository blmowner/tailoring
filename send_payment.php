<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hantar Bukti Pembayaran</title>

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
        <h4 class="panel-title"><b>Hantar Bukti Pembayaran</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['sendPayment']))
	{
		$file_location 	= $_FILES['o_payment_proof']['tmp_name'];
		$file_type		= $_FILES['o_payment_proof']['type'];
		$file_name		= $_FILES['o_payment_proof']['name'];
		move_uploaded_file($file_location,"payment/$file_name");
				
		$o_id = $_POST['o_id'];
		
		$update = mysql_query("UPDATE orders SET o_payment_status = 'processing', o_payment_proof = '$file_name' WHERE o_id = '$o_id'");

		if($update == TRUE)
			echo "<script>swal('Terima kasih!', 'bukti pembayaran berjaya dihantar...', 'success'); window.location=('manage_order.php')</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); window.location=('send_payment.php')</script>";
	}
	
	$o_id = $_GET[o_id];
	
	$queryOrder = mysql_query("SELECT * FROM orders WHERE o_id = '$o_id'");
	$rowOrder = mysql_fetch_array($queryOrder);

	echo"<form id='paymentForm' class='form-horizontal' method='post' enctype='multipart/form-data'>
	
		<div class='form-group'>
			<label class='col-xs-9 control-label'>**Sila buat pembayaran sebanyak <b style='color:#eea236;'>RM$rowOrder[o_price]</b> ke akaun eTailoring Sdn. Bhd / Maybank / 1234567899999</label>
		</div><br />
		
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
			<label class='col-xs-3 control-label'>Harga (RM)</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='o_price' value='$rowOrder[o_price]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Bukti Pembayaran</label>
			<div class='col-xs-5'>
				<input type='file' class='form-control' name='o_payment_proof' />
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
				<a href='manage_order.php' class='btn btn-default'>Back</a>
				<button type='submit' class='btn btn-warning' name='sendPayment'>Hantar</button>
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#paymentForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            o_payment_proof: {
                validators: {
                    notEmpty: {
                        message: 'Bukit Pembayaran adalah wajib'
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
