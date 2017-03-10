<?php session_start(); ?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <!-- css & script -->
   <?php include "layout/css_&_script.php"; ?>
 </head>

 <body>
  <?php

  unset($_SESSION['user_id']);
  session_unset();
  session_destroy();
  echo "<script>swal('Log Keluar Berjaya!', 'Sila Datang Lagi', 'success');</script>";
  header( "refresh:2; url=index.php" );

  ?>

</body>
</html>
