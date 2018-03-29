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
$IssueID=$row["sno"];
$IssueTitle=$row["IssueTitle"];
$NewsLetter=$row["NewsLetter"];
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
<SCRIPT language=javascript src=../include/myfunctions.js></SCRIPT>
<script language="javascript" type="text/javascript">
<!--

function showPreview(){
//code needed before submitting the form
if(document.all.NewsLetterIssue.value!="0"){
document.location.href="index.php?id=" + document.all.NewsLetterIssue.value;
}

}

function enableDisable(getID){
if(getID=="1"){
document.all.EmailList.disabled = true;
}
else if(getID=="2"){
document.all.EmailList.disabled = false;
}

}

function fillUsersList(){
var total="";
for(var i=0; i < document.all.EmailList.length; i++){
if(document.all.EmailList[i].selected){
total +=document.all.EmailList[i].value + ",";
document.all.H_EmailList.value=total;
}
}

}

//-->
</script>
<script language="javascript" type="text/javascript" src="../include/required_functions.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css">
</head>
<body onLoad="changeScrollbarColor();">
<IFRAME STYLE="display:none;position:absolute;width:167;height:200;z-index=100;border-style:solid;border-width:1" ID="CalFrame" MARGINHEIGHT=0 MARGINWIDTH=0 NORESIZE FRAMEBORDER=0 SCROLLING=NO SRC="../date.htm"></IFRAME>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td style="padding:20px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="76%" class="headGray"> preview newsletter</td>
                          </tr>
                          <tr>
                            <td><p>&nbsp;</p>
                              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                <?php 
								if ($NewsLetter!=""){
								?>
                                <tr class="tablesRowBG_2">
                                  <td height="30" colspan="6" style="padding:10px;"><?php echo $NewsLetter;?> </td>
                                </tr>
                                <?php
								}
								?>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><div align="center" class="tableHead" style="cursor:pointer;" onClick="javascript:window.close();">Close </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
