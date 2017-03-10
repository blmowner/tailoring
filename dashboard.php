<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>E-Tailoring</title>
	
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
        <h2 class="panel-title"><b>Selamat Datang <?php echo $_SESSION[user_id] . " ke Sistem e-Tailoring"; ?> </b></h2>
      </div>
        <div class="panel-body">
	
	<center><img src='img/dashboard.jpg' width='500px'></center>
<center><h4> Selamat Datang !
<br>
E-Tailoring adalah Sistem untuk mengambil tempahan baju secara online.
<br>
Kami pakar dalam menjahit baju pilihan anda.
<br>
Hubungi kami untuk maklumat lanjut.
<br>
Sabrena Enterprise : 0123456789
<br>
Lokasi : No, 63/6 Jalan Manggis 9, Felcra Changkat Lada, 36800 , Kampung Gajah Perak. 

</center></h4>

	
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