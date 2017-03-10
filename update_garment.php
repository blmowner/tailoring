<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kemaskini Ukuran Pakaian</title>

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
        <h4 class="panel-title"><b>Kemaskini Ukuran Pakaian</b></h4>
      </div>
        <div class="panel-body">

	<?php

	include "inc/conn.php";

	if(isset($_POST['updateGarment']))
	{
		$g_id = $_POST['g_id'];
		$g_type = $_POST['g_type'];
		$g_fabric = $_POST['g_fabric'];
		$g_color = $_POST['g_color'];
		$g_neck = $_POST['g_neck'];
		$g_shoulder = $_POST['g_shoulder'];
		$g_bust = $_POST['g_bust'];
		$g_waist = $_POST['g_waist'];
		$g_hips = $_POST['g_hips'];
		$g_length = $_POST['g_length'];
		$g_arm_hole = $_POST['g_arm_hole'];
		$g_others = $_POST['g_others'];
		$c_id = $_POST['c_id'];
		
		$update = mysql_query("UPDATE garment SET g_type = '$g_type',
												g_fabric = '$g_fabric',
												g_color = '$g_color',
												g_neck = '$g_neck',
												g_shoulder = '$g_shoulder',
												g_bust = '$g_bust',
												g_waist = '$g_waist',
												g_hips = '$g_hips',
												g_length = '$g_length',
												g_arm_hole = '$g_arm_hole',
												g_others = '$g_others',
												c_id = '$c_id'
												WHERE g_id = '$g_id'");
		if($update == TRUE)
			echo "<script>swal('Terima kasih!', 'ukuran pakain bejaya dikemaskini...', 'success'); window.location=('manage_garment.php')</script>";
		else
			echo "<script>swal('Maaf!', 'error...', 'error'); window.location=('add_garment.php')</script>";
	}
	
	$g_id = $_GET[g_id];
	
	$queryGarment = mysql_query("SELECT * FROM garment WHERE g_id = '$g_id'");
	$rowGarment = mysql_fetch_array($queryGarment);

	echo"<form id='garmentForm' class='form-horizontal' method='post'>
		<input type='hidden' class='form-control' name='g_id' value='$rowGarment[g_id]' />
		<div class='form-group'>
			<label class='col-xs-3 control-label'>ID Pelanggan</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_id' value='$_SESSION[user_id]' readonly />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jenis Pakaian</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='g_type' placeholder='Cth: Baju Kurung, Cheongsam...' value='$rowGarment[g_type]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jenis Kain</label>
			<div class='col-xs-5'>
				<select name='g_fabric' class='form-control'>
				<option value=''>:: pilih jenis kain ::</option>";
				
				$queryFabric = mysql_query("SELECT * FROM fabric");
				while($rowFabric = mysql_fetch_array($queryFabric))
				{
					if($rowGarment[g_fabric] == $rowFabric[f_name])
						echo "<option value='$rowFabric[f_name]' selected>$rowFabric[f_name]</option>";
					else
						echo "<option value='$rowFabric[f_name]'>$rowFabric[f_name]</option>";
				}
					
			echo"</select>
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Warna kain</label>
			<div class='col-xs-5'>
				<select name='g_color' class='form-control'>
				<option value=''>:: pilih warna kain ::</option>";
				
				$queryColor = mysql_query("SELECT * FROM color");
				while($rowColor = mysql_fetch_array($queryColor))
				{
					if($rowGarment[g_color] == $rowColor[c_name])
						echo "<option value='$rowColor[c_name]' selected>$rowColor[c_name]</option>";
					else
						echo "<option value='$rowColor[c_name]'>$rowColor[c_name]</option>";
				}
					
			echo"</select>
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Leher</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_neck' placeholder='Ukuran Leher' value='$rowGarment[g_neck]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Bahu</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_shoulder' placeholder='Ukuran Bahu' value='$rowGarment[g_shoulder]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Dada</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_bust' placeholder='Ukuran Dada' value='$rowGarment[g_bust]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pinggang</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_waist' placeholder='Ukuran Pinggang' value='$rowGarment[g_waist]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pinggul</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_hips' placeholder='Ukuran Pinggul' value='$rowGarment[g_hips]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Panjang</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_length' placeholder='Ukuran Panjang' value='$rowGarment[g_length]' />
			</div>
		</div>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Lengan</label>
			<div class='col-xs-5'>
				<input type='number' step='0.01' class='form-control' name='g_arm_hole' placeholder='Ukuran Lengan' value='$rowGarment[g_arm_hole]' />
			</div>
		</div>

		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Lain-lain</label>
			<div class='col-xs-5'>
				<textarea class='form-control' name='g_others' placeholder='masukkan maklumat tambahan mengenai pakaian anda' style='height:100px;'>$rowGarment[g_others]</textarea>
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
				<button type='submit' class='btn btn-warning' name='updateGarment'>Kemaskini</button>
			</div>
		</div>    
	</form>";
	?>


</div>
</div>

<script>
$(document).ready(function() {
    $('#garmentForm').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
           g_type: {
                validators: {
                    notEmpty: {
                        message: 'Jenis Baju adalah wajib'
                    }
                }
            },
			g_fabric: {
                validators: {
                    notEmpty: {
                        message: 'Jenis kain adalah wajib'
                    }
                }
            },
			g_color: {
                validators: {
                    notEmpty: {
                        message: 'Warna adalah wajib'
                    }
                }
            },
			g_neck: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran leher adalah wajib'
                    }
                }
            },
			g_shoulder: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran bahu adalah wajib'
                    }
                }
            },
			g_bust: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran dada adalah wajib'
                    }
                }
            },
			g_waist: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran pinggang adalah wajib'
                    }
                }
            },
			g_hips: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran pinggul adalah wajib'
                    }
                }
            },
			g_length: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran panjang adalah wajib'
                    }
                }
            },
			g_arm_hole: {
                validators: {
                    notEmpty: {
                        message: 'Ukuran lengan adalah wajib'
                    }
                }
            },
			g_others: {
                validators: {
                    notEmpty: {
                        message: 'Maklumat tambahan adalah wajib'
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
