<?php
session_start();
if($_SESSION["AdminName"] == ""){
?>
<script language="javascript">parent.location.href="index.php";</script>
<?php
exit;
}
?>

<?php
include ("../../include/dbconnect.php");

$sno=$_REQUEST["id"];
$page=$_REQUEST['page'];
$EntryDate1=$_REQUEST["EntryDate1"];
$EntryDate2=$_REQUEST["EntryDate2"];
$ProductName1=$_REQUEST["ProductName1"];

if($sno!=""){
//code to delete the Image
$sql="SELECT ThumbImage,FullImage FROM DER_ProductMaster WHERE sno='$sno'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$ThumbImage=$row["ThumbImage"];
$FullImage=$row["FullImage"];
$uploadDir="../../uploads/";
if($ThumbImage!=""){
$uploadFile="$uploadDir$ThumbImage";
if (file_exists($uploadFile)){
unlink("$uploadFile");}
}
if($FullImage!=""){
$uploadFile="$uploadDir$FullImage";
if (file_exists($uploadFile)){
unlink("$uploadFile");}
}
//end block

$sql="delete from DER_ProductMaster where sno='$sno'";
$result = mysql_query($sql);
$totalDeleted=mysql_affected_rows();
if($totalDeleted>0){
$message="Product Deleted Successfully";
}
else{
$message="Product Not Deleted";
}
}

    // get the pager input values  
    $page = $_REQUEST['page'];  
    $limit = 10; 
	$query="select count(*) from DER_ProductMaster where 1=1"; 
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
	if($ProductName1!=""){
	$query=$query . " and ProductName like '%$ProductName1%'"; 
	}
    $result = mysql_query($query);  
    $total = mysql_result($result, 0, 0);  


    // work out the pager values  
    $pager  = Pager::getPagerData($total, $limit, $page);  
    $offset = $pager->offset;  
    $limit  = $pager->limit;  
    $page   = $pager->page;  

    // use pager values to fetch data  
    $query = "select * from DER_ProductMaster where 1=1";  
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
	if($ProductName1!=""){
	$query=$query . " and ProductName like '%$ProductName1%'"; 
	}
    $query =$query . " order by ProductName limit $offset, $limit";  
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
<script language="javascript" src="../../include/popup.js"></script>

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
		window.location = '?page='+getID+'<?echo "&ProductName1=$ProductName1&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2"; ?>';
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
		   view Product module </td>
            <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3">
			<br>
			<form name="form1" method="post" action="list.php">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="25" class="bText"><div align="right">Product Name&nbsp;:&nbsp;</div></td>
                  <td colspan="3"><input name="ProductName1" type="text" class="textbox_long" id="ProductName1" value="<?php echo $ProductName1; ?>"></td>
                  <td valign="bottom">&nbsp;</td>
                </tr>
                <tr>
                  <td width="30%" height="25" class="bText"><div align="right">Creation Date Between  :&nbsp;</div></td>
                  <td width="17%">
					<!--
					customized by Gaurav Pandey
					Just Copy this table block to Execute the calculator in your script
					make sure the path of calender_include directory
					if more than one date control is used then delete all other iframe code except one.
					-->
                        <table width="80%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="16%" align="right"><div align="left">
                                <input name="EntryDate1" type="text" class="textbox_Date" id="EntryDate1" value="<?php echo $EntryDate1?>" readonly>
                            </div></td>
                            <td width="84%" align="left"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate1);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
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
                      <td width="84%" align="left"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate2);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a><span class="bText">&nbsp;&nbsp;</span><a href="javascript:void(0);" class="tableInner" onClick="javascript:clearDateBox();">CLEAR</a></td>
                    </tr>
                  </table></td>
                  <td width="33%" valign="bottom"><input type="image" src="../images/go_new_1.gif" width="33" height="20"></td>
                  </tr>
              </table>
			  </form>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="top_row">
                    <td height="20" colspan="9">Total Records : <?php echo $total ?> </td>
                    </tr>
                  <tr class="tablesRowHeadingBG">
                    <td width="40" class="bHead">S.No.</td>
                    <td width="77" class="bHead">Category</td>
                    <td width="94" height="20" class="bHead">Subcategory</td>
                    <td width="216" class="bHead">Product Name </td>
                    <td width="92" class="bHead">Price (in USD) </td>
                    <td width="109" class="bHead"><div align="center">Thumb Image</div></td>
                    <td width="43" class="bHead"><div align="center">Modify</div></td>
                    <td width="72" class="bHead"><div align="center">Status</div></td>
                    <td width="42" class="bHead"><div align="center">Delete</div></td>
                  </tr>
                  <tr>
                    <td colspan="9"><div align="center"></div>                      <div align="center"></div></td>
                    </tr>
                  
				  
				  
				  
