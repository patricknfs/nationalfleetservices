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

<SCRIPT language=javascript src=../include/myfunctions.js></SCRIPT>

<script language="javascript" type="text/javascript">
<!--

function validateForm(){

//code part will work as a required field validator control
var myObjects=new Array();
var myObjectsWhatCompare=new Array();
var myObjectsCheckingValue=new Array();
var myObjectsErrorMessage=new Array();

myObjects[0]=document.all.Title;
myObjectsWhatCompare[0]=document.all.Title.value;
myObjectsCheckingValue[0]="";
myObjectsErrorMessage[0]="Please Enter the Title";

for (i=0;i<myObjects.length;i++){
if(myObjectsWhatCompare[i]==myObjectsCheckingValue[i]){
document.all.errorMessage.innerHTML=myObjectsErrorMessage[i];
myObjects[i].focus();
return false;
}
}
//end block

}

function enableDisable(getID){
if(getID=="1"){
document.all.UsersList.disabled = true;
document.all.H_UsersList.value = "";
}
else if(getID=="2"){
document.all.UsersList.disabled = false;
}

}

function fillUsersList(getObject,getHiddenObject,getSep){
var total="";
for(var i=0; i < getObject.length; i++){
if(getObject[i].selected){
total +=getSep+getObject[i].value +getSep+",";
getHiddenObject.value=total;
}
}

}


//-->
</script>
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
			Send Message module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="5" class="bHead">Send Message  Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="5"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30" valign="top">Select Users </td>
                    <td width="108" valign="top"><input name="Users" type="radio" value="1" checked onClick="enableDisable('1');">
All Users </td>
                    <td width="478" valign="top"><input name="Users" type="radio" value="2" onClick="enableDisable('2');">
Only Selected Users <br>
<select name="UsersList" size="5" multiple=true disabled class="bText" id="UsersList" style="width:390px;" onBlur="fillUsersList(document.all.UsersList,document.all.H_UsersList,'');">
  <?
						$query1 = "select * from ukchl_usermaster order by FirstName";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_num_rows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$sno = $row1["sno"]; 
						$Username = $row1["Username"]; 
						$FirstName = $row1["FirstName"]; 
						$LastName = $row1["LastName"]; 
						?>
  <option value="<? echo $sno;?>"><? echo "$FirstName $LastName ($Username)"; ?></option>
  <?
						}
						}
						?>
</select>
<input name="H_UsersList" type="hidden" id="H_UsersList"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="138" height="30">Message Title (<span class="style1">*</span>)</td>
                    <td colspan="2"><input name="Title" type="text" class="textbox_long" id="Title"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td width="20">&nbsp;</td>
                    <td height="30" valign="top">Message   (<span class="style1">*</span>) </td>
                    <td colspan="2" valign="top">
					<textarea id="Message" name="Message" style="height: 170px; width: 500px;">
					</textarea>
					<script language="javascript1.2">
					  generate_wysiwyg('Message');
					</script>
					
					</td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_1">
                    <td width="20">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td colspan="2"><div align="right"><a href="javascript:history.back();" class="tableInner">Back</a></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="5" class="tablesRowHeadingBG"><div align="center">
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
