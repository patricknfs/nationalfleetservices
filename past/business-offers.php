<?php 
include("newincludes/ratebookswitcher.php");

require_once("includes/application-top.php");
require_once("cpanel/include/classes/class.Make.php");
require_once("cpanel/include/classes/class.Model.php");
require_once("cpanel/include/classes/class.Offers.php");

$dbObj = new DB();
$dbObj->fun_db_connect();
$objOfr = new Offers();

function imageResize($width, $height, $target){
	//if($width > $height){
		$percentage = ($target / $width);
	//}else{
		$percentage = (65 / $height);
	//}
	$width  = round($width * $percentage);
	$height = round($height * $percentage);
	return "width=\"$width\" height=\"$height\"";
}



/*if(isset($_SESSION['sess_dealer_id'])){
	$dlID = $_SESSION['sess_dealer_id'];
}

$ofrObj = new Offers();
$objMk = new Make();
$objMdl = new Models();

if(isset($_REQUEST['makeID'])){
	$mkID = $_REQUEST['makeID'];
}
if(isset($_REQUEST['modelID'])){
	$mdlID = $_REQUEST['modelID'];
}
if(isset($_REQUEST['dealer_id'])){
	$dlID = $_REQUEST['dealer_id'];
}
if(isset($_REQUEST['cPath'])){
	$cID = $_REQUEST['cPath'];
}else{
	$cID = 0;
}

if(!empty($_REQUEST['page'])){
	$page = $_REQUEST['page'];
}else{
	$page = 1;
}

/* $limit = 10;
$start = ($page - 1) * $limit;
$sql = "SELECT * FROM " . TABLE_OFFERS." WHERE finance_type=1 " ;
$result = $dbObj->fun_db_query($sql);
$totRecords = $dbObj->fun_db_get_num_rows($result);
$pagelinks = pagingIndex($limit, $totRecords);
$dbObj->fun_db_free_resultset($result);
$sql .= " ORDER BY added_date DESC LIMIT $start, $limit";
$result = $dbObj->fun_db_query($sql); */

 include($business_top);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Business Car Leasing &#38; Contract Hire Deals in UK. Company Car Lease Hire Offers</title>
<meta name="keywords" content="Business car leasing contract hire company lease hire" />
<meta name="description" content="Best prices on car leasing deals &#38; contract hire offers in the UK" />
<link href="style/fleetStreetLtd.css" rel="stylesheet" type="text/css" />
</head>

<body onload="MM_preloadImages('images/welcome-hover.jpg','images/business-hover.jpg','images/personal-hover.jpg','images/commercial-hover.jpg','images/daily-hover.jpg','images/prestige-hover.jpg','images/about-hover.jpg','images/fleet-hover.jpg','images/faq-hover.jpg','images/contact-hover.jpg','images/quotation-hover.jpg')">
<table width="1000" border="0" cellpadding="0" cellspacing="0" id="center-table">
	<tr>
		<td colspan="7"><?php include("includes/header-image.php")?></td>
	</tr>
	<tr>
		<td width="10"><img src="images/spacer.gif" width="15" height="1" /></td>
		<td valign="top"><?php include($rate_left_panel); ?></td>
		<td valign="top"><img src="images/spacer.gif" alt="spacer" width="9" height="1" /></td>
		<td valign="top">
			<table width="552" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2"><img src="images/box-top.jpg" width="552" height="8" /></td>
				</tr>
				<tr>
					<td colspan="2" background="images/box-middle.jpg" class="model_name padding">
					  <h1>Business Car Leasing &#38; Contract Hire Deals</h1> 
					   
				  <p class="txt-1">Latest best deals on company car leasing prices. For business contract hire &#38; lease.</p></td>
				</tr>
				<tr>
					<td colspan="2"><img src="images/box-bottom.jpg" width="552" height="10" /></td>
				</tr>
				<tr>
					<td colspan="2"><img src="images/spacer.gif" width="20" height="10" /></td>
				</tr>
				<tr>
				<?php
				/* $cnt=1;	
				while($rows = $dbObj->fun_db_fetch_rs_object($result)){
					$mkDt = $objMk->funGetMakeInfo($rows->make_id);
					$mdlDt = $objMdl->funGetModelInfo($rows->model_id); */
				?>
					<td width="525" height="830" class="">
<?php include($business_page_offers); ?>
					</td>
				</tr>
				<!-- LIST OF OFFERS ENDS HERE -->
				<tr>
					<td colspan="2"><img src="images/spacer.gif" width="20" height="10" /></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="middle" class="type1"><?php echo $pagelinks?></td>
				</tr> 
			</table>
		</td>
		<td valign="top"><img src="images/spacer.gif" alt="spacer" width="9" height="1" /></td>
		<td valign="top"><?php include("includes/right-include.php")?></td>
		<td width="10"><img src="images/spacer.gif" alt="spacer" width="15" height="1" /></td>
	</tr>
	<tr>
		<td colspan="7">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="7" bgcolor="#C0C0C0"><img src="images/spacer.gif" width="1" height="2" /></td>
	</tr>
	<tr>
		<td colspan="7"><?php include("includes/footer-include.php")?></td>
	</tr>
</table>
</body>
</html>
