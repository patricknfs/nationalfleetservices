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

if($sno!=""){
$sql="delete from ".TABLE_NEWSLETTER." where sno='$sno'";
$result = mysql_query($sql);
$totalDeleted=mysql_affected_rows();
if($totalDeleted>0){
$message="Newsletter Deleted Successfully";
}
else{
$message="Newsletter Not Deleted";
}
}

    // get the pager input values  
    $page = $_REQUEST['page'];  
    $limit = 2; 
	$query="select count(*) from ".TABLE_NEWSLETTER." where 1=1"; 
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
    $query = "select * from ".TABLE_NEWSLETTER." where 1=1";  
	if($EntryDate1!="" && $EntryDate2!=""){
	$query=$query . " and EntryDate between '$EntryDate1' and '$EntryDate2'"; 
	}
    $query =$query . " order by EntryDate desc limit $offset, $limit";  
    $result = mysql_query($query);  


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>FILMAKA.COM ADMIN SECTION</title>
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
            <td width="71%" class="headGray"><%
			if request("id")<>"" then 
			response.Write("Modify ")
			else
			response.Write("Add ")
			end if
			%>
    newsletter module </td>
            <td width="26%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3">
			<br>
			<form name="form1" method="post" action="list.php">
			  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="23%" height="25" class="bText"><div align="right">Entry Date Between  :&nbsp;</div></td>
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
                            <td width="84%" align="left"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate1);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
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
                      <td width="84%" align="left"><a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.all.EntryDate2);return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="../calender_include/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
                    </tr>
                  </table></td>
                  <td width="26%" valign="bottom"><input type="submit" name="search" value="Search" class="Button">&nbsp;&nbsp;&nbsp;<input type="reset" name="set" value="Reset" class="Button"></td>
                  </tr>
              </table>
			  </form>
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="top_row">
                    <td height="20" colspan="5">&nbsp;Total Records : <?php echo $total ?> </td>
                    </tr>
                  <tr class="tablesRowHeadingBG">
                    <td width="45" class="bHead">&nbsp;S.No.</td>
                    <td width="70%" height="20" class="bHead">Issue Title </td>
                    <td width="12%" class="bHead">Entry Date</td>
                    <td width="50" class="bHead"><div align="center">Edit</div></td>
                    <td width="50" class="bHead"><div align="center">Delete</div></td>
                  </tr>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    <td><div align="center"></div></td>
                    <td><div align="center"></div></td>
                  </tr>
                  
				  
				  
				  
<?
$num=($page-1) * $limit;
if ($total!=0)
{
while ($row = mysql_fetch_array($result))
{ 
$num=$num+1;
$sno = $row["sno"]; 
$IssueTitle = $row["IssueTitle"]; 
$EntryDate = $row["EntryDate"];
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
                    <td><a href="index.php?id=<?php echo $sno; ?>" class="tableInner"><?php echo $IssueTitle; ?></a></td>
                    <td><?php echo $EntryDate; ?></td>
                    <td><div align="center"><a href="index.php?id=<?php echo $sno; ?>"><img src="../images/edit.gif" alt="Edit" width="22" height="21" border="0"></a></div></td>
                    <td><div align="center"><span style="cursor:hand;" onClick="getConfirmation('<?php echo $sno; ?>')"><img src="../images/delete.gif" alt="Delete" width="22" height="21" border="0"></span></div></td>
                  </tr>				  
				  
<?
}
?>
                  <tr>
                    <td colspan="3">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="5" class="top_row">
			  <div align="right">
<?


    // use $result here to output page content  

    // output paging system (could also do it before we output the page content)  
    if ($page == 1) // this is the first page - there is no previous page  
        echo "";  
    else            // not the first page, link to the previous page  
        echo "<a href=\"?page=" . ($page - 1) . "&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2\" class='top_row'>Previous</a>&nbsp;";  

    for ($i = 1; $i <= $pager->numPages; $i++) {  
        echo " | ";  
        if ($i == $pager->page)  
            echo " $i";  
        else  
            echo "<a href=\"?page=$i&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2\"> $i</a>";  
    }  

    if ($page == $pager->numPages) // this is the last page - there is no next page  
        echo " ";  
    else            // not the last page, link to the next page  
        echo "&nbsp;<a href=\"?page=" . ($page + 1) . "&EntryDate1=$EntryDate1&EntryDate2=$EntryDate2\" class='top_row'>Next</a>";  
			  
?>
			  </div>					
					</td>
                  </tr>				  
<?
}
else
{
?>
				  <tr class="tablesRowBG_1">
                    <td height="20" colspan="5">No Data Found</td>
                  </tr>				  
                  <tr>
                    <td colspan="3">&nbsp;</td>
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
<%
	sub showPaging(intPrev,intNext,TotalPages)
		dim Counter
		if intPrev <> 0 then Response.Write "<a class='paging_hyperlink' href=?Page=" & intPrev & "&EntryDate1=" & server.URLEncode(EntryDate1) & "&EntryDate2=" & server.URLEncode(EntryDate2) & "&Keyword=" & server.URLEncode(Keyword) & ">Prev</a>&nbsp;&nbsp;"
		Counter=1
		Response.Write "<span class='paging_hyperlink'>Page :</span>" 
		while Counter <= TotalPages
			if cint(Counter)=cint(Page) then
				Response.Write "&nbsp;<span class='paging_hyperlink'>" & Counter & "</span>"
			else
				Response.Write "&nbsp;<a class='paging_hyperlink' href=?Page=" & Counter & "&EntryDate1=" & server.URLEncode(EntryDate1) & "&EntryDate2=" & server.URLEncode(EntryDate2) & "&Keyword=" & server.URLEncode(Keyword) & ">" & Counter & "</a>"										
			end if
			
			if cint(Counter) <> cint(TotalPages) then Response.Write "<span class='paging_hyperlink'> | </span>"										
		Counter = Counter + 1
		wend
		if objrs.AbsolutePage <> -3 and intNext <> 0 then Response.Write "&nbsp;&nbsp;<a class='paging_hyperlink' href=?Page=" & intNext & "&EntryDate1=" & server.URLEncode(EntryDate1) & "&EntryDate2=" & server.URLEncode(EntryDate2) & "&Keyword=" & server.URLEncode(Keyword) & ">Next</a>"		
	end sub
	
%>