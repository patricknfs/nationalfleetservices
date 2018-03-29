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

if($sno!=""){
$sql="SELECT * FROM tmmg_feedbackmaster where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//getting data from the database into local variables
$Feedback=$row['Feedback'];
$ServiceInfo =$row['ServiceInfo'];
$UserID =$row['UserID'];
$FeedbackResponse=$row['FeedbackResponse'];

$ResponseDate=$row["ResponseDate"];
$EntryDate=$row["EntryDate"];
//Let me now get the different fields.
list ($year, $month, $day) =  explode('-', $EntryDate);
//Now i apply the date function 
$EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));



$query1 = "select FirstName,LastName from tmmg_usermaster where sno=$UserID";  
$result1 = mysql_query($query1);  
$row1 = mysql_fetch_array($result1);
$FirstName = $row1['FirstName'];
$LastName = $row1['LastName'];
$myFullName = "$FirstName $LastName";


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
.style1 {color: #FF0000}
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
			/Respond Feedbackmodule </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="4" class="bHead">View/Respond Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="138" height="30">Feedback from User<br>
                      (<strong><?php echo $myFullName;?></strong>)</td>
                    <td><strong><?php echo $Feedback;?></strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30" valign="top">I Want more Information on </td>
                    <td valign="top"><strong><?php echo $ServiceInfo;?></strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td width="20">&nbsp;</td>
                    <td height="30" valign="top">Response Message   (<span class="style1">*</span>) </td>
                    <td valign="top">
					<textarea id="FeedbackResponse" name="FeedbackResponse" style="height: 170px; width: 500px;">
					<?php echo $FeedbackResponse; ?>
					</textarea>
					<script language="javascript1.2">
					  generate_wysiwyg('FeedbackResponse');
					</script>
					
					</td>
                    <td width="20">&nbsp;</td>
                  </tr>
				  
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Feedback Date </td>
                    <td><?php echo $EntryDate; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php 
				  if($ResponseDate!="0000-00-00 00:00:00"){
				  list ($year, $month, $day) =  explode('-', $ResponseDate);
				  $ResponseDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
				  ?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Last Updation Date </td>
                    <td><?php echo $ResponseDate; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
                  <tr class="tablesRowBG_1">
                    <td width="20">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td><div align="right"><a href="list.php" class="tableInner">View All</a></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="4" class="tablesRowHeadingBG"><div align="center">
                      <input name="Submit" type="submit" class="Button1" value="Submit"> 
                      &nbsp;
                      <input name="Reset" type="reset" class="Button1" value="Reset">
                    </div></td>
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
                  <td><a href="javascript:history.back();"><img src="../images/BACK.jpg" alt="Back" width="38" height="33" border="0"></a></td>
                  <td><div align="right"><a href="javascript:history.forward();"><img src="../images/FORWARD.jpg" alt="Forward" width="38" height="33" border="0"></a></div></td>
                </tr>
              </table>
