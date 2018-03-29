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

$FeedbackResponse=$_REQUEST['FeedbackResponse'];

$sno=$_REQUEST["id"];

if($sno!=""){
$ResponseDate=date('Y-m-d');
$sql = "update tmmg_feedbackmaster set 
FeedbackResponse='$FeedbackResponse',
ResponseDate='$ResponseDate' 
WHERE sno=$sno";
$result = mysql_query($sql);

//now get the userid and send the mail
$sql="SELECT Username,FirstName,LastName FROM tmmg_usermaster where sno=(select UserID from tmmg_feedbackmaster where sno=$sno)";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$resultsnumber = mysql_num_rows($result);
if ($resultsnumber != 0){
$Username=$row["Username"];
$FirstName=$row["FirstName"];
$LastName=$row["LastName"];
}

//getting the user's feedback
$sql="SELECT * from tmmg_feedbackmaster where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$resultsnumber = mysql_num_rows($result);
if ($resultsnumber != 0){
$Feedback=$row["Feedback"];
$ServiceInfo=$row["ServiceInfo"];
}

//now sending the mail
$strHTML="";
$strHTML=$strHTML . "<font face='Verdana, Arial, Helvetica, sans-serif;' size='2'>";
$strHTML=$strHTML . "<p>Dear <strong>$FirstName $LastName</strong></p>";
$strHTML=$strHTML . "<p>Feedback Response from '<strong>THE MORTGAGE MARKETING GROUP</strong>'</p>";
$strHTML=$strHTML . "<p>Your Feedback was <br>'<strong>$Feedback</strong>'</p>";
$strHTML=$strHTML . "<p>I Want more Information on <br><strong>$ServiceInfo</strong></p>";
$strHTML=$strHTML . "<p>Our Response<br><strong>$FeedbackResponse</strong></p>";
$strHTML=$strHTML . "<p>From:<br>";
$strHTML=$strHTML . "<strong>TMMG Team</strong></p></font>";


$To=$Username;
$From="admin@tmmg.com";
$Subject="TMMG Membership Registration";
//mailing to the User
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $From" . "\r\n";
mail($To, $Subject, $strHTML, $headers);
$message="Response has been sent the User.";

//end block

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
			Send Response module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="3" class="bHead">
			Send Response Section </td>
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
                        <td width="30%"><div align="center"><a href="list.php" class="tableInner">View All</a> </div></td>
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
