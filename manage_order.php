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

    <div class="panel panel-warning">
      <div class="panel-heading">
        <h4 class="panel-title"><b>Senarai Tempahan Anda</b></h4>
      </div>
        <div class="panel-body"><br />
		<p>#1 Apabila harga untuk pakaian anda sudah ditetapkan, sila klik <b>Status Pembayaran</b>.</p>
		<p>#2 Klik pada icon <img src='icon/cancel.png' /> untuk batalkan tempahan anda.</p>
		
		<br />
<div>



<table class="table table-condensed">

<tr>
	<th class="warning"><p class="text-center">Bil.</p></th>
    <th class="success"><p class="text-center">Tarikh</p></th>
    <th class="active" ><p class="text-center">ID Tempahan</p></th>
    <th class="warning"><p class="text-center">Jenis Pakaian</p></th>
    <th class="danger"><p class="text-center">Kuantiti</p></th>
    <th class="warning"><p class="text-center">Harga</p></th>
    <th class="success"><p class="text-center">Status Pembayran</p></th>
    <th class="danger"><p class="text-center">Status Tempahan</p></th>
    <th class="success"><p class="text-center">Status Tenunan</p></th>
    <th class="info"><p class="text-center">Cancel</p></th>
</tr>

<?php

	include "inc/conn.php";
	
	$act=$_GET[act];
	
	if ($act=='cancel')
	{
		                                                                                      																																																							
		$o_id =  $_GET['o_id'];																																										
		echo "<script>swal({   title: 'Adakah anda pasti?',   text: 'Tempahan anda akan dibatalkan!',   type: 'warning',   showCancelButton: true,   confirmButtonColor: '#DD6B55',   confirmButtonText: 'Yes',   closeOnConfirm: false }, function(){ swal('Pembatalan!', 'Tempahan berjaya dibatalkan...', 'success'); setTimeout(function () {
       window.location.href = 'manage_order.php?act=cancel_order&o_id=$o_id';; 
    }, 2000);; });</script>";

	}
	else if ($act=='cancel_order')
	{
		$o_id =  $_GET['o_id'];
		$update = mysql_query("UPDATE orders SET o_status = 'cancelled' WHERE o_id = '$o_id' ORDER BY o_id DESC");
	}
	
	$user_id = $_SESSION['user_id'];

	$query = "SELECT * FROM orders WHERE c_id = '$_SESSION[user_id]' ORDER BY o_id DESC";
	$result = mysql_query($query) or die(mysql_error());
	
	$no = 1;
	
	while ($row = mysql_fetch_array($result))
	{
		$queryGarment = mysql_query("SELECT * FROM garment WHERE g_id = $row[g_id] ORDER BY g_id DESC");
		$rowGarment = mysql_fetch_array($queryGarment);
		
		echo "<tr>
				<td class='warning'>$no</td>
				<td class='success'>$row[o_date]</td>
				<td class='active'>$row[o_id]</td>
				<td class='warning'><a href='view_garment.php?g_id=$row[g_id]'>$rowGarment[g_type]</a></td>				
				<td class='danger'>$row[o_quantity]</td>
				<td class='warning'>$row[o_price]</td>";
				
				if(($row['o_payment_status'] == 'pending') || ($row['o_payment_status'] == 'processing') ||  ($row['o_payment_status'] == 'accepted') || ($row['o_payment_status'] == 'rejected'))
				{
					echo "<td class='success'>$row[o_payment_status]</td>";
				}
				
				else if($row['o_payment_status'] == 'payment required')
				{
					echo "<td class='success'><a href='send_payment.php?o_id=$row[o_id]'>$row[o_payment_status]</a></td>";
				}
				

			echo"<td class='danger'>$row[o_status]</td>
			     <td class='success'>$row[o_alter_status]</td>
				<td class='info'>
				<p>";
				
				if($row['o_status'] == 'processing')
				{
					echo "<a href='manage_order.php?act=cancel&o_id=$row[o_id]'><img src='icon/cancel.png' /></a>";
				}
				else if($row['o_status'] != 'processing')
				{
					echo "<img src='icon/no-cancel.png' />";
				}
				
			echo"</p>
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