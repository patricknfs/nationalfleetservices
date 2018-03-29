<?php
require_once("../include/application-top-inner.php");
require_once("../include/classes/class.Offers.php");
require_once("../include/classes/class.Make.php");
require_once("../include/classes/class.Model.php");

$dbObj = new DB();
$dbObj->fun_db_connect();

$ofrObj = new Offers();
$objMake = new Make();
$objMdl = new Models(); 

$ofrID = $_REQUEST['ofrID'];
$action = $_REQUEST['action'];
//For Deletion of offer
if($action !='' && $ofrID !=''){
	if($action == 'DELETE'){
		$sql = "DELETE FROM ".TABLE_OFFERS." WHERE offer_id=$ofrID";
		mysql_query($sql) or die('Can Not Delete this rcord');
		$msgtype = 1;
		$msg = 'This Record deleted successfuly!';
	}
	
}
// Make Featured offers
if($_GET['feature'] == "true"){
	$sql_update = " UPDATE ".TABLE_OFFERS." SET offer_feature=1 WHERE offer_id='".$_GET['ofrid']."' ";
	$result = $dbObj->fun_db_query($sql_update);
	if($result){
		$msg = "You maked a offer featured";
	}else{
		$msg = "This offer can not be featured";
	}
}
if($_GET['feature'] == "false"){
	$sql_update = " UPDATE ".TABLE_OFFERS." SET offer_feature=0 WHERE offer_id='".$_GET['ofrid']."' ";
	$result = $dbObj->fun_db_query($sql_update);
	if($result){
		$msg = "You maked a offer unfeatured";
	}else{
		$msg = "This offer can not be unfeatured";
	}
}
//End
if(isset($_GET['cPath'])){
	$cID = $_GET['cPath'];
}else{
	$cID = 0;
}

if(!empty($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
$limit = 20;
$start = ($page - 1) * $limit;

$sql = "SELECT * FROM " . TABLE_OFFERS ;
$result = $dbObj->fun_db_query($sql);
$totRecords = $dbObj->fun_db_get_num_rows($result);
$pagelinks = paginate($limit, $totRecords);
$dbObj->fun_db_free_resultset($result);

$sql .= " ORDER BY added_date DESC LIMIT $start, $limit";
$result = $dbObj->fun_db_query($sql);
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

<script language="javascript">
function getConfirmation(getID){
	var getConfirm;
	getConfirm=confirm("\nAre you sure you want to delete this Record!!!");
	if(getConfirm==true){
		window.location = 'list.php?id=' + getID + '&page=<?php echo $page; ?>';
	}
	else{
		//return false;
	}	
}

function clearDateBox(){
document.all.EntryDate1.value='';
document.all.EntryDate2.value='';
}
</script>
</head>
<body>
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<tr>
	<td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
    <td width="71%" class="headGray">View offer module </td>
    <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?></td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<?php if($msg!=""){?>
<tr>
	<td colspan="3" align="center">
	<?php
			echo "<img src='../images/att.gif' align='absmiddle'> ";
			echo "<font class=bText face='verdana' size='2'>";
			echo $msg;
			echo "</font>";
		
	?>
	&nbsp;
	</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<?php }?>
</table>
<table cellspacing="0" cellpadding="4" width="100%" border="0">
	<tr class="top_row">
		<td height="20" colspan="7">Total Records : <?php echo $totRecords ?> </td>
	</tr>
	<tr class="tablesRowHeadingBG">
		<td width="7%" class="bHead">ID</td>
		<td width="22%" class="bHead">Offer</td>
		<td width="24%" align="center" class="bHead">Offer Price </td>
		<td width="14%" align="center" class="bHead">Added Date</td>
		<td width="18%" align="center" class="bHead">Featured Offers </td>
		<td width="15%" align="center" class="bHead">Tools</td>
	</tr>

	<?php
	$cnt = 0;
	while($rows = $dbObj->fun_db_fetch_rs_object($result)){
		$cnt++;
		if($cnt % 2 == 0){
			$alternateStyle="tablesRowBG_1";
		}else{
			$alternateStyle="tablesRowBG_2";
		}
	
	 $makeDets = $objMake->funGetMakeInfo($rows->make_id);
	 $mdlDets = $objMdl->funGetModelInfo($rows->model_id);
	?>
	<tr class="<?php echo $alternateStyle?>">
		<td><?php echo fun_db_output($rows->offer_id)?></td>
		<td><?php echo $makeDets['CategoryName']."-".$mdlDets['SubCatName']?></a></td>
		<td align="center">&pound;<?php echo $rows->offer_price?></td>
		<td align="center">
		<?php echo fun_site_date_format($rows->added_date)?></td>
		<td align="center"><?php if($rows->offer_feature == 1){?>
          <a href="list.php?feature=false&ofrid=<?php echo $rows->offer_id?>" title="click it to make unfeatured"><img src="../images/eye.gif" alt="featured" border="0"></a>
          <?php }else{?>
          <a href="list.php?feature=true&ofrid=<?php echo $rows->offer_id?>" title="click it to make featured"><img src="../images/eye_delete.gif" alt="featured" border="0"></a>
          <?php }?></td>
		<td align="center">
		<a href="index.php?action=EDIT&ofrID=<?php echo $rows->offer_id?>"><img src="../images/edit.gif" border="0" title="edit offer" align="absmiddle"></a>
		<a href="list.php?action=DELETE&ofrID=<?php echo $rows->offer_id?>" style="cursor:hand;" onClick="return confirm('Are you sure you want to delete this Record!!!');"> <img src="../images/icon_votedown.gif" width="16" height="16" border="0" align="absmiddle" alt="Delete This Category"></a>		</td>
	</tr>
	<?php
	}
	?>
	<tr>
    	<td colspan="2">&nbsp;</td>
      	<td>&nbsp;</td>
      	<td>&nbsp;</td>
      	<td><div align="center"></div></td>
    </tr>
	<tr>
		<td class="top_row" colspan="7" align="center"><?php echo $pagelinks?>&nbsp;</td>
	</tr>
</table>
</body>
</html>
