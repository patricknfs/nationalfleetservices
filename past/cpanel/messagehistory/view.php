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

$sno=$_REQUEST["id"];

$sql="SELECT * FROM tmmg_messagesmaster where Title='$sno'";
$result = mysql_query($sql);
$resultsnumber = mysql_num_rows($result);
if ($resultsnumber != 0){
$myUserListText="";
while ($row = mysql_fetch_array($result)){ 
if($Title=="" && $Message==""){
$Title = $row["Title"]; 
$Message = $row["Message"]; 
$EntryDate=$row['EntryDate'];
}
$UserID = $row["UserID"]; 
$sql1="SELECT Username,FirstName,LastName FROM tmmg_usermaster where sno=$UserID";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_array($result1);

$Username = $row1["Username"]; 
$FirstName = $row1["FirstName"]; 
$LastName = $row1["LastName"]; 

$myUserList="<b>$FirstName $LastName</b>($Username)";
$myUserListText="$myUserListText$myUserList<br>";
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
<script language="JavaScript" type="text/javascript" src="editorFiles/wysiwyg.js">
</script>

<SCRIPT language=javascript src=../include/myfunctions.js></SCRIPT>

<script language="javascript" type="text/javascript">
<!--

function validateForm(){

//code part will work as a required field validator control
var myObjects=new Array();
var myObjectsWhatCompare=new Array();
var myObjectsCheckingValue=new Array();
var myObjectsErrorMessage=new Array();

myObjects[0]=document.all.OfferTitle;
myObjectsWhatCompare[0]=document.all.OfferTitle.value;
myObjectsCheckingValue[0]="";
myObjectsErrorMessage[0]="Please Enter the Offer Title";

for (i=0;i<myObjects.length;i++){
if(myObjectsWhatCompare[i]==myObjectsCheckingValue[i]){
document.all.errorMessage.innerHTML=myObjectsErrorMessage[i];
myObjects[i].focus();
return false;
}
}
//end block

}


//-->
</script>
<script language="javascript" type="text/javascript" src="../include/required_functions.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css">

</head>

<body onLoad="changeScrollbarColor();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="76%" class="headGray">
			View
			Sent messages module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="block.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="4" class="bHead">View Sent Messages Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="242" height="30"><strong>Message Subject </strong>
                      </td>
                    <td width="711"><?php echo $Title;?></td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30" valign="top"><strong>Users List </strong></td>
                    <td valign="top"><?php echo $myUserListText; ?></td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Message Preview </strong></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30" colspan="2"><?php echo $Message; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php 
				  list ($year, $month, $day) =  explode('-', $EntryDate);
				  $EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
				  ?>
				  
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Sending Date </strong></td>
                    <td><?php echo $EntryDate;?></td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr class="tablesRowBG_1">
                    <td width="20">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td><div align="right"><a href="list.php" class="tableInner">View All</a></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  
                </table>
              </form>
              </td>
          </tr>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><a href="javascript:history.back();"><img src="../images/BACK.jpg" alt="Back" width="38" height="33" border="0"></a></td>
                  <td><div align="right"><a href="javascript:history.forward();"><img src="../images/FORWARD.jpg" alt="Forward" width="38" height="33" border="0"></a></div></td>
                </tr>
              </table>
