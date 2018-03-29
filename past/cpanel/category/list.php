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
$page=$_REQUEST['page'];
$EntryDate1=$_REQUEST["EntryDate1"];
$EntryDate2=$_REQUEST["EntryDate2"];
$CategoryName1=$_REQUEST["CategoryName1"];

if($sno!=""){
//code to delete the Image
$sql="SELECT FullImage FROM ".TABLE_MAKES." WHERE sno='$sno'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$FullImage=$row["FullImage"];
if($FullImage!=""){
$uploadDir="../../uploads/";
$uploadFile="$uploadDir$FullImage";
if (file_exists($uploadFile)){
unlink("$uploadFile");}
}
//end block
$sqlDelofr = " DELETE FROM ".TABLE_OFFERS." WHERE make_id='$sno' ";
$dbObj->fun_db_query($sqlDelofr);
$sqlDelmdl = " DELETE FROM ".TABLE_MODELS." WHERE CatID='$sno' ";
$dbObj->fun_db_query($sqlDelmdl);
$sql="delete from ".TABLE_MAKES." where sno='$sno'";
$result = mysql_query($sql);
$totalDeleted=mysql_affected_rows();
if($totalDeleted>0){
$message="Make Deleted Successfully";
}
else{
$message="Make Not Deleted";
}
}

    // get the pager input values  
    $page = $_REQUEST['page'];  
    $limit = 10; 
		$query="select count(*) from ".TABLE_MAKES." where 1=1"; 
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
	if($CategoryName1!=""){
	$query=$query . " and CategoryName like '%$CategoryName1%'"; 
	}
    $result = mysql_query($query);  
    $total = mysql_result($result, 0, 0);  


    // work out the pager values  
    $pager  = Pager::getPagerData($total, $limit, $page);  
    $offset = $pager->offset;  
    $limit  = $pager->limit;  
    $page   = $pager->page;  

    // use pager values to fetch data  
    $query = "select * from ".TABLE_MAKES." where 1=1";  
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
	if($CategoryName1!=""){
	$query=$query . " and CategoryName like '%$CategoryName1%'"; 
	}
    $query =$query . " order by EntryDate desc limit $offset, $limit";  
    $result = mysql_query($query);  


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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="71%" class="headGray">
		   view make module </td>
            <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3">
			<br>
			<form name="form1" method="post" action="list.php">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25" class="bText"><div align="right">Make Name&nbsp;:&nbsp;</div></td>
                  <td colspan="3"><input name="CategoryName1" type="text" class="textbox_long" id="CategoryName1" value="<?php echo $CategoryName1; ?>"></td>
                  <td valign="bottom">&nbsp;</td>
                </tr>
                <tr>
                  <td width="30%" height="25" class="bText"><div align="right">Creation Date Between  :&nbsp;</div></td>
                  <td width="17%">
					
                        <table width="80%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16%" align="right"><div align="left">
                                <input name="EntryDate1" type="text" class="textbox_Date" id="EntryDate1" value="<?php echo $EntryDate1?>" readonly>
                            </div></td>
                            <td width="84%" align="left"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate1);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
                          </tr>
                        </table>
                        <iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="../calender_include/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
                     <!--end block-->
				  
				  </td>
                  <td width="3%"><div align="left"><span class="bText">&nbsp;and&nbsp;&nbsp;</span></div></td>
                  <td width="24%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="16%" align="right"><div align="left">
                          <input name="EntryDate2" type="text" class="textbox_Date" id="EntryDate2" value="<?php echo $EntryDate2?>" readonly>
                      </div></td>
                      <td width="84%" align="left"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate2);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
                    </tr>
                  </table></td>
                  <td width="33%" valign="bottom"><input type="submit" name="search" value="Search" class="Button">&nbsp;&nbsp;&nbsp;<input type="reset" name="set" value="Reset" class="Button"></td>
                  </tr>
              </table>
			  </form>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="top_row">
                    <td height="20" colspan="4">&nbsp;Total Records : <?php echo $total ?> </td>
                    </tr>
                  <tr class="tablesRowHeadingBG">
                    <td width="56" class="bHead">&nbsp;S.No.</td>
                    <td width="461" height="20" class="bHead">Make Name </td>
                    <td width="61" class="bHead"><div align="center">Modify</div></td>
                    <td width="65" class="bHead"><div align="center">Delete</div></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td><div align="center"></div></td>
                    <td><div align="center"></div></td>
                  </tr>
                  
				  
				  
				  
