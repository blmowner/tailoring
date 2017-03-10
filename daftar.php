<?php
include "inc/conn.php";
error_reporting(0);
session_start();
if (!empty($_SESSION[user_id]) AND !empty($_SESSION[user_password]))
{
  header('location:dashboard.php');
}
else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pendaftaran</title>
  
  <!-- css & script -->
	<?php include "layout/css_&_script.php"; ?>

</head>

<body>
  <div class="container">
    
	<!-- header & logo -->
	<?php include "layout/header_logo.php"; ?> 
  
	
	<div class="panel panel-warning">
      <div class="panel-heading">
        <h4 class="panel-title"><b>Daftar Sebagai Pelanggan Kami</b></h4>
      </div>
        <div class="panel-body">
	
	<?php
	
	include "inc/conn.php";
	
	if(isset($_POST['daftarPengguna']))
	{
		
		// check password confirmation		
		$pass = $_POST['c_password'];
		$c_pass = $_POST['c_cpassword'];
		
		if($pass == $c_pass)
		{
			//encrypt password
			$encrypt_pass = md5($_POST['c_password']);
			
			
			$c_id = $_POST['c_id'];
			$c_name = $_POST['c_name'];
			$c_gender = $_POST['c_gender'];
			$c_password = $encrypt_pass;
			$c_phone = $_POST['c_phone'];
			$c_shipping = $_POST['c_shipping'];
			
			//dapatkan user id untuk semak samada id dah didaftarkan atau belum
			$queryUser = mysql_query("SELECT * FROM user");
			
			$status = '';
			while($rowUser = mysql_fetch_array($queryUser))
			{
				if($rowUser['user_id'] == $c_id)
				{
					$status = "dahregister";
					break;
				}
				else
					$status = "belumregister";
			}
			
			if($status == "dahregister")
				echo "<script>swal('Ops!', '$c_id sudah berdaftar...', 'error');</script>";
			else if($status == "belumregister")
			{
				$addUser = mysql_query("INSERT INTO user (user_id,password,level) VALUES ('$c_id','$c_password','customer')");
				$addCustomer = mysql_query("INSERT INTO customer (c_id,c_name,c_gender,c_phone,c_shipping) VALUES
															('$c_id','$c_name','$c_gender','$c_phone','$c_shipping')");
				
				if(($addUser == TRUE) && ($addCustomer == TRUE))
					echo "<script>swal({   title: 'Terima kasih!',   text: 'pendaftaran anda telah berjaya...anda boleh log masuk!',   type: 'success',   showCancelButton: false,   confirmButtonColor: '#8CD4F5',   confirmButtonText: 'OK',   closeOnConfirm: false }, function(){ window.location.href='index.php'; });</script>";
			}
		}
		else if($pass != $c_pass)
			echo "<script>swal('Maaf!', 'kata laluan tidak sepadan...', 'error');</script>";
		
	}
	
	echo"<form id='contactForm' class='form-horizontal' method='post'>
		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Nama</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_name' placeholder='Nama penuh anda' />
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Jantina</label>
			<div class='col-xs-5'>
				<div class='radio'>
					<label>
						<input type='radio' name='c_gender' value='lelaki' /> Lelaki
					</label>
				</div>
				<div class='radio'>
					<label>
						<input type='radio' name='c_gender' value='perempuan' /> Perempuan
					</label>
				</div>
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Nama Pengguna</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_id' placeholder='Masukkan nama pengguna pilihan anda' />
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Kata laluan</label>
			<div class='col-xs-5'>
				<input type='password' name='c_password' class='form-control' placeholder='Masukkan kata laluan'>
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>Pengesahan Kata Laluan</label>
			<div class='col-xs-5'>
				<input type='password' name='c_cpassword' class='form-control' id='exampleInputPassword1' placeholder='Sahkan kata laluan anda'>
			</div>
		</div>

		<div class='form-group'>
			<label class='col-xs-3 control-label'>No. Telefon</label>
			<div class='col-xs-5'>
				<input type='text' class='form-control' name='c_phone' placeholder='01212345678'/>
			</div>
		</div>

		
		<div class='form-group'>
			<label class='col-xs-3 control-label'>Alamat Penghantaran</label>
			<div class='col-xs-5'>
				<textarea class='form-control' name='c_shipping' placeholder='Masukkan alamat penghantaran anda' style='height:100px;'></textarea>
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
				<button type='submit' class='btn btn-warning' name='daftarPengguna'>Daftar</button>
			</div>
		</div>    
	</form>";
	
	?>
</div>
</div>

<script>
$(document).ready(function() {
    $('#contactForm').bootstrapValidator({
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
			c_id: {
                validators: {
                    notEmpty: {
                        message: 'ID Pengguna adalah wajib'
                    }
                }
            },
			c_password: {
                validators: {
                    notEmpty: {
                        message: 'Kata laluan adalah wajib'
                    }
                }
            },
			c_cpassword: {
                validators: {
                    notEmpty: {
                        message: 'Pengesahan kata laluan adalah wajib'
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