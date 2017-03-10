<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Senarai Kain</title>
  
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
        <h4 class="panel-title"><b>Senarai Kain</b></h4>
      </div>
        <div class="panel-body">
<div>
<table class="table table-condensed">

<tr>
	<th class="warning"><p class="text-center">Bil.</p></th>
  <th class="success"><p class="text-center">Jenis Kain</p></th>
  <th class="info"><p class="text-center">Remark</p></th>
</tr>

<?php

	include "inc/conn.php";
	
	$act=$_GET[act];
	
	if ($act=='del')
	{
		
		$f_id =  $_GET['f_id'];
		echo "<script>swal({   title: 'Adakah anda pasti?',   text: 'Anda tidak dapat akses data ini lagi!',   type: 'warning',   showCancelButton: true,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Yes',   closeOnConfirm: false }, function(){ swal('Terhapus!', 'Data berjaya dihapuskan...', 'success'); window.location.href='manage_fabric.php?act=delete&f_id=$f_id'; });</script>";
	}
	else if ($act=='delete')
	{
		$f_id =  $_GET['f_id'];
		$delete = mysql_query("DELETE FROM fabric WHERE f_id = '$f_id'");
	}
	
	$query = "SELECT * FROM fabric";
	$result = mysql_query($query) or die(mysql_error());
	
	$no = 1;
	
	while ($row = mysql_fetch_array($result))
	{
		echo "<tr>
				<td class='warning'>$no</td>
				<td class='success'>$row[f_name]</td>
				<td class='info'>
				<p>
					<a href='update_fabric.php?f_id=$row[f_id]'><img src='icon/update.png' /></a>
					<a href='manage_fabric.php?act=del&f_id=$row[f_id]'><img src='icon/delete.png' /></a>
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