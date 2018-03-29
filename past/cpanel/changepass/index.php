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

<script language="javascript" type="text/javascript">
<!--
function changeScrollbarColor() {
document.body.style.scrollbarBaseColor = '#636562';
document.body.style.scrollbarFaceColor='#FFFFFF';
document.body.style.scrollbarArrowColor='#6E89DD';
document.body.style.scrollbarTrackColor='#FFFFFF';
document.body.style.scrollbarShadowColor='#FFFFFF';
document.body.style.scrollbarHighlightColor='#EEECEF';
document.body.style.scrollbar3dlightColor='#EEECEF';
document.body.style.scrollbarDarkshadowColor='#000000';
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->

function validateForm(){

//code part will work as a required field validator control
var myObjects=new Array();
var myObjectsWhatCompare=new Array();
var myObjectsCheckingValue=new Array();
var myObjectsErrorMessage=new Array();

myObjects[0]=document.all.OldPassword;
myObjectsWhatCompare[0]=document.all.OldPassword.value;
myObjectsCheckingValue[0]="";
myObjectsErrorMessage[0]="Please Enter the Old Password";

myObjects[1]=document.all.NewPassword;
myObjectsWhatCompare[1]=document.all.NewPassword.value;
myObjectsCheckingValue[1]="";
myObjectsErrorMessage[1]="Please Enter the New Password";

for (i=0;i<myObjects.length;i++){
if(myObjectsWhatCompare[i]==myObjectsCheckingValue[i]){
document.all.errorMessage.innerHTML=myObjectsErrorMessage[i];
myObjects[i].focus();
return false;
}
}
//end block

if(document.all.NewPassword.value != document.all.NewPassword1.value){
document.all.errorMessage.innerHTML="Both Passwords are not matching, please check";
document.all.NewPassword1.focus();
return false;
}


}


</script>

</head>

<body onLoad="changeScrollbarColor();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="75%" class="headGray">
			Change Password </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr  class="top_row">
                    <td height="20" colspan="4" class="bHead">&nbsp;Change Password Section                     </td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td width="1%">&nbsp;</td>
                    <td width="20%" height="20">Old Password    (<span class="style1">*</span>)                      </td>
                    <td width="63%"><input name="OldPassword" type="password" class="textbox" id="OldPassword"></td>
                    <td width="16%">&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="34">New Password    (<span class="style1">*</span>) </td>
                    <td><input name="NewPassword" type="password" class="textbox" id="NewPassword"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="20">Re-Type Password (<span class="style1">*</span>) </td>
                    <td><input name="NewPassword1" type="password" class="textbox" id="NewPassword1"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_1">
                    <td>&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  
                  
                  <tr>
                    <td height="20" colspan="4"  class="top_row"><div align="center">
                      <input name="Submit" type="submit" class="Button" value="Submit" onClick="return validateForm();"> 
                      &nbsp;
                      <input name="Reset" type="reset" class="Button" value="Reset">
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
</body>
</html>
