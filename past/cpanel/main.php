<?php
session_start();
if($_SESSION["AdminName"] == ""){
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php
exit;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WEB ADMIN SECTION</title>
<link href="include/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #F9F8F8;
}
.style1 {font-size: 36px}
-->
</style>
<script language="javascript" type="text/javascript" src="include/tooltip.js"></script>
<link href="include/tooltip.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="4%"><a href="#" title="Home"><img src="images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
          <td width="78%" class="headGray"> Web Administration Control Panel </td>
          <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="80%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center" class="headGray style1"><a href="" target="_blank" class="headGray style1">Fleet Street Control panel </a></span></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="bText"><div align="center">Click on the left panel to do the administrative tasks </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
