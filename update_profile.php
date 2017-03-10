<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kemaskini Profail</title>

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
        <h4 class="panel-title"><b>Kemaskini Profail</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['updateProfile']))
	{
		$c_name = $_POST['c_name'];
		$c_gender = $_POST['c_gender'];
		$c_phone = $_POST['c_phone'];
		$c_shipping = $_POST['c_shipping'];
		$c_id = $_POST['c_id'];
		
		
		$update = mysql_query("UPDATE customer SET c_name = '$c_name',
												c_gender = '$c_gender',
												c_phone = '$c_phone',
												c_shipping = '$c_shipping'
												WHERE c_id = '$c_id'");

		if($update == TRUE)
			echo "<script>swal('Terima kasih!', 'profail anda berjaya dikemaskini...', 'success'); window.location=('update_profile.php')</script>";
		else
			echo "<script>swal('Sorry!', 'cant be updated...', 'error'); window.location=(update_profile.php)</script>";
	}
	
	$queryCustomer = mysql_query("SELECT * FROM customer WHERE c_id = '$_SESSION[user_id]'");
	$rowCustomer = mysql_fetch_array($queryCustomer);

	echo"<form id='profileForm' class='form-horizontal' method='post'>
		<input type='hidden' class='form-control' name='c_id' value='$rowCustomer[c_id]' />
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Nama</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_name' placeholder='Nama penuh anda' value='$rowCustomer[c_name]' />
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jantina</label>
			<div class='col-xs-5'>";
			
			if($rowCustomer[c_gender] == 'lelaki')
			{
				echo "<div class='radio'>
						<label>
							<input type='radio' name='c_gender' value='lelaki' checked /> Lelaki
						</label>
					</div>
					<div class='radio'>
						<label>
							<input type='radio' name='c_gender' value='perempuan' /> Perempuan
						</label>
					</div>";
			}
			else if($rowCustomer[c_gender] == 'perempuan')
			{
				echo "<div class='radio'>
						<label>
							<input type='radio' name='c_gender' value='lelaki' /> Lelaki
						</label>
					</div>
					<div class='radio'>
						<label>
							<input type='radio' name='c_gender' value='perempuan' checked /> Perempuan
						</label>
					</div>";
			}
				
		echo"</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>No. Tel.</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_phone' placeholder='0123456789' value='$rowCustomer[c_phone]' />
			</div>
		</div>

		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Alamat Penghantaran</label>
			<div class='col-xs-5'>
				<textarea class='form-control' name='c_shipping' placeholder='alamat penghantaran anda' style='height:100px;'>$rowCustomer[c_shipping]</textarea>
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
				<button type='submit' class='btn btn-warning' name='updateProfile'>Kemaskini</button>
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#profileForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            c_name: {
                validators: {
                    notEmpty: {
                        message: 'Nama adalah wajib'
                    }
                }
            },
			c_gender: {
                validators: {
                    notEmpty: {
                        message: 'Jantina adalah wajib'
                    }
                }
            },
			c_phone: {
                validators: {
                    notEmpty: {
                        message: 'No. Tel. adalah wajib'
                    }
                }
            },
			c_shipping: {
                validators: {
                    notEmpty: {
                        message: 'Alamat penghantaran adalah wajib'
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
