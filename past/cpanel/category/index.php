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

if($sno!=""){
$sql="SELECT * FROM ".TABLE_MAKES." where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//getting data from the database into local variables
$CategoryName=$row["CategoryName"];
$vtype = $row['vehicle_type'];
$Descriptions=$row["Descriptions"];
$FullImage=$row["FullImage"];

$EntryDate=$row["EntryDate"];
//Let me now get the different fields.
list ($year, $month, $day) =  explode('-', $EntryDate);
//Now i apply the date function 
$EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
}

if($FullImage==""){
$FullImageView="../../uploads/nofound.gif";
}
else{
$FullImageView="../../uploads/$FullImage";
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
<script language="javascript" type="text/javascript">
<!--

function formValidation(){
//code part will work as a required field validator control
var frm = document.form1; 
if(frm.CategoryName.value == ''){
	alert('Please enter make name');
	return false;
}

return true;
//end block
}


function showImage(){
document.getElementById('ImagePreview').src=document.getElementById('FullImage').value;
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
			<?php
			if ($sno!=""){ 
			echo "Modify ";
			}
			else{
			echo "Add ";
			}
			?>
			make module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="return formValidation();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr  class="top_row">
                    <td height="20" colspan="5" class="bHead">&nbsp;Make Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="5"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
				  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="172" height="30">Make Name (<span class="style1">*</span>)</td>
                    <td colspan="2"><input name="CategoryName" type="text" class="textbox_long" id="CategoryName" value="<?php echo $CategoryName; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td width="11">&nbsp;</td>
                    <td height="30">Description</td>
                    <td colspan="2"><input name="Descriptions" type="text" class="textbox_long" id="Descriptions" value="<?php echo $Descriptions; ?>">
					</td>
                    <td width="12">&nbsp;</td>
                  </tr>
				 
                  <!--tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Image</td>
                    <td colspan="2"><input name="FullImage" type="file" class="textbox" id="FullImage" onChange="showImage();"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Image Preview </td>
                    <td width="129"><img src="<?php echo $FullImageView; ?>" name="ImagePreview" id="ImagePreview"><span class="pagiinText">
                      <input name="H_FullImage" type="hidden" class="txtBox" id="H_FullImage" value="<? echo $FullImage;?>">
                    </span></td>
                    <td width="685" valign="bottom">
					<?php if ($FullImage!="") {?>
					<input name="ImageAction" type="radio" value="1" checked >Keep this Image<br>
 					<input name="ImageAction" type="radio" value="2">
  					<span class="heading">Replace this Image </span><br>
  					<input name="ImageAction" type="radio" value="3">
  					<span class="heading">Delete this Image </span>
					<?php } ?>
					</td>
                    <td>&nbsp;</td>
                  </tr-->
				  <?php 
				  if($sno!=""){
				  ?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Creation Date </td>
                    <td colspan="2"><?php echo $EntryDate; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
                  <tr class="tablesRowBG_1">
                    <td width="11">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td colspan="2"><div align="right"><a href="list.php" class="tableHead">View All</a></div></td>
                    <td width="12">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="5"  class="top_row"><div align="center">
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
