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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>e-tailoring </title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<style type="text/css">
body {
	background-image:url(img/background1.jpg)
}
</style>
<?php include "layout/css_&_script.php"; ?>
</head>

<body>
<br />
<table width="480" border="0" align="center" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><img src="img/logo.png" width="950px"/></td>
  </tr>
  
  <br /><br /><br />
  <tr>
    <td align="center">
    <form id="form1" name="form1" method="post" action="login.php">
    <table width="450" border="0">
      <tr align="left">
        <td width="83" align="right" nowrap="nowrap" ><strong><font size="3" face="Verdana, Geneva, sans-serif">ID Pengguna : </font></strong></td>
        <td width="144"><input name="user_id" type="text" class="input-medium" id="user_id" placeholder='nama pengguna'/></td>
      </tr>
      <tr align="left">
        <td align="right" nowrap="nowrap" ><strong><font size="3" face="Verdana, Geneva, sans-serif">Katalaluan :</font></strong></td>
        <td><input name="user_password" type="password" class="input-medium" id="user_password" placeholder= 'katalaluan'  /></td>
      </tr>
      <tr>
      	<td height="20">&nbsp;</td>
        <td height="20" align="left"><input  type="submit" name="Login" value="Log Masuk" class="btn btn-primary login_btn" />
        <br />
        
        <div class="regis">
                <a href="daftar.php">Daftar Masuk?</a>
               </div>
      </tr>
      <tr>
        <td height="31" colspan="2" class="arahan"></td>
      </tr>
    </table>
  </form>  
    </td>
  <br /><br />
  <tr>
    <td colspan="2"><img src="img/footer.jpg" width="800" height="160" /></td>
  </tr>
</table>

</body>
</html>
<?php
}
?>