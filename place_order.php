<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buat Tempahan</title>

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
        <h4 class="panel-title"><b>Buat Tempahan</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['placeOrder']))
	{
		// order id generator
		$prefix = "ID-";
		$unique = mt_rand();
		$unique = substr($unique, 0, 5);
		
		$o_id = $prefix . $unique;
		$o_date = $_POST['o_date'];
		$o_quantity = $_POST['o_quantity'];
		$g_id = $_POST['g_id'];
		$c_id = $_POST['c_id'];
		
		$insert = mysql_query("INSERT INTO orders (o_id, o_date, o_quantity, g_id, c_id)
											VALUES ('$o_id', '$o_date', '$o_quantity', '$g_id', '$c_id')");

		if($insert == TRUE)
			echo "<script>swal('Terima kasih!', 'tempahan anda berjaya dihantar...admin akan respon tempahan anda dengan kadar segera', 'success'); window.location=('manage_order.php')</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); window.location=('place_order.php')</script>";
	}
	
	//dapatkan tarikh hari ini
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$today = date('Y-m-d');

	echo"<form id='orderForm' class='form-horizontal' method='post'>
		<div class='form-group'>
			<label class='col-xs-3 control-label'>ID Pelanggan</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_id' value='$_SESSION[user_id]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Tarikh</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='o_date' value='$today' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pakaian Anda</label>
			<div class='col-xs-5'>
				<select name='g_id' class='form-control'>
				<option value=''>:: pilih ukuran pakaian ::</option>";
				
				$queryGarment = mysql_query("SELECT * FROM garment WHERE c_id = '$_SESSION[user_id]'");
				while($rowGarment = mysql_fetch_array($queryGarment))
					echo "<option value='$rowGarment[g_id]'>$rowGarment[g_type]</option>";
			echo"</select>
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Kuantiti</label>
			<div class='col-xs-5'>
				<input type='number' class='form-control' name='o_quantity' placeholder='Order Quantity' min='1' />
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
				<button type='submit' class='btn btn-warning' name='placeOrder'>Hantar Tempahan</button>
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#orderForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            g_id: {
                validators: {
                    notEmpty: {
                        message: 'Jenis ukuran pakaian adalah wajib'
                    }
                }
            },
			o_quantity: {
                validators: {
                    notEmpty: {
                        message: 'Kuantiti adalah wajib'
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
