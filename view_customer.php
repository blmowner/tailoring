<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profail Pelanggan</title>

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
        <h4 class="panel-title"><b>Profail Pelanggan</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";
	
	$c_id = $_GET[c_id];
	
	$queryCustomer = mysql_query("SELECT * FROM customer WHERE c_id = '$c_id'");
	$rowCustomer = mysql_fetch_array($queryCustomer);

	echo"<form id='profileForm' class='form-horizontal' method='post'>
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Nama</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_name' value='$rowCustomer[c_name]' readonly />
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jantina</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_gender' value='$rowCustomer[c_gender]' readonly />
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>No. Tel.</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_phone' value='$rowCustomer[c_phone]' readonly />
			</div>
		</div>

		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Alamat Penghantaran</label>
			<div class='col-xs-5'>
				<textarea class='form-control' name='c_shipping' style='height:100px;' readonly>$rowCustomer[c_shipping]</textarea>
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
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<hr>
<!-- footer -->
<?php include "layout/footer.php"; ?>

</body>
</html>
<?php
	}
?>
