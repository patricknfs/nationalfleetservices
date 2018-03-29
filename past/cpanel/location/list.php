<?php
require_once("../include/application-top-inner.php");

$dbObj = new DB();
$dbObj->fun_db_connect();

if(!empty($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
$limit = 20;
$start = ($page - 1) * $limit;

if($_REQUEST['action']=='DEL'){
	$sql = "DELETE FROM " . TABLE_ZONE ." WHERE zone_id=".$_REQUEST['id']; 
	$res = mysql_query($sql);
}

$sqlSel = "SELECT * FROM " . TABLE_ZONE;
$rsResult = $dbObj->fun_db_query($sqlSel);
$totRecords = $dbObj->fun_db_get_num_rows($rsResult);
$pagelinks = paginate($limit, $totRecords);
$dbObj->fun_db_free_resultset($rsResult);

$sqlSel .= " ORDER BY zone_name LIMIT $start, $limit";
$rsResult = $dbObj->fun_db_query($sqlSel);
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
-->
</style>

<script language="javascript">
function getConfirmation(getID){
	var getConfirm;
	getConfirm=confirm("\nAre you sure you want to delete this Record!!!")
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
    <td width="71%" class="headGray">VIEW LOCATION MODULE</td>
    <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3" align="center">
	<?php
		$msg = urldecode($_REQUEST['msg']);
		$msgtype = (int)($_REQUEST['msgtype']);
		if($msg!=""){
			if($msgtype==1){
				$fontcolor = "#ff0000";
			}
			if($msgtype==2){
				$fontcolor = "#006600";
			}
			echo "<img src='../images/att.gif' align='absmiddle'> ";
			echo "<font color=='".$fontcolor."' face='verdana' size='2'>";
			echo $msg;
			echo "</font>";
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
		<td height="20" colspan="84">Total Records : <?php echo $totRecords ?> </td>
	</tr>
	<tr class="tablesRowHeadingBG">
		<td width="14%" class="bHead">ID</td>
		<td width="27%" class="bHead">Location Name</td>
		<td width="19%" align="center" class="bHead">Status</td>
		<td align="center" class="bHead" colspan="7">Tools</td>
	</tr>
	
	<?php
	$cnt = 0;
	while($rows = $dbObj->fun_db_fetch_rs_object($rsResult)){
		$cnt++;
		if($cnt % 2 == 0){
			$alternateStyle="tablesRowBG_1";
		}else{
			$alternateStyle="tablesRowBG_2";
		}
	?>
	<tr class="<?php echo $alternateStyle?>">
		<td><?php echo fun_db_output($rows->zone_id)?></td>
		<td><?php echo fun_db_output($rows->zone_name)?></td>
		<td align="center">
			<?php
				if($rows->zone_status==1){
					echo "<font color='#006600'>Active</font>";
				}else{
					echo "<font color='#ff0000'>Inactive</font>";
				}
			?>		</td>
		<td align="center"><a href="index.php?action=EDIT&zID=<?php echo $rows->zone_id?>&page=<?php echo $page?>" title="Edit this location"><img src="../images/edit.gif" width="22" height="21" border="0" align="absmiddle" alt="Modify this location"></a>&nbsp;&nbsp;<a href="list.php?action=DEL&id=<?php echo $rows->zone_id?>" onClick="return confirm('Do you realy want to delete this record');"><img src="../images/delete.gif"  border="0" align="absmiddle" alt="Delete this location"></a></td>
	</tr>
	<?php
	}
	?>
	<tr>
    	<td colspan="3">&nbsp;</td>
      	<td align="center"><div align="center"></div></td>
        
	</tr>
	<tr>
		<td class="top_row" colspan="5" align="center"><?php echo $pagelinks?>&nbsp;</td>
	</tr>
</table>
</body>
</html>
