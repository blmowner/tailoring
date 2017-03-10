<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Senarai Ukuran Pakaian</title>
  
	<!-- css & script -->
	<?php include "layout/css_&_script.php"; ?>
  
</head>
<?php
	include "inc/conn.php";
	error_reporting(0);
	session_start();
	
	$user_id = $_SESSION['user_id'];

	if (empty($_SESSION['user_id']) AND empty($_SESSION['user_password']))
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
        <h4 class="panel-title"><b>Senarai Ukuran Pakaian Anda</b></h4>
      </div>
        <div class="panel-body">
<div>
<table class="table table-condensed">

<tr>
	<th class="warning"><p class="text-center">No.</p></th>
  <th class="success"><p class="text-center">Jenis</p></th>
  <th class="active" ><p class="text-center">Kain</p></th>
  <th class="info" ><p class="text-center">Warna</p></th>
  <th class="warning"><p class="text-center">leher</p></th>
  <th class="danger"><p class="text-center">Bahu</p></th>
  <th class="warning"><p class="text-center">Dada</p></th>
   <th class="success"><p class="text-center">Pinggang</p></th>
  <th class="active" ><p class="text-center">Pinggul</p></th>
  <th class="warning"><p class="text-center">Panjang</p></th>
   <th class="success"><p class="text-center">Bukaan Tangan</p></th>
  <th class="active" ><p class="text-center">Lain-lain</p></th>
  <th class="info"><p class="text-center">Remark</p></th>
</tr>

<?php

	include "inc/conn.php";
	
	$act=$_GET['act'];
	
	if ($act=='del')
	{
		
		$g_id =  $_GET['g_id'];
		echo "<script>swal({   title: 'Adakah anda pasti?',   text: 'Anda tidak dapat akses data ini lagi!',   type: 'warning',   showCancelButton: true,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Yes',   closeOnConfirm: false }, function(){ swal('Terhapus!', 'Data berjaya dihapuskan...', 'success'); window.location.href='manage_garment.php?act=delete&g_id=$g_id'; });</script>";
	}
	else if ($act=='delete')
	{
		$g_id =  $_GET['g_id'];
/*		$deleteUser = mysql_query("DELETE FROM user WHERE user_id = '$user_id'");
		$deleteCustomer = mysql_query("DELETE FROM customer WHERE c_id = '$user_id'");*/
		$deleteGarment = mysql_query("DELETE FROM garment WHERE g_id = '$g_id'");
	}
	
	$query = "SELECT * FROM garment WHERE c_id = '$user_id'";
	$result = mysql_query($query) or die(mysql_error());
	
	$no = 1;
	
	while ($row = mysql_fetch_array($result))
	{
		echo "<tr>
				<td class='warning'>$no</td>
				<td class='success'>$row[g_type]</td>
				<td class='active'>$row[g_fabric]</td>
				<td class='info'>$row[g_color]</td>
				<td class='warning'>$row[g_neck]</td>				
				<td class='danger'>$row[g_shoulder]</td>
				<td class='warning'>$row[g_bust]</td>
				<td class='success'>$row[g_waist]</td>
				<td class='active'>$row[g_hips]</td>
				<td class='warning'>$row[g_length]</td>
				<td class='success'>$row[g_arm_hole]</td>
				<td class='active'>$row[g_others]</td>
				<td class='info'>
				<p>
					<a href='update_garment.php?g_id=$row[g_id]'><img src='icon/update.png' /></a>
					<a href='manage_garment.php?act=del&g_id=$row[g_id]'><img src='icon/delete.png' /></a>
				</p>
			  </td>
			</tr>";
			$no++;
	}
?>


</table>
</div>
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