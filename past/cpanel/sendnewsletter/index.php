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
if(document.all.NewsLetterIssue.value=="0"){
document.all.errorMessage.innerHTML="Please Select the Newsletter Issue to View its Preview";
document.all.NewsLetterIssue.focus();
return false;
}
document.all.errorMessage.innerHTML="";
MM_openBrWindow('view.php?id='+document.all.NewsLetterIssue.value,'AddClient','scrollbars=yes,resizable=yes,width=800,height=400');

}

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}


function enableDisable(getID){
if(getID=="1"){
document.all.EmailList.disabled = true;
document.all.EmailList_Group.disabled = true;
document.all.H_EmailList.value = "";
document.all.H_EmailList_Group.value = "";
}
else if(getID=="2"){
document.all.EmailList.disabled = false;
document.all.EmailList_Group.disabled = true;
document.all.H_EmailList_Group.value = "";
}
else if(getID=="3"){
document.all.EmailList.disabled = true;
document.all.H_EmailList.value = "";
document.all.EmailList_Group.disabled = false;
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


function validateForm(){

//code part will work as a required field validator control
var myObjects=new Array();
var myObjectsWhatCompare=new Array();
var myObjectsCheckingValue=new Array();
var myObjectsErrorMessage=new Array();

myObjects[0]=document.all.NewsLetterIssue;
myObjectsWhatCompare[0]=document.all.NewsLetterIssue.value;
myObjectsCheckingValue[0]="0";
myObjectsErrorMessage[0]="Please Select the NewsLetter to Send";

myObjects[1]=document.all.Subject;
myObjectsWhatCompare[1]=document.all.Subject.value;
myObjectsCheckingValue[1]="";
myObjectsErrorMessage[1]="Please Enter the Subject of the Newsletter";

for (i=0;i<myObjects.length;i++){
if(myObjectsWhatCompare[i]==myObjectsCheckingValue[i]){
document.all.errorMessage.innerHTML=myObjectsErrorMessage[i];
myObjects[i].focus();
return false;
}
}
//end block
}

function changeColor(){
if(document.all.NewsLetterIssue.value!="0"){
document.all.errorMessage.innerHTML="";
document.all.showPrev.className='ButtonPink';
}
else{
document.all.showPrev.className='Button1';
}
}

//-->
</script>
<script language="javascript" type="text/javascript" src="../include/required_functions.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css">

</head>

<body onLoad="changeScrollbarColor();">
<IFRAME STYLE="display:none;position:absolute;width:167;height:200;z-index=100;border-style:solid;border-width:1" ID="CalFrame" MARGINHEIGHT=0 MARGINWIDTH=0 NORESIZE FRAMEBORDER=0 SCROLLING=NO SRC="../date.htm"></IFRAME>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="76%" class="headGray">
			send newsletter module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="top_row">
                    <td height="20" colspan="6" class="bHead">&nbsp;Send Newsletter Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="6"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="293" height="30">Select Newsletter Issue (<span class="style1">*</span>)</td>
                    <td colspan="3">
                      <select name="NewsLetterIssue" class="bText" id="NewsLetterIssue" onChange="changeColor();">
                          <option value="0" selected>---Select Newsletter Issue---</option>
					  
						<?php
						$query1 = "select distinct sno,IssueTitle from ".TABLE_NEWSLETTER." order by IssueTitle desc";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_num_rows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$sno = $row1["sno"]; 
						$IssueTitle = $row1["IssueTitle"]; 
						?>
                          <option value="<?php echo $sno;?>" <?php if($IssueID==$sno){echo " selected";} ?>><?php echo $IssueTitle; ?></option>
						<?php
						}
						}
						?>


                      </select>					
					</td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr>
                    <td id="showPrev" colspan="6" class="Button"><div style="cursor:pointer;" align="center" onClick="showPreview();">Click here to View the Preview of your Newsletter</div></td>
                    </tr>
				
                  <tr valign="top" class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr valign="top" class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Users </td>
                    <td width="170"><input name="Users" type="radio" value="1" checked onClick="enableDisable('1');">
                      All Users                        </td>
                    <td width="270"><input name="Users" type="radio" value="2" onClick="enableDisable('2');"> 
                      Only Selected Users
                        <br>
                        <select name="EmailList" size="5" multiple=true disabled class="bText" id="EmailList" style="width:250px;" onBlur="fillUsersList(document.all.EmailList,document.all.H_EmailList,'');">
                          <?php
						$query1 = "select distinct sno,Email from ".TABLE_NEWSLETTER_USER." order by Email";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_num_rows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$sno = $row1["sno"]; 
						$Email = $row1["Email"]; 
						?>
                          <option value="<?php echo $sno;?>"><?php echo $Email; ?></option>
                          <?php
						}
						}
						?>
                        </select>                        
                        <input name="H_EmailList" type="hidden" id="H_EmailList">
</td>
                    <td width="215">
                      <input name="Users" type="radio" value="3" onClick="enableDisable('3');">
Only Selected Groups <br>
<select name="EmailList_Group" size="5" multiple=true disabled class="bText" id="EmailList_Group" style="width:200px;" onBlur="fillUsersList(document.all.EmailList_Group,document.all.H_EmailList_Group,'\'');">
  <?php
						$query1 = "select distinct GroupName from ".TABLE_NEWSLETTER_GROUP." order by GroupName";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_num_rows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$GroupName = $row1["GroupName"]; 
						?>
  <option value="<?php echo $GroupName;?>"><?php echo $GroupName; ?></option>
  <?php
						}
						}
						?>
</select>
<input name="H_EmailList_Group" type="hidden" id="H_EmailList_Group"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Newsletter Subject </td>
                    <td colspan="3"><input name="Subject" type="text" class="textbox" id="Subject" style="width:400px;"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_1">
                    <td width="15">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                    <td width="30">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="6" class="top_row"><div align="center">
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
