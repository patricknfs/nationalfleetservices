<?php
include ("../include/application-top.php");
require_once("../include/classes/class.Make.php");
require_once("../include/classes/class.Model.php");
require_once("../include/classes/class.Offers.php");

$objMake  = new Make();
$objModel = new Models();
$objOfr   = new Offers();

$action   = $_REQUEST['action'];
$key      = $_REQUEST['securityKey'];
$ofrID    = $_REQUEST['ofrID'];

if($action == 'EDIT'){
	$ofrDetail = $objOfr->funGetOfferInfo($ofrID);
	$head      = 'EDIT OFFERS';
	$button    = 'Submit';
	$typeKey   = 'MODIFY';
}else{
	$head      = 'ADD OFFERS';
	$button    = 'Add Offers';	
	$typeKey   = 'ADDNEW';	
}

if($key == md5('PRADHAN')){
	if($typeKey == 'ADDNEW'){
		$rowsAffectd = $objOfr->processOffers();
		if($rowsAffectd < 0){
			$msg = 'Your offer could not added! Try again';
		}else{
			$msg ='Your offer is added successfuly';
			redirectURL("list.php?msg=".urlencode($msg));
		} 
	}
	if($typeKey == 'MODIFY'){
		$rowsAffectd = $objOfr->processOffers($ofrID, 'EDIT');
		if($rowsAffectd < 0){
			$msg = 'Unable to edit offer details! Please try again.';
		}else{
			$msg ='Offer details have been updated successfully!';
			redirectURL("list.php?msg=".urlencode($msg));
		} 
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome : <?php echo $head?></title>
<link href="../include/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="editorFiles/wysiwyg.js"></script>
<script language="javascript1.2" type="text/javascript">
	var MDArray = new Array();
	<?php $objModel->funModelJavascriptCode();?>
	function funSetModel(mkVals, mdVals){
		var tmpID = document.getElementById("model_id");
		var cnt   = 1;
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

	function frmValidation(){
		var frm = document.frmAdd;
		if(frm.make_id.value==''){
			alert('Error! Please Select Make');
			frm.make_id.focus();
			return false;
		}
		if(frm.model_id.value==''){
			alert('Error! Please Select Model');
			frm.make_id.focus();
			return false;
		}
		var finance = false
		for(var i=0 ; i < frm.finance_type.length; i++){
			if(frm.finance_type[i].checked){
				finance = true; 
			}
		}
		if(!finance){
			alert("Please select a finance type.");
			frm.finance_type[0].focus();
			return false;
		}
		if(frm.offer_varient.value==''){
			alert('Error! Please enter variant');
			frm.offer_varient.focus();
			return false;
		}
		if(frm.offer_details.value==''){
			alert('Error! Please enter Details');
			frm.offer_details.focus();
			return false;
		}
		if(frm.offer_price.value==''){
			alert('Error! Please enter Price');
			frm.offer_price.focus();
			return false;
		}
		if(isNaN(frm.offer_price.value)){
			alert('Error! Please enter number');
			frm.offer_price.focus();
			return false;
		}
		var price = false
		for(var i=0 ; i < frm.price_type.length; i++){
			if(frm.price_type[i].checked){
				price = true; 
			}
		}
		if(!price){
			alert("Please choose a Price type option.");
			frm.price_type[0].focus();
			return false;
		}
		return true;
	}
</script>
<SCRIPT language=JavaScript>
	function win(){
		window.opener.location.href="index.php?p=view-offers";
		self.close();
	}
</SCRIPT>
</head>
<body>
<table width="98%"  border="0" cellspacing="0" cellpadding="0">
	<form action="" method="post" name="frmAdd" enctype="multipart/form-data" onSubmit="return frmValidation();">
		<input type="hidden" name="dealer_id" value="">
		<input type="hidden" name="securityKey" value="<?php echo md5('PRADHAN');?>">
		<input type="hidden" name="offer_id" value="<?php echo $ofrID?>">
		<tr>
			<td colspan="4" class="headGray">&nbsp;<img src="../images/on.gif" alt="Home" border="0" height="16" width="16">&nbsp;<?php echo $head?></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" align="right" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td width="19%" align="right" class="bHead">Make <?php echo SITE_MANDATORY_FIELDS?>:</td>
			<td width="1%">&nbsp;</td>
			<td colspan="2">
				<select name="make_id" class="textbox"  onChange="javascript: funSetModel(this.value, '');">
					<option value=""> Select Make </option>
					<?php 
					$objMake->fun_MakeOptions($ofrDetail['make_id'])
					?>
				</select>	
			</td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" class="matter1"><span class="bText">Please select Make from list above e.g. BMW</span> </td>
		</tr>
		<tr>
			<td align="right" class="bHead">Model <?php echo SITE_MANDATORY_FIELDS?>:</td>
			<td>&nbsp;</td>
			<td colspan="2">
				<select name="model_id" id="model_id" class="textbox">
					<option value=""> Select Model </option>
				</select>
				<script language="javascript" type="text/javascript">
					funSetModel('<?php echo $ofrDetail["make_id"]?>', '<?php echo $ofrDetail["model_id"]?>');
				</script>
			</td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2"><span class="bText">Please select model of Make from list above e.g. Alpina </span></td>
		</tr>
		<tr>
			<td height="35" align="right" class="tdSubTxt"><b class="bHead">Finance Type  <?php echo SITE_MANDATORY_FIELDS?>:</b></td>
			<td>&nbsp;</td>
			<td colspan="2" class="bText">
				<input type="radio" name="finance_type" value="1" align="absmiddle" <?php if($ofrDetail['finance_type'] == 1){ echo 'checked';}?>>&nbsp;Business&nbsp;&nbsp;
				<input type="radio" name="finance_type" value="2" align="absmiddle" <?php if($ofrDetail['finance_type'] == 2){ echo 'checked';}?>>&nbsp;Personal&nbsp;
				<input type="radio" name="finance_type" value="3" align="absmiddle" <?php if($ofrDetail['finance_type']==3){ echo 'checked';}?>>&nbsp;Commercial&nbsp;&nbsp;
				<input type="radio" name="finance_type" value="4" align="absmiddle" <?php if($ofrDetail['finance_type'] == 4){ echo 'checked';}?>>&nbsp;Daily Rental&nbsp;&nbsp;
				<?php if($typeKey <> 'MODIFY'){?>
				<input type="radio" name="finance_type" value="5" align="absmiddle" <?php if($ofrDetail['finance_type'] == 5){echo 'checked';}?>>&nbsp;Business &amp; Personal
				<?php }?>
			</td>
		</tr>
		<tr>
			<td align="right" class="bHead">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="bHead">Variant <?php echo SITE_MANDATORY_FIELDS?>:</td>
			<td>&nbsp;</td>
			<td colspan="2"><input name="offer_varient" type="text" class="textbox_long" maxlength="100" style="width:300px;" value="<?php echo $ofrDetail['offer_varient']?>"></td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" class="bText">Varient must only include specific model names e.g. 320i SE Auto. Maximum 100 characters. </td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td width="23%" rowspan="5">
				<?php if($ofrDetail['offer_image']!=""){?>
					<img src="../../offers/<?php echo $ofrDetail['offer_image']?>" width="150px" height="100">
				<?php } ?>
				<input name="thumb_old" type="hidden" class="txtBox" id="category_thumb_old" value="<?php echo $ofrDetail['offer_image']?>">
			</td>
		</tr>
		<tr>
			<td rowspan="2" align="right" valign="top" class="bHead">Image:</td>
			<td rowspan="2">&nbsp;</td>
			<td width="57%"><input type="file" name="offer_image" size="40"></td>
		</tr>
		<tr>
			<td class="bText">
			<?php if($ofrDetail['offer_image']!=""){?>
				<input name="thumbChangeAction" type="radio" value="1" checked >Keep this Image&nbsp;&nbsp;
				<input name="thumbChangeAction" type="radio" value="2">
				<span class="heading">Replace this Image </span>&nbsp;&nbsp;
				<input name="thumbChangeAction" type="radio" value="3">
				<span class="heading">Delete this Image </span>
			<?php } ?>	
			</td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td class="bText">&nbsp;Upload thumbnail image (162 X 82 px.) </td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td align="right" valign="top" class="bHead">Details <?php echo SITE_MANDATORY_FIELDS?>:</td>
			<td>&nbsp;</td>
			<td colspan="2">
				<div style="background-color:#FFFFFF; width:550px;">
					<textarea name="offer_details" id="offer_details" style="background-color:#FFFFFF;">
					<?php echo $ofrDetail['offer_details']?>
					</textarea>
				</div>
				<script language="javascript1.2">
				generate_wysiwyg('offer_details');
				</script>	
			</td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2" class="bText">Details must include all specifications.</td>
		</tr>
		<tr>
			<td align="right" class="bHead">Price &pound; <?php echo SITE_MANDATORY_FIELDS?>:</td>
			<td></td>
			<td colspan="2" class="bText">
				<input name="offer_price" type="text" class="textbox" maxlength="10" style="width:50px;" value="<?php echo $ofrDetail['offer_price']?>">&nbsp;&nbsp;
				<input type="radio" name="price_type" value="1" align="absmiddle"  <?php if($ofrDetail['price_type'] == 1) echo 'checked';?>>Monthly&nbsp;&nbsp;
				<input type="radio" name="price_type" value="2" align="absmiddle"  <?php if($ofrDetail['price_type'] == 2) echo 'checked';?> >Weekly&nbsp;&nbsp;
				<input type="radio" name="price_type" value="3" align="absmiddle"  <?php if($ofrDetail['price_type'] == 3) echo 'checked';?> >&nbsp;Daily 
			</td>
		</tr>
		<tr>
			<td align="right" class="bHead">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" class="bHead">Link to deal http:// : </td>
			<td>&nbsp;</td>
			<td colspan="2"><input name="offer_link" type="text" class="textbox" maxlength="200" style="width:300px;" value="<?php echo $ofrDetail['offer_link']?>"></td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">
				<input name="Submit" type="submit" class="Button1" value="<?php echo $button?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input name="set" type="reset" class="Button1" value="Cancel" onClick="javascript: history.go(-1);">
			</td>
		</tr>
		<tr>
			<td align="right" class="tdSubTxt">&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
	</form>
</table>
</body>
</html>