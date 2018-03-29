<?php
require_once("../include/application-top-inner.php");
require_once("../include/classes/class.testimonial.php");

$dbObj = new DB();
$dbObj->fun_db_connect();
$objTst = new Testimonial();

$testimonial_id = $_REQUEST['testimonial_id'];
$action = $_REQUEST['action'];
	if($action == 'DELETE'){
		$sql = "DELETE FROM ".TABLE_TESTIMONIAL." WHERE testimonial_id=$testimonial_id";
		mysql_query($sql) or die('Record can not be deleted!');
		$msgtype = 1;
		$msg = 'This record has been deleted successfully!';
	}
	
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

$sql = "SELECT * FROM " . TABLE_TESTIMONIAL ;
$tstResult = $dbObj->fun_db_query($sql);
$totRecords = $dbObj->fun_db_get_num_rows($tstResult);
$pagelinks = paginate($limit, $totRecords);
$dbObj->fun_db_free_resultset($tstResult);

$sql .= " ORDER BY added_date LIMIT $start, $limit";
$tstResult = $dbObj->fun_db_query($sql);
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

function gotoPage(getID){
		window.location = '?page='+getID+'<?echo "&CategoryName1=$CategoryName1&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2"; ?>';
}

</script>
</head>
<body>
<table cellspacing="0" cellpadding="0" width="100%" border="0">
<tr>
	<td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
    <td width="71%" class="headGray">View Dealer module </td>
    <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" align="center" class="bText">
	<?php
		if($msg!=""){
			echo "<img src='../images/att.gif' align='absmiddle'> ";
			echo $msg;
		}
	?>
	&nbsp;
	</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
</table>
<table cellspacing="0" cellpadding="4" width="100%" border="0">
	<tr class="top_row">
		<td height="20" colspan="4">Total Records : <?php echo $totRecords ?> </td>
	</tr>
	<tr class="tablesRowHeadingBG">
		<td width="3%" class="bHead">ID</td>
		<td width="63%" align="left" class="bHead">Testimonail</td>
		<td width="34%" align="center" class="bHead">Tools</td>
	</tr>
	<tr>
    	<td><?php //echo $cateObj->funBreadcrumb($cID);?>&nbsp;</td>
      	<td><div align="center"></div></td>
    </tr>
	<?php
	$cnt = 0;
	while($rows = $dbObj->fun_db_fetch_rs_object($tstResult)){
		$cnt++;
		if($cnt % 2 == 0){
			$alternateStyle="tablesRowBG_1";
		}else{
			$alternateStyle="tablesRowBG_2";
		}
	?>
	<tr class="<?php echo $alternateStyle?>">
		<td><?php echo fun_db_output($rows->testimonial_id)?></td>
		<td align="left"><?php echo fun_db_output($rows->testimonial_text)?></td>
		<td align="center">
		<a href="index.php?action=EDIT&testimonial_id=<?php echo $rows->testimonial_id?>" title="view this dealer" ><img src="../images/eye.gif" alt="view" border="0" align="absmiddle"></a>
		<a href="list.php?action=DELETE&testimonial_id=<?php echo $rows->testimonial_id?>" title="delete this dealer" style="cursor:hand;" onClick="return confirm('Are you sure you want to delete this Record!!!');"> <img src="../images/icon_votedown.gif" width="16" height="16" border="0" align="absmiddle" alt="Delete This Category"></a>		</td>
	</tr>
	<?php
	}
	?>
	<tr>
    	<td>&nbsp;</td>
      	<td><div align="center"></div></td>
    </tr>
	<tr>
		<td class="top_row" colspan="4" align="center"><?php echo $pagelinks?>&nbsp;</td>
	</tr>
</table>
</body>
</html>
