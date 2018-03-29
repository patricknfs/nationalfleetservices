<?php
include_once("../include/application-top.php");
include_once("../include/classes/class.testimonial.php");

$dbObj = new DB();
$dbObj->fun_db_connect();
$objTst = new Testimonial();

$testi = $_REQUEST['testimonial_id'];
if($_GET['action']=="EDIT"){
	$tstDets = $objTst->funGetTestimonialInfo($testi);
	$headTitle = "Edit Testimonial";
	$buttonTxt = "Update";
	$securityKey = md5("EDITTESTIMONIAL");
}else{
	$headTitle = "Create Testimonial";
	$buttonTxt = "Submit";
	$securityKey = md5("ADDTESTIMONIAL");
}

if($_POST['SAVE'] == "Submit" || $_POST['SAVE'] == "Update"){
	if($_POST['securityKey']==md5("ADDTESTIMONIAL")){ // add new testimonial page
		$affectedRows = $objTst->processTestimonial('', 'ADD');
		if($affectedRows < 0){
			$msg = "Unable to create Testimonial page! Please try again.";
			$msgType = "1";
		}else{
			$msg = "A Testimonial page has been created successfully!";
			$msgType = "2";
		}
	}
	if($_POST['securityKey']==md5("EDITTESTIMONIAL")){ // EDIT terms page
		$affectedRows = $objTst->processTestimonial($testi, 'EDIT');
		if($affectedRows < 0){
			$msg = "Unable to edit Testimonial page! Please try again.";
			$msgType = "1";
		}else{
			$msg = "Testimonial page has been updated successfully!";
			$msgType = "2";
		}
	}
	redirectURL("index.php?action=EDIT&testimonial_id=1&msg=".urlencode($msg));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fleet Street : Control Panel</title>
<link href="../include/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="editorFiles/wysiwyg.js" type="text/javascript"></script>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
  
  <tr>
    <td>
	 <form name="frmTst" method="post" action="" >
     <input type="hidden" name="securityKey" value="<?php echo $securityKey?>">
	 <input type="hidden" name="testimonial_id" value="<?php echo $testi?>">
	<table width="100%" cellpadding="0" cellspacing="0" class="bg">
      <tr>
        <td align="left" colspan="7" class="headGray">&nbsp;<img src="../images/on.gif" alt="as" width="16" height="16" />&nbsp;Testimonial Module </td>
      </tr>
	
      <tr>
        <td colspan="7" align="center" class="bText_1">
		<?php if($_REQUEST['msg'] != ''){?>
		<img src="../images/att.gif" border="0"/>&nbsp;<?php echo $_REQUEST['msg']?>
		<?php }?>
		</td>
      </tr>
      <tr>
        <td colspan="7" class="bHead"> &nbsp;&nbsp; <?php echo $headTitle?> </td>
      </tr>
      <tr>
        <td colspan="7" class="headGray">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="21%" align="right" valign="top" class="bHead">&nbsp;  </td>
            <td width="79%">
			 <TEXTAREA class="textAreabox" id="testimonial_text" name="testimonial_text" rows=15 cols=90>
				<?php echo $tstDets['testimonial_text']?>
			  </TEXTAREA>
			  <script language="javascript1.2">
				generate_wysiwyg('testimonial_text');
			  </script>		
			</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="submit" name="SAVE" value="<?php echo $buttonTxt?>" class="button1" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7"><div align="right"><a href="javascript: history.go(-1);" class="bText_link">Back</a></div></td>
      </tr>
    </table>
</form></td>
  </tr>
</table>
</body>
</html>