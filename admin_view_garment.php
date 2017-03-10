<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Ukuran Pakaian</title>

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
        <h4 class="panel-title"><b>Ukuran Pakaian</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";
	
	$g_id = $_GET[g_id];
	
	$queryGarment = mysql_query("SELECT * FROM garment WHERE g_id = '$g_id'");
	$rowGarment = mysql_fetch_array($queryGarment);

	echo"<form id='garmentForm' class='form-horizontal' method='post'>
		<div class='form-group'>
			<label class='col-xs-3 control-label'>ID Pelanggan</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_id' value='$_SESSION[user_id]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jenis Pakaian</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='g_type' value='$rowGarment[g_type]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jenis Kain</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='g_fabric' value='$rowGarment[g_fabric]' readonly />
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Leher</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_neck' placeholder='Neck Size' value='$rowGarment[g_neck]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Bahu</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_shoulder' placeholder='Shoulder Size' value='$rowGarment[g_shoulder]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Dada</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_bust' placeholder='Bust Size' value='$rowGarment[g_bust]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pinggang</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_waist' placeholder='Waist Size' value='$rowGarment[g_waist]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pinggul</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_hips' placeholder='Hips Size' value='$rowGarment[g_hips]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Panjang</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_length' placeholder='Length Size' value='$rowGarment[g_length]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Lengan</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_arm_hole' placeholder='Arm hole Size' value='$rowGarment[g_arm_hole]' readonly />
			</div>
		</div>

		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Lain-lain</label>
			<div class='col-xs-5'>
				<textarea class='form-control' name='g_others' style='height:100px;' readonly>$rowGarment[g_others]</textarea>
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
