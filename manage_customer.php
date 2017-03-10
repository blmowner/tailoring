<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Senarai Pelanggan</title>
  
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
        <h4 class="panel-title"><b>Senarai Pelanggan</b></h4>
      </div>
        <div class="panel-body">
<div>
<table class="table table-condensed">

<tr>
	<th class="warning"><p class="text-center">Bil.</p></th>
  <th class="success"><p class="text-center">Nama</p></th>
  <th class="active" ><p class="text-center">ID Pengguna</p></th>
  <th class="warning"><p class="text-center">Jantina</p></th>
  <th class="danger"><p class="text-center">No. Tel.</p></th>
  <th class="warning"><p class="text-center">Alamat Penghantaran</p></th>
  <th class="info"><p class="text-center">Remark</p></th>
</tr>

<?php

	include "inc/conn.php";
	
	$act=$_GET[act];
	
	if ($act=='del')
	{
		
		$c_id =  $_GET['c_id'];
		echo "<script>swal({   title: 'Adakah anda pasti?',   text: 'Anda tidak dapat akses data ini lagi!',   type: 'warning',   showCancelButton: true,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Yes',   closeOnConfirm: false }, function(){ swal('Terhapus!', 'Data berjaya dihapuskan...', 'success'); window.location.href='manage_customer.php?act=delete&c_id=$c_id'; });</script>";
	}
	else if ($act=='delete')
	{
		$c_id =  $_GET['c_id'];
		$deleteUser = mysql_query("DELETE FROM user WHERE user_id = '$c_id'");
		$deleteCustomer = mysql_query("DELETE FROM customer WHERE c_id = '$c_id'");
	}
	
	$queryr = "SELECT * FROM user u,customer c WHERE u.user_id = c.c_id AND u.level = 'customer'";
	$result = mysql_query($queryr) or die(mysql_error());
	
	$no = 1;
	
	while ($row = mysql_fetch_array($result))
	{
		echo "<tr>
				<td class='warning'>$no</td>
				<td class='success'>$row[c_name]</td>
				<td class='active'>$row[c_id]</td>
				<td class='warning'>$row[c_gender]</td>				
				<td class='danger'>$row[c_phone]</td>
				<td class='warning'>$row[c_shipping]</td>
				<td class='info'>
				<p>
					<a href='manage_customer.php?act=del&c_id=$row[c_id]'><img src='icon/delete.png' /></a>
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