<?php
$num=($page-1) * $limit;
if ($total!=0)
{
while ($row = mysql_fetch_array($result))
{ 
$num=$num+1;
$sno = $row["sno"]; 
$CategoryName = $row["CategoryName"]; 
$Descriptions = $row["Descriptions"]; 
$FullImage = $row["FullImage"]; 
$EntryDate = $row["EntryDate"];
$vtype = $row['vehicle_type'];
if($FullImage==""){
$FullImage="../../uploads/nofound.gif";
}
else{
$FullImage="../../uploads/$FullImage";
}


//Let me now get the different fields.
list ($year, $month, $day) =  explode('-', $EntryDate);
//Now i apply the date function 
$EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));

if($num%2==0){
$alternateStyle="tablesRowBG_1";
}
else{
$alternateStyle="tablesRowBG_2";
}



?>

				  <tr class="<?php echo $alternateStyle; ?>">
				    <td>&nbsp;<?php echo $num; ?>.</td>
                    <td><a href="index.php?id=<?php echo $sno; ?>" class="bText_link"><?php echo $CategoryName; ?></a></td>
                    <td><div align="center"><a href="index.php?id=<?php echo $sno; ?>" title="Edit this make" ><img src="../images/edit.gif" alt="Edit" width="22" height="21" border="0"></a></div></td>
                    <td><div align="center"><a href="list.php?action=DELETE&id=<?php echo $sno; ?>" title="Delete this banner" style="cursor:hand;" onClick="return confirm('Are you sure to delete this make!!!');"><img src="../images/delete.gif" alt="Delete" width="22" height="21" border="0"></a></div></td>
                  </tr>				 			   
<?php
}
?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  <tr class="top_row">
                    <td height="20" colspan="4" class="top_row">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td width="11%" class="top_row" align="left">&nbsp;Go to Page :&nbsp; </td>
									  <td width="64%" >
                                        <select name="pageno" class="btext" onChange="gotoPage(document.all.pageno.value);">
                                          <?php 
										for ($i = 1; $i <= $pager->numPages; $i++) { 
									?>
                                          <option value='<?php echo $i?>' <?php if($page==$i){echo "selected";} ?>><?php echo $i?></option>
                                          <?php
									}  
									?>
                                        </select>
                                      </td>
                                      <td width="25%" align="right" class="top_row"><?php
									if ($page == 1) // this is the first page - there is no previous page  
										echo "";  
										//echo "<span  class='pagingLink'>FIRST</span>&nbsp;";  
									else            // not the first page, link to the previous page  
										echo "<a href=?page=" . ($page - 1) . "&CategoryName1=$CategoryName1&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2 class='top_row'><< Previous</a>&nbsp;";  
								    ?>

									  <?php
									if ($page == $pager->numPages) // this is the last page - there is no next page  
										echo "";  
										//echo "<span class='pagingLink'>END</span>&nbsp;";  
									else            // not the last page, link to the next page  
										echo "&nbsp;<a href=?page=" . ($page + 1) . "&CategoryName1=$CategoryName1&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2 class='top_row'>Next >></a>&nbsp;";  
									  ?>									 </td>
                                    </tr>
									
                                  </table>					
					</td>
                  </tr>				  
<?php
}
else
{
?>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="4">No Data Found</td>
                  </tr>				  
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

<?php
}
?>
				  


                  </table>              
            <p>&nbsp;</p></td>
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
<p>&nbsp;</p>
</body>
</html>
