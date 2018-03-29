<?php 
include("newincludes/ratebookswitcher.php");
include ("includes/application-top.php");
require_once("cpanel/include/classes/class.Make.php");
require_once("cpanel/include/classes/class.Model.php");

$objMake = new Make();
$objModel = new Models();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Quotation - Cheap Contract Hire Audi in UK, Cheap Van Contract Hire in UK & Used Car Contract Hire UK</title>
<meta name="keywords" content="Quotation, Cheap Contract Hire Audi in UK, Cheap Van Contract Hire in UK, Used Car Contract Hire UK" />
<meta name="description" content="Get a quotation for Cheap Contract Hire Audi in UK, Cheap Van Contract Hire in UK & Used Car Contract Hire UK." />
<link href="style/fleetStreetLtd.css" rel="stylesheet" type="text/css" />
<script src="includes/validationfun.js" language="javascript" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
<!--
var MDArray = new Array();
<?php
$objModel->funModelJavascriptCode();
?>
function funSetModel(mkVals, mdVals){
	var tmpID = document.getElementById("model_id");
	var cnt = 1;
	removeItemsFromSelect("model_id");		
	tmpID.options[0] = new Option("Select Model", "");
	for(i=0;i<MDArray.length;i++){
		if(mkVals){
			if(parseInt(MDArray[i][2])==parseInt(mkVals)){
				tmpID.options[cnt] = new Option(MDArray[i][1], MDArray[i][0]);
				if(mdVals!=""){
					if(parseInt(MDArray[i][0])==parseInt(mdVals)){
						tmpID.options[cnt].selected = true;
					}
				}
				cnt++;
			}
		}
	}
}
function removeItemsFromSelect(itemId){
	var tmpID = document.getElementById(itemId);
	for(i=tmpID.options.length;i>=0;i--){
		tmpID.options[i] = null;
	}
}
-->
</script>
</head>
<body onload="MM_preloadImages('images/welcome-hover.jpg','images/business-hover.jpg','images/personal-hover.jpg','images/commercial-hover.jpg','images/daily-hover.jpg','images/prestige-hover.jpg','images/about-hover.jpg','images/fleet-hover.jpg','images/faq-hover.jpg','images/contact-hover.jpg','images/quotation-hover.jpg')">
<table width="1000" border="0" cellpadding="0" cellspacing="0" id="center-table">
  <tr>
    <td colspan="7"><?php include("includes/header-image.php")?></td>
  </tr>
  <tr>
    <td width="10"><img src="images/spacer.gif" width="15" height="1" /></td>
    <td valign="top">
	<? include($rate_left_panel); ?>
    </td>
    <td valign="top"><img src="images/spacer.gif" alt="spacer" width="9" height="1" /></td>
    <td valign="top">
	<!-- body content start here -->
	<table width="552" border="0" cellspacing="0" cellpadding="0">
   
      <tr>
        <td width="1061"><img src="images/box-top.jpg" width="552" height="8" /></td>
      </tr>
      <tr>
        <td background="images/box-middle.jpg" class="model_name padding">Quotation<br /><br />
			<p class="txt">To request a quotation, please use the form below.</p>
		</td>
      </tr>
      <tr>
        <td><img src="images/box-bottom.jpg" width="552" height="10" /></td>
      </tr>
      <tr>
        <td><img src="images/spacer.gif" width="20" height="10" /></td>
      </tr>	
      <td colspan="2"><img src="images/box-top.jpg" width="552" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" class="box-middle"><img src="images/spacer.gif" alt="spacer" width="9" height="1" />
           <form name="quotation" action="thanks.php" method="post" onsubmit="javascript: return qutValidateForm();">
		   <input type="hidden" name="QUOTATION" value="<?php echo md5("ASHWANI")?>" />
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%">
                  <tr>
                    <td width="50%" class="font11">Make<?php echo SITE_MANDATORY_FIELDS?></td>
                    <td width="50%" class="font11">Contract Period<?php echo SITE_MANDATORY_FIELDS?></td>
                  </tr>
                  <tr>
                    <td class="txt padlft10"><label>
                     <select name="make_id" class="enquiry" onChange="javascript: funSetModel(this.value, '');">
                        <option value="">Choose Make</option>
						<?php 
							$objMake->fun_MakeOptions($ofrDetail['make_id'])
						?>
                      </select>
                    </label></td>
                   <td class="txt padlft10"><label>
                      <select name="period" id="period" class="enquiry">
                       <option value="">Choose Period</option>
					    <option value="1"> 1 month</option> 
						<option value="3"> 3 months</option> 
						<option value="6"> 6 months</option> 
						<option value="12"> 12 months</option> 
						<option value="18"> 18 months</option> 
						<option value="24"> 24 months</option> 
						<option value="36"> 36 months</option> 
						<option value="48"> 48 months</option> 
					   <option value="999">Flexible</option>
                      </select>
                    </label></td>
                  </tr>
                  <tr>
                  	<td height="5"></td>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td class="font11">Model<?php echo SITE_MANDATORY_FIELDS?></td>
                    <td class="font11">Contract Type<?php echo SITE_MANDATORY_FIELDS?></td>
                  </tr>
                  <tr>
                    <td class="txt padlft10"><label>
                     <select name="model_id" id="model_id" class="enquiry">
					  <option value=""> Choose Model </option>
					 </select>
                    </label></td>
                    <td class="txt padlft10"><label>
                      <select name="contype" id="contype" class="enquiry">
                        <option selected="selected" value="">Choose Type</option>
						<option value="Business">Business</option>
						<option value="Personal">Personal</option>
						<option value="Commercial">Commercial</option>
						<option value="Daily Rental">Daily Rental</option>
						<option value="Prestige">Prestige</option>
                      </select>
                    </label></td>
                  </tr>
                  <tr>
                    <td height="5"></td>
                    <td height="5"></td>
                  </tr>
                  <tr>
                    <td class="font11">Derivative</td>
                    <td class="font11">Annual Mileage</td>
                  </tr>
                  <tr>
                    <td class="txt padlft10"><label>
                      <select name="derivative" id="derivative" class="enquiry">
                        <option value="">Choose Derivative</option>
                        </select>
                    </label></td>
                    <td class="padlft10"><label>
                    <input type="text" class="enquiry" name="annualmilage" id="annualmilage" />
                    </label></td>
                  </tr>
                  <tr>
                    <td height="20"></td>
                    <td height="20"></td>
                  </tr>
                  <tr>
	                    <td class="font11">First Name<?php echo SITE_MANDATORY_FIELDS?></td>
                        <td class="font11">Email<?php echo SITE_MANDATORY_FIELDS?></td>
    	             </tr>
                  <tr>
                    <td class="padlft10"><input type="text" class="enquiry" name="firstname" id="firstname" /></td>
                    <td class="padlft10"><input type="text" class="enquiry" name="email" id="email" /></td>
                  </tr>
                  <tr>
                    <td class="font11">Last Name</td>
                    <td class="font11">Phone<?php echo SITE_MANDATORY_FIELDS?></td>
                  </tr>
                  <tr>
                    <td class="padlft10"><input type="text" class="enquiry" name="lastname" id="lastname" /></td>
                    <td class="padlft10"><input type="text" class="enquiry" name="phone" id="phone" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="font11">Extra Information<?php echo SITE_MANDATORY_FIELDS?></td>
                    </tr>
                  <tr>
                    <td colspan="2" class="padlft10"><label>
                      <textarea name="extrainfo" class="width520" id="extrainfo" cols="45" rows="5"></textarea>
                    </label></td>
                    </tr>
                  <tr>
                    <td class="txt padlft10"><label>
                      <input type="submit" name="button" id="button" value="Submit" />
                    </label></td>
                    <td class="txt padlft10">&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
               <tr>
        <td><img src="images/box-bottom.jpg" width="552" height="10" /></td>
      </tr>
     </table>
	</form>
	</td>
         
      </table>
	<!-- body content end here -->
	
	</td>
    <td valign="top"><img src="images/spacer.gif" alt="spacer" width="9" height="1" /></td>
    <td valign="top">
	<?php include("includes/right-include.php")?>
	</td>
    <td width="10"><img src="images/spacer.gif" alt="spacer" width="15" height="1" /></td>
  </tr>
  
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#C0C0C0"><img src="images/spacer.gif" width="1" height="2" /></td>
  </tr>
  <tr>
    <td colspan="7">
	<?php include("includes/footer-include.php")?>
	</td>
  </tr>
</table>
</body>
</html>