<?
$num=($page-1) * $limit;
if ($total!=0)
{
while ($row = mysql_fetch_array($result))
{ 
$num=$num+1;
$sno = $row["sno"]; 
$CatID = $row["CatID"]; 
$SubCatID = $row["SubCatID"]; 
$ProductName = $row["ProductName"]; 
$Price = $row["Price"]; 
$CurrencyID = $row["CurrencyID"]; 
$ThumbImage = $row["ThumbImage"]; 
$FullImage = $row["FullImage"]; 
$CurrencyID = $row["CurrencyID"]; 
$EntryDate = $row["EntryDate"];
$isActivated = $row["isActivated"];

if($ThumbImage==""){
$ThumbImage="../../uploads/nofound.gif";
}
else{
$ThumbImage="../../uploads/$ThumbImage";
}

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

if($isActivated=="1"){
$myResponseMessage="Activated";
}
else{
$myResponseMessage="Not Activated";
}
if($num%2==0){
$alternateStyle="tablesRowBG_1";
}
else{
$alternateStyle="tablesRowBG_2";
}

$query1 = "select CM.CategoryName,SCM.SubCatName from DER_CategoryMaster CM, DER_SubCatMaster SCM where CM.sno=SCM.CatID and SCM.sno=$SubCatID";  
$result1 = mysql_query($query1);  
$row1 = mysql_fetch_array($result1);
$myCategoryName = $row1["CategoryName"]; 
$mySubCatName = $row1["SubCatName"]; 

$query1 = "select ExchangeRate from DER_CurrencyMaster where sno=$CurrencyID";  
$result1 = mysql_query($query1);  
$row1 = mysql_fetch_array($result1);
$myPrice = round($Price * $row1["ExchangeRate"],2); 


?>

				  <tr class="<?php echo $alternateStyle; ?>">
				    <td><?php echo $num; ?>.</td>
                    <td><?php echo $myCategoryName; ?></td>
                    <td><?php echo $mySubCatName; ?></td>
                    <td><a href="index.php?id=<?php echo $sno; ?>" class="bText_link"><?php echo $ProductName; ?></a></td>
                    <td><?php echo $myPrice; ?></td>
                    <td style="padding-top:5px; padding-bottom:5px;"><div align="center"><a title="Click here to view Full Image" href="javascript:popImage('<?php echo $FullImage; ?>','ImagePopup');" class="style1"><img src="<?php echo $ThumbImage; ?>" border="0"></a></div></td>
                    <td><div align="center"><a href="index.php?id=<?php echo $sno; ?>"><img src="../images/edit.gif" width="22" height="21" border="0"></a></div></td>
                    <td align="center"><a href="block.php?id=<?php echo $sno; ?>" title="Click here to Block/Unblock this Product"><?php echo $myResponseMessage;?></a></td>
                    <td><div align="center"><span style="cursor:hand;" onClick="getConfirmation('<?php echo $sno; ?>')"><img src="../images/icon_votedown.gif" width="16" height="16" border="0"></span></div></td>
                  </tr>				  
				  
<?
}
?>
                  <tr>
                    <td colspan="6">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="9" class="top_row"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="12%" class="top_row" align="left">&nbsp;Go to Page :&nbsp; </td>
                        <td width="70%" ><select name="pageno" class="btext" onChange="gotoPage(document.all.pageno.value);">
                            <?php 
										for ($i = 1; $i <= $pager->numPages; $i++) { 
									?>
                            <option value='<?php echo $i?>' <?php if($page==$i){echo "selected";} ?>><?php echo $i?></option>
                            <?php
									}  
									?>
                          </select>
                        </td>
                        <td width="20%" align="right"><?php
									if ($page == 1) // this is the first page - there is no previous page  
										echo "";  
										//echo "<span  class='pagingLink'>FIRST</span>&nbsp;";  
									else            // not the first page, link to the previous page  
										echo "<a href=?page=" . ($page - 1) . "&ProductName1=$ProductName1&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2 class='pagingLink'><< Prev</a>&nbsp;";  
								?>
                            <?php
									if ($page == $pager->numPages) // this is the last page - there is no next page  
										echo "";  
										//echo "<span class='pagingLink'>END</span>&nbsp;";  
									else            // not the last page, link to the next page  
										echo "&nbsp;<a href=?page=" . ($page + 1) . "&ProductName1=$ProductName1&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2 class='pagingLink'>Next >></a>&nbsp;";  
									  ?>
                        </td>
                      </tr>
                    </table></td>
				  </tr>				  
<?
}
else
{
?>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="9">No Data Found</td>
                  </tr>				  
                  <tr>
                    <td colspan="6">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
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
