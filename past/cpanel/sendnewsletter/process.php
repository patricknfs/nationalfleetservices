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
$From="carmel@fleetstreetltd.co.uk";
$NewsLetterIssue=$_REQUEST['NewsLetterIssue'];
$Subject=$_REQUEST['Subject'];
$Users=$_REQUEST["Users"];

//getting the Actual Newsletter HTML
if($NewsLetterIssue!=""){
$sql="SELECT * FROM ".TABLE_NEWSLETTER." where sno=$NewsLetterIssue";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$NewsLetter=$row["NewsLetter"];
}

//inserting the data into the Newsletter History Master
$EntryDate=date('Y-m-d');
$sql="INSERT INTO ".TABLE_NEWSLETTER_HIS."(NewsLetterID,NewsLetterSubject,SendToUsers,EntryDate)
VALUES (
'$NewsLetterIssue', '$Subject', '$Users', '$EntryDate'
)";
$result = mysql_query($sql);

//fetching the SubjectHistoryID to Insert the data into the Details table
$sql="SELECT max(sno) FROM ".TABLE_NEWSLETTER_HIS."";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$MasterRecordID=$row["max(sno)"];

//Mailing and Inseting data into the Details Table
if($Users=="1"){
$sql="SELECT distinct sno,Email FROM ".TABLE_NEWSLETTER_USER."";
$GroupName="";
$message="Newsletter Sent to All Users";
}
elseif($Users=="2"){
echo $H_EmailList=$_REQUEST["H_EmailList"];
//removing last comma
$EmailList=substr($H_EmailList,0,strlen($H_EmailList)-1);
$sql="SELECT distinct sno,Email FROM ".TABLE_NEWSLETTER_USER." where sno in ($EmailList)";
$GroupName="";
$message="Newsletter Sent to selected Users";
}
elseif($Users=="3"){
$H_EmailList_Group=$_REQUEST["H_EmailList_Group"];

$H_EmailList_Group=str_replace("\\", "", $H_EmailList_Group);

//removing last comma
$EmailList=substr($H_EmailList_Group,0,strlen($H_EmailList_Group)-1);
$sql="SELECT distinct sno,Email FROM ".TABLE_NEWSLETTER_GROUP." where GroupName in ($EmailList)";
$message="Newsletter Sent to All selected Groups";
}
//echo $sql;
$result = mysql_query($sql);
$total = mysql_num_rows($result); 
if ($total!=0)
{
while ($row = mysql_fetch_array($result))
{

$UserID = $row["sno"]; 
$Email = $row["Email"]; 

if($Users=="3"){
$sql2="SELECT GroupName FROM ".TABLE_NEWSLETTER_GROUP." where sno=$UserID";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_array($result2);
$total2=mysql_num_rows($result2); 
if($total2!=0){
$GroupName=$row2["GroupName"];
}
}

//inserting the data into the details table
$sql1="INSERT INTO ".TABLE_HISDETAILS."(MasterRecordID,Email,UserID,GroupName,EntryDate)
VALUES (
'$MasterRecordID', '$Email', '$UserID', '$GroupName', '$EntryDate'
)";

$result1 = mysql_query($sql1);

//mailing to the User
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $From" . "\r\n";
mail($Email, $Subject, $NewsLetter, $headers);

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
    sEnd newsletter module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="3" class="bHead">&nbsp;Send Newsletter  Section </td>
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
                          <div align="center"><a href="index.php" class="tableHead">Send More </a></div></td>
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
