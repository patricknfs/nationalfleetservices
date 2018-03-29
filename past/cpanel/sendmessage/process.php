<?php
session_start();
if($_SESSION["AdminName"] == ""){
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php
exit;
}
?>

<?php
include ("../../include/dbconnect.php");

$Title=$_REQUEST['Title'];
$Message=$_REQUEST['Message'];
$Users=$_REQUEST["Users"];
$H_UsersList=$_REQUEST['H_UsersList'];
//removing last comma
$UsersList=substr($H_UsersList,0,strlen($H_UsersList)-1);
$EntryDate=date('Y-m-d');

if($Users=="1"){
$sql="SELECT distinct sno FROM ukchl_usermaster";
$message="Message Sent to All Users";
}
elseif ($Users=="2"){
$sql="SELECT distinct sno FROM ukchl_usermaster where sno in ($UsersList)";
$message="Message Sent to Selected Users";
}

$result = mysql_query($sql);
$total = mysql_num_rows($result); 
if ($total!=0){
while ($row = mysql_fetch_array($result)){
$UserID = $row["sno"]; 
$sql1="INSERT INTO ukchl_usermaster(UserID,Title,Message,EntryDate)
VALUES (
'$UserID', '$Title', '$Message', '$EntryDate'
)";
$result1 = mysql_query($sql1);
}
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
            <td width="80%" class="headGray">
			Send Message module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="3" class="bHead">
			Send Message Section </td>
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
                    <td height="1" colspan="3" class="line_color"></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30%"><div align="center"></div>
                          <div align="center"><a href="index.php" class="tableInner">Send More </a></div></td>
                        </tr>
                    </table></td>
                    </tr>
                  <tr>
                    <td height="1" colspan="3" class="line_color"></td>
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
