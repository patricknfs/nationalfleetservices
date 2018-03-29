<?php
include ("../include/application-top.php");
$dbObj = new DB();
$dbObj->fun_db_connect();
if($_SESSION["AdminName"] == ""){
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php
exit;
}
$AdminName=$_SESSION["AdminName"];
$OldPassword=$_POST["OldPassword"];
$NewPassword=$_POST["NewPassword"];

$sql="SELECT AdminPass FROM ".TABLE_ADMINS." where AdminName='$AdminName' and AdminPass='$OldPassword'";
$result = mysql_query($sql);
$resultsnumber = mysql_num_rows($result);
if ($resultsnumber != 0)
{
$sql="update ".TABLE_ADMINS." set AdminPass='$NewPassword' where AdminName='$AdminName'";
$result = mysql_query($sql);
$totalUpdated=mysql_affected_rows();
if($totalUpdated>0){
$message="Password Changed Successfully";
}
else{
$message="Password Change not happened";
}

}
else{
$message="Old Password not matching, Please check...";
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WEB ADMIN SECTION</title>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F9F8F8;
}
-->
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="69%" class="headGray">
			Change Password </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="3" class="bHead">
					Change Password Section </td>
                  </tr>
                  <tr>
                    <td width="32%">&nbsp;</td>
                    <td width="48%">&nbsp;</td>
                    <td width="20%">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="1" colspan="3" class="line_color"></td>
                    </tr>
				  
                  <tr class="tablesRowBG_2">
                    <td height="20" style="padding:20px;" colspan="3"><div align="center"><?php echo $message; ?></div></td>
                    </tr>
                  <tr>
                  <tr>
                    <td height="1" colspan="3" class="line_color"></td>
                    </tr>
				  
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              <p>&nbsp;</p></td>
            </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="javascript:history.back();"><img src="../images/BACK.jpg" alt="Back" width="38" height="33" border="0"></a></td>
    <td><div align="right"><a href="javascript:history.forward();"><img src="../images/FORWARD.jpg" alt="Forward" width="38" height="33" border="0"></a></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
