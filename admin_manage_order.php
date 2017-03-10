<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Senarai Tempahan</title>
  
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
    <?php $user_id = $_SESSION['user_id'];?>

    <div class="panel panel-warning">
      <div class="panel-heading">
        <h4 class="panel-title"><b>Senarai Tempahan</b></h4>
      </div>
        <div class="panel-body"><br />
		<p><b>#1</b> klik pada <b>ID Pelanggan</b> untuk melihat maklumat pelanggan</p>
		<p><b>#2</b> klik pada <b>Jenis Pakaian</b> untuk melihat ukuran baju pelanggan</p>
		<p><b>#3</b> klik pada <b>Harga</b> untuk mengemaskini harga.</p>
		<p><b>#4</b> klik pada <b>Status Pembayaran</b> untuk menyemak dan mengesahkan pembayaran.</p>
		<p><b>#5</b> klik pada <b>Status Tempahan</b> untuk mengemaskini no tracking</p>
		<p><b>#6</b> abaikan langkah diatas jika order dibatalkan oleh pelanggan</p><br />
<div>
<table class="table table-condensed">

<tr>
	<th class="warning"><p class="text-center">No.</p></th>
	<th class="info"><p class="text-center">ID Pelanggan</p></th>
    <th class="success"><p class="text-center">Tarikh</p></th>
    <th class="active" ><p class="text-center">ID Tempahan</p></th>
    <th class="warning"><p class="text-center">Jenis Pakaian</p></th>
    <th class="danger"><p class="text-center">Kuantiti</p></th>
    <th class="warning"><p class="text-center">Harga</p></th>
    <th class="success"><p class="text-center">Status Pembayaran</p></th>
    <th class="danger"><p class="text-center">Status Tempahan</p></th>
    <th class="success"><p class="text-center">Status Tenunan</p></th>
    <th class="info"><p class="text-center">Hapus</p></th>
</tr>

<?php

	include "inc/conn.php";
	
	

	$act=$_GET[act];
	
	if ($act=='del')
	{
		
		$o_id =  $_GET['o_id'];                                                                                                                                                                                                                                                                                                                  
		echo "<script>swal({   title: 'Adakah anda pasti?',   text: 'Anda tidak dapat akses data ini lagi!',   type: 'warning',   showCancelButton: true,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Yes',   closeOnConfirm: false }, function(){ swal('Terhapus!', 'Data berjaya dihapuskan...', 'success'); setTimeout(function () {
       window.location.href='admin_manage_order.php?act=delete&o_id=$o_id';; 
    }, 2000);; });</script>";
	}
	else if ($act=='delete')
	{
		$o_id =  $_GET['o_id'];
		$delete = mysql_query("DELETE FROM orders WHERE o_id = '$o_id' ORDER BY o_id DESC");
	}
	
	$query = "SELECT * FROM orders ORDER BY o_id DESC";
	$result = mysql_query($query) or die(mysql_error());
	
	$no = 1;
	
	while ($row = mysql_fetch_array($result))
	{
		$queryGarment = mysql_query("SELECT * FROM garment WHERE g_id = $row[g_id] ORDER BY g_id DESC");
		$rowGarment = mysql_fetch_array($queryGarment);
		
		echo "<tr>
				<td class='warning'>$no</td>
				<td class='info'><a href='view_customer.php?c_id=$row[c_id]'>$row[c_id]</a></td>
				<td class='success'>$row[o_date]</td>
				<td class='active'>$row[o_id]</td>
				<td class='warning'><a href='admin_view_garment.php?g_id=$row[g_id]&c_id=$row[c_id]'>$rowGarment[g_type]</a></td>				
				<td class='danger'>$row[o_quantity]</td>
				<td class='warning'><a href='update_price.php?o_id=$row[o_id]'>$row[o_price]</a></td>";
				
				if($row['o_payment_status'] == 'processing')
				{
					echo "<td class='success'><a href='check_payment.php?o_id=$row[o_id]'>$row[o_payment_status]</a></td>";
				}
				else if($row['o_payment_status'] != 'processing')
				{
					echo "<td class='success'>$row[o_payment_status]</td>";
				}
				
				if($row['o_payment_status'] == 'accepted')
				{
					echo "<td class='danger'><a href='update_tracking.php?o_id=$row[o_id]'>$row[o_status]</a></td>";
				}
				else
				{
					echo "<td class='danger'>$row[o_status]</td>";
				}

				echo "<td class='success'><a href='update_alter_status.php?o_id=$row[o_id]'>$row[o_alter_status]</td>";
				
			echo"
				<td class='info'>
				<p>
					<a href='admin_manage_order.php?act=del&o_id=$row[o_id]'><img src='icon/delete.png' /></a>
				</p>
			  </td>
			</tr>";
			$no++;
	}
?>


</table>
<a href=<?php echo "pdf_create_receipt.php?user_id=$user_id";?>>
<button class='btn btn-warning'>
  Cetak Resit
</button>
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