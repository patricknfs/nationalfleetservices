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
?>
<?php
$bool=1;

$IssueTitle=$_REQUEST['IssueTitle'];
$NewsLetter=$_REQUEST['NewsLetter'];

$sno=$_REQUEST["id"];

if($sno!=""){
$sql = "update ".TABLE_NEWSLETTER." set 
IssueTitle='$IssueTitle',
NewsLetter='$NewsLetter'
WHERE sno=$sno";
$message="Newsletter Updated Successfully.";
}
else{

//check wether a Group with this name already exists or not
$sql="Select * from ".TABLE_NEWSLETTER." where IssueTitle='$IssueTitle'";
$result = mysql_query($sql);
$total=mysql_num_rows($result); 
if ($total!=0){
$message="A Newsletter with same name <b>'$IssueTitle'</b> already exists, please choose different name<br><a href='javascript:history.back();'>Click here</a> to go back.";
$bool=0;
}
else{
if(strlen($NewsLetter) < 10 || empty($IssueTitle)){
	$message = 'Newsletter title or Newsletter content field should not be blank!<br><a href=\"javascript:history.back();\" class=\"tableHead\">Click here</a> to go back.';
}else{
	$EntryDate=date('Y-m-d');
	$sql="INSERT INTO ".TABLE_NEWSLETTER."(IssueTitle,NewsLetter,EntryDate)
	VALUES (
	'$IssueTitle', '$NewsLetter', '$EntryDate'
	)";
	$message="Newsletter Created Successfully.";
}
}
}


$result = mysql_query($sql);
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
			<?php
			if ($sno!=""){echo "Modify ";}
			else{echo "Add ";}
			?>
    newsletter module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="3" class="bHead">
			<?php
			if ($sno!=""){echo "Modify ";}
			else{echo "Add ";}
			?>
					&nbsp;Newsletter Details Section </td>
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
                    <td height="20" style="padding:20px;" colspan="3" class="bText"><div align="center"><?php echo $message; ?></div></td>
                    </tr>
                  <tr>
                    <td height="1" colspan="3" class="line_color"></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td colspan="3"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30%"><div align="right"><a href="index.php" class="tableHead">Add More </a></div></td>
                        <td>&nbsp;</td>
                        <td width="30%"><a href="list.php" class="tableHead">View All</a> </td>
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
