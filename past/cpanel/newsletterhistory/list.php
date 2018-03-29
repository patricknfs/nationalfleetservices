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

$MasterRecordID=$_REQUEST["id"];
$page=$_REQUEST['page'];
$EntryDate1=$_REQUEST["EntryDate1"];
$EntryDate2=$_REQUEST["EntryDate2"];

if($GroupName!=""){
$sql="delete from tmmg_newsletter_historydetails where MasterRecordID=$MasterRecordID";
$result = mysql_query($sql);
$totalDeleted=mysql_affected_rows();
if($totalDeleted>0){
$message="Group Deleted Successfully";
}
else{
$message="Group Not Deleted";
}
}

    // get the pager input values  
    $page = $_REQUEST['page'];  
    $limit = 2; 
	$query="select count(distinct MasterRecordID) from tmmg_newsletter_historydetails where 1=1"; 
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
    $result = mysql_query($query);  
    $total = mysql_result($result, 0, 0);  

    // work out the pager values  
    $pager  = Pager::getPagerData($total, $limit, $page);  
    $offset = $pager->offset;  
    $limit  = $pager->limit;  
    $page   = $pager->page;  

    // use pager values to fetch data  
    $query = "select MasterRecordID,EntryDate,count(MasterRecordID) from tmmg_newsletter_historydetails where 1=1";  
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
    $query =$query . " group by MasterRecordID,EntryDate";  
    $query =$query . " order by EntryDate desc limit $offset, $limit";  
    $result = mysql_query($query);  


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WEBADMIN SECTION</title>
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
			View Sent Newsletter module </td>
            <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3">
			<br>
			<form name="form1" method="post" action="list.php">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="23%" height="25" class="bText"><div align="right">Sending Date Between  :&nbsp;</div></td>
                  <td width="17%">
					<!--
					
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
                  <td width="31%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="16%" align="right"><div align="left">
                          <input name="EntryDate2" type="text" class="textbox_Date" id="EntryDate2" value="<?php echo $EntryDate2?>" readonly>
                      </div></td>
                      <td width="84%" align="left"><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate2);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a><span class="bText">&nbsp;&nbsp;</span><a href="javascript:void(0);" class="tableInner" onClick="javascript:clearDateBox();">CLEAR</a></td>
                    </tr>
                  </table></td>
                  <td width="26%" valign="bottom"><input type="image" src="../images/go_new_1.gif" width="33" height="20"></td>
                  </tr>
              </table>
			  </form>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="top_row">
                    <td height="20" colspan="6">Total Records : <?php echo $total ?> </td>
                    </tr>
                  <tr class="tablesRowHeadingBG">
                    <td width="40" class="bHead">S.No.</td>
                    <td width="418" height="20" class="bHead">Newsletter Subject </td>
                    <td width="103" class="bHead">Total Users </td>
                    <td width="90" class="bHead">Sending Date</td>
                    <td width="67" class="bHead"><div align="center">View<br>
                      Details
                    </div></td>
                    <td width="46" class="bHead"><div align="center">Delete</div></td>
                  </tr>
                  <tr>
                    <td colspan="4">&nbsp;</td>
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
$MasterRecordID = $row["MasterRecordID"];
$TotalMembers = $row[2]; 
$EntryDate = $row["EntryDate"];
//Let me now get the different fields.
list ($year, $month, $day) =  explode('-', $EntryDate);
//Now i apply the date function 
$EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));

$sql1="SELECT NewsLetterSubject FROM tmmg_newsletter_historymaster where sno=$MasterRecordID";
$result1 = mysql_query($sql1);
$row1 = mysql_fetch_array($result1);
$NewsLetterSubject = $row1["NewsLetterSubject"]; 


if($num%2==0){
$alternateStyle="tablesRowBG_1";
}
else{
$alternateStyle="tablesRowBG_2";
}



?>

				  <tr class="<?php echo $alternateStyle; ?>">
				    <td><?php echo $num; ?>.</td>
                    <td><a href="view.php?id=<?php echo $MasterRecordID; ?>" class="tableInner"><?php echo $NewsLetterSubject; ?></a></td>
                    <td><?php echo $TotalMembers; ?></td>
                    <td><?php echo $EntryDate; ?></td>
                    <td><div align="center"><a href="view.php?id=<?php echo $MasterRecordID; ?>"><img src="../images/eye.gif" width="22" height="21" border="0"></a></div></td>
                    <td><div align="center"><span style="cursor:hand;" onClick="getConfirmation('<?php echo $MasterRecordID; ?>')"><img src="../images/delete.gif" width="22" height="21" border="0"></span></div></td>
                  </tr>				  
				  
<?php
}
?>
                  <tr>
                    <td colspan="4">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="6">
			  <div align="right">
<?php


    // use $result here to output page content  

    // output paging system (could also do it before we output the page content)  
    if ($page == 1) // this is the first page - there is no previous page  
        echo "Prev ";  
    else            // not the first page, link to the previous page  
        echo "<a href=\"?page=" . ($page - 1) . "&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2\">Prev</a>&nbsp;";  

    for ($i = 1; $i <= $pager->numPages; $i++) {  
        echo " | ";  
        if ($i == $pager->page)  
            echo " $i";  
        else  
            echo "<a href=\"?page=$i&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2\"> $i</a>";  
    }  

    if ($page == $pager->numPages) // this is the last page - there is no next page  
        echo " Next";  
    else            // not the last page, link to the next page  
        echo "&nbsp;<a href=\"?page=" . ($page + 1) . "&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2\">Next</a>";  
			  
?>
			  </div>					
					</td>
                  </tr>				  
<?php
}
else
{
?>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="6">No Data Found</td>
                  </tr>				  
                  <tr>
                    <td colspan="4">&nbsp;</td>
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
