<?php
require_once("../include/application-top-inner.php");
require_once("../include/classes/class.Zone.php");

// category object
$objZone = new Zone();

if(!empty($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}

$zID = $_REQUEST['zID'];

if($_GET['action']=="EDIT"){
	$zoneDetails = $objZone->funGetZoneInfo($zID);
	$headTitle = "MODIFY LOCATION DETAILS";
	$buttonTxt = "Update";
	$securityKey = md5("MODIFYZONE");
}else{
	$headTitle = "ADD NEW LOCATION";
	$buttonTxt = "Submit";
	$securityKey = md5("ADDZONE");
}

if($_POST['submit'] == "Submit" || $_POST['submit'] == "Update"){
	if($_POST['securityKey']==md5("ADDZONE")){ // add new 
		$affectedRows = $objZone->processZone();
		if($affectedRows < 0){
			$msg = "Unable to add Location! Please try again.";
			$msgType = "1";
		}else{
			$msg = "Location has been added successfully!";
			$msgType = "2";
		}
	}
	if($_POST['securityKey']==md5("MODIFYZONE")){ // EDIT 
		$affectedRows = $objZone->processZone($zID, 'EDIT');
		if($affectedRows < 0){
			$msg = "Unable to edit zone details! Please try again.";
			$msgType = "1";
		}else{
			$msg = "Location details has been updated successfully!";
			$msgType = "2";
		}
	}
	redirectURL("list.php?msgtype=".$msgType."&msg=".urlencode($msg) . "&page=" . $page);
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WEB ADMIN SECTION</title>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../include/js/required_functions.js"></script>
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

function showHideRows(vals){
 	//vals = parseInt(vals);
	for(i=1;i<=3;i++){
		tmpId = document.getElementById("zrID"+i);
		if(vals=="1"){
			tmpId.className = 'tablesRowBG_2 hideMe';
		}else{
			tmpId.className = 'tablesRowBG_2 showMe';
		}
	}
}

function validateForm(){
//code part will work as a required field validator control
	var frm = document.zoneFrm;
	if(frm.zone_name.value==""){
		alert("Error: Please enter location name");
		frm.zone_name.focus();
		return false;
	}
	
	if(frm.zone_weight_limit.value==""){
			alert("Error: Please enter location weight limit");
			frm.zone_weight_limit.focus();
			return false;
		}
	if(isNaN(frm.zone_weight_limit.value)){
			alert("Error: Invalid location weight limit");
			frm.zone_weight_limit.focus();
			return false;
		}
	return true;
//end block

}


function showImage(){
document.getElementById('ImagePreview').src=document.getElementById('category_image').value;
}


//-->
</script>

<style type="text/css">
	.showMe{
		visibility:visible;
	}
	.hideMe{
		display:none;
	}
</style>

</head>

<body onLoad="changeScrollbarColor();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="25">&nbsp;</td>
            <td class="headGray">&nbsp;</td>
            <td class="tableHead">&nbsp;</td>
          </tr>
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="76%" class="headGray"><?php echo $headTitle;?></td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="" method="post" name="zoneFrm" onSubmit="return validateForm();">
			  <input type="hidden" name="securityKey" value="<?php echo $securityKey?>">
			  <input type="hidden" name="zID" value="<?php echo $zID?>">
			  <input type="hidden" name="au_id" value="<?php echo $_SESSION['session_admin_userid']?>">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr  class="top_row">
                    <td height="20" colspan="5" class="bHead">&nbsp;Location Module</td>
                  </tr>
                  <tr class="tablesRowBG_1">
                    <td height="25" colspan="5"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                  </tr>
				  
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="215" height="30">Location Name (<span class="style1">*</span>)</td>
                    <td colspan="2"><input name="zone_name" maxlength="80" style="width:150px" type="text" class="textbox_long" id="zone_name" value="<?php echo $zoneDetails['zone_name']; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
				 

				 <tr class="tablesRowBG_2">
                    <td width="11">&nbsp;</td>
                    <td height="30">Location Status</td>
                    <td colspan="2"><input type="checkbox" name="zone_status" value="1" style="border:none" <?php if($zoneDetails['zone_status']=="1"){?> checked<?php }?>>                      
                       (Checked=Shown; Uncheck=Hidden);					</td>
                    <td width="12">&nbsp;</td>
                 </tr>
				
                  <?php 
				  if($zID!=""){
				  ?>
				  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Last Modified</td>
                    <td colspan="2"><?php echo fun_site_date_format($zoneDetails['last_modified_date']); ?></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Creation Date </td>
                    <td colspan="2"><?php echo fun_site_date_format($zoneDetails['added_date']); ?></td>
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
                      <input name="submit" type="submit" class="Button1" value="<?php echo $buttonTxt?>"> 
                      &nbsp;
                      <input name="button" type="reset" class="Button1" value="Cancel" onClick="javascript: document.location.href='list.php?page=<?php echo $page?>&cPath=<?php echo $cID?>'">
                    </div></td>
                    </tr>
                </table>
              </form>              </td>
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
