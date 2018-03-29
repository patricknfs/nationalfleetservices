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
$sno=$_REQUEST["id"];

$sql="SELECT * FROM ".TABLE_NEWSLETTER." where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$resultsnumber = mysql_num_rows($result);
if ($resultsnumber != 0)
{
$Username = $row["Username"]; 
$FirstName = $row["FirstName"]; 
$LastName = $row["LastName"]; 
$Password = $row["Password"];
$CompanyName=$row['CompanyName'];
$Address=$row['Address'];
$City=$row['City'];
$State=$row['State'];
$Zip=$row['Zip'];
$Country=$row['Country'];
$OfficePhone=$row['OfficePhone'];
$MobilePhone=$row['MobilePhone'];
$HowYouHear=$row['HowYouHear'];
$HowYouHear_Other=$row['HowYouHear_Other'];
$EntryDate=$row['EntryDate'];
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
			User module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="block.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="4" class="bHead">View User  Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="242" height="30"><strong>Username</strong>
                      </td>
                    <td width="711"><?php echo $Username;?></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Full Name </strong></td>
                    <td><?php echo "$FirstName $LastName";?></td>
                    <td>&nbsp;</td>
                  </tr>

				 <?php if($CompanyName!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Company Name</strong></td>
                    <td><?php echo $CompanyName; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>

				 <?php if($Address!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Address</strong></td>
                    <td><?php echo $Address; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
				 <?php if($City!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>City</strong></td>
                    <td><?php echo $City; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
				 <?php if($State!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>State</strong></td>
                    <td><?php echo $State; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
				 <?php if($Zip!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Zip</strong></td>
                    <td><?php echo $Zip; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Country</strong></td>
                    <td><?php echo $Country; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  
				 <?php if($OfficePhone!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Office Phone</strong></td>
                    <td><?php echo $OfficePhone; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
				 <?php if($MobilePhone!=""){?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Mobile Phone</strong></td>
                    <td><?php echo $MobilePhone; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>How did you hear about us</strong></td>
                    <td><?php echo $HowYouHear; ?><?php if ($HowYouHear_Other!=""){echo ", $HowYouHear_Other";}?></td>
                    <td>&nbsp;</td>
                  </tr>

				  <?php 
				  list ($year, $month, $day) =  explode('-', $EntryDate);
				  $EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
				  ?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30"><strong>Registration Date</strong></td>
                    <td><?php echo $EntryDate; ?></td>
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
