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
if($sno!=""){
$sql="SELECT * FROM ".TABLE_NEWSLETTER." where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//getting data from the database into local variables
$IssueTitle=$row["IssueTitle"];
$NewsLetter=$row["NewsLetter"];
$EntryDate=$row["EntryDate"];
//Let me now get the different fields.
list ($year, $month, $day) =  explode('-', $EntryDate);
//Now i apply the date function 
$EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
}

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
<script language="JavaScript" type="text/javascript" src="editorFiles/wysiwyg.js">
</script>

<SCRIPT language="javascript" src="../include/myfunctions.js"></SCRIPT>
<script language="javascript" type="text/javascript" src="../include/required_functions.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css">

</head>

<body onLoad="changeScrollbarColor();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="76%" class="headGray">
			<?php
			if ($sno!=""){ 
			echo "Modify ";
			}
			else{
			echo "Add ";
			}
			?>
			newsletter module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr  class="top_row">
                    <td height="20" colspan="4" class="bHead">&nbsp;Newsletter Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
					<tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="138" height="30">Newsletter Issue </td>
                    <td><input name="IssueTitle" type="text" class="textbox_long" id="IssueTitle" value="<?php echo $IssueTitle; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td width="20">&nbsp;</td>
                    <td height="30" valign="top">Newsletter    </td>
                    <td valign="top">
					<textarea id="NewsLetter" name="NewsLetter" style="height: 170px; width: 500px;">
					<?php echo $NewsLetter; ?>
					</textarea>
					<script language="javascript1.2">
					  generate_wysiwyg('NewsLetter');
					</script>
					</td>
                    <td width="20">&nbsp;</td>
                  </tr>
				  <?php 
				  if($sno!=""){
				  ?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30" valign="top">Creation Date </td>
                    <td valign="top"><?php echo $EntryDate; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
                  <tr class="tablesRowBG_1">
                    <td width="20">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td><div align="right"><a href="list.php" class="tableHead">View All</a></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="4" class="top_row"><div align="center">
                      <input name="Submit" type="submit" class="Button1" value="Submit"> 
                      &nbsp;
                      <input name="Reset" type="reset" class="Button1" value="Reset">
                    </div></td>
                    </tr>
                  
                </table>
              </form>
              </td>
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
