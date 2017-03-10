<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Semak Bukti Pembayaran</title>

	<!-- css & script -->
	<?php
		include "layout/css_&_script.php";
		//dapatkan hari ini
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$today = date('Y-m-d');
	?>
	<script>
		$(document).ready(function()
		{
			$("#o_payment_status").change(function()
			{
				var val = $(this).val();
				
				if ((val == "") || (val == "rejected")) {
					$("#temporary_date").html("<input type='text' class='form-control' name='temporary_date' value='-' readonly />");
				}
				else if (val == "accepted") {
					$("#temporary_date").html("<input type='date' class='form-control' name='temporary_date' min='$today' />");
				}
			});
		});
	</script>

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
        <h4 class="panel-title"><b>Semak Bukti Pembayaran</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";
    
    $error = false;

	if(isset($_POST['validatePayment']))
	{
		$o_payment_status = $_POST['o_payment_status'];		
		$o_id = $_POST['o_id'];
		
		//assume completed date
		$temporary_date = $_POST['temporary_date'];
        
        if(strtotime($temporary_date) < time())
        {
        	$error = true;
        	echo "<script>swal('Maaf!', 'Sila pilih tarikh lain ', 'error');</script>";
        }
		
		if(!$error && $o_payment_status == 'accepted')
			$update = mysql_query("UPDATE orders SET o_payment_status = '$o_payment_status', o_status = 'Pakaian dijangka siap pada $temporary_date' WHERE o_id = '$o_id'");
		
		else if($o_payment_status == 'rejected')
			$update = mysql_query("UPDATE orders SET o_payment_status = '$o_payment_status', o_status = '$o_payment_status' WHERE o_id = '$o_id'");

		if($update == TRUE)
			echo "<script>swal('Terima kasih!', 'pembayaran disahkan benar...', 'success'); window.location=('admin_manage_order.php')</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); window.location=('check_payment.php')</script>";
	}
	
	//dapatkan hari ini
	//date_default_timezone_set("Asia/Kuala_Lumpur");
	//$today = date('Y-m-d');
	
	$o_id = $_GET[o_id];
	
	$queryOrder = mysql_query("SELECT * FROM orders WHERE o_id = '$o_id'");
	$rowOrder = mysql_fetch_array($queryOrder);

	echo"<form id='paymentForm' class='form-horizontal' method='post'>
		
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
				<a href='payment/$rowOrder[o_payment_proof]' target='_blank' class='form-control'>klik untuk melihat bukti pembayaran <img src='icon/check_payment.png' /></a>
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pengesahan</label>
			<div class='col-xs-5'>
				<select class='form-control' name='o_payment_status' id='o_payment_status'>
					<option value=''>:: pilih pengesahan ::</option>
					<option value='accepted'>accepted</option>
					<option value='rejected'>rejected</option>
				</select>
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Tarikh Siap</label>
			<div class='col-xs-5' id='temporary_date'>
				<input type='text' class='form-control' name='temporary_date' value='Tarikh siap perlu ditetapkan jika pembayaran adalah benar' readonly />
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
				<button type='submit' class='btn btn-warning' name='validatePayment'>Buat Pengesahan</button>
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
            o_payment_status: {
                validators: {
                    notEmpty: {
                        message: 'Pengesahan Pembayaran adalah wajib'
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
