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

$GroupName=$_REQUEST["id"];

if($GroupName!=""){
$sql="SELECT * FROM ukchl_groupmaster where GroupName='$GroupName'";
$result = mysql_query($sql);
$total=mysql_num_rows($result); 

if ($total!=0){
$myEmailList="";
while ($row = mysql_fetch_array($result)){ 
$GroupName=$row["GroupName"];
$EntryDate=$row["EntryDate"];
$Email=$row["Email"];
$myEmailList="$Email,$myEmailList";
}
}


//removing last comma
$myEmailList=substr($myEmailList,0,strlen($myEmailList)-1);

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
<SCRIPT language=javascript src=../include/required_functions.js></SCRIPT>

<script language="javascript" type="text/javascript">

function onLoadFillEmailList(getStr){
objDestination=document.all.EmailList_Group;
var myEmailList = getStr.split(",");
for(i=0;i<myEmailList.length;i++){
var optn = document.createElement("OPTION");
optn.text = myEmailList[i];
optn.value = myEmailList[i];
objDestination.options.add(optn);
}
}


function moveSelected(){
objSource=document.all.EmailList;
objDestination=document.all.EmailList_Group;
var bool=0;

for (var i = 0; i < objSource.options.length; i++) {
if (objSource[i].selected) {

for (var j = 0; j < objDestination.options.length; j++) {
if(objSource[i].value==objDestination[j].value){
bool=1;
document.all.errorMessage.innerHTML="Please do not repete the Email Address";
break;
}
}

if(bool==0){
document.all.errorMessage.innerHTML="";
var optn = document.createElement("OPTION");
optn.text = objSource[i].text;
optn.value = objSource[i].value;
objDestination.options.add(optn);
}

}
}

}

function removeSelected(){
theSel=document.all.EmailList_Group;
  var selIndex = theSel.selectedIndex;
  if (selIndex != -1) {
    for(i=theSel.length-1; i>=0; i--)
    {
      if(theSel.options[i].selected)
      {
        theSel.options[i] = null;
      }
    }
    if (theSel.length > 0) {
      theSel.selectedIndex = selIndex == 0 ? 0 : selIndex - 1;
    }
  }
}


function addSelected(){
objSource=document.all.Emails;
objDestination=document.all.EmailList_Group;
bool=0;
if(isEmail(objSource.value)==false){
document.all.errorMessage.innerHTML="Please Enter a Valid Email Address";
objSource.focus();
return false;
}

for (var j = 0; j < objDestination.options.length; j++) {
if(objSource.value==objDestination[j].value){
bool=1;
document.all.errorMessage.innerHTML="Please do not repete the Email Address";
break;
}
}

if(bool==0){
document.all.errorMessage.innerHTML="";
var optn = document.createElement("OPTION");
optn.text = objSource.value;
optn.value = objSource.value;
objDestination.options.add(optn);
objSource.value="";
}
}

function validateForm(){

//code part will work as a required field validator control
var myObjects=new Array();
var myObjectsWhatCompare=new Array();
var myObjectsCheckingValue=new Array();
var myObjectsErrorMessage=new Array();

myObjects[0]=document.all.GroupName;
myObjectsWhatCompare[0]=document.all.GroupName.value;
myObjectsCheckingValue[0]="";
myObjectsErrorMessage[0]="Please Enter the Group Name...";

myObjects[1]=document.all.EmailList_Group;
myObjectsWhatCompare[1]=document.all.EmailList_Group.length;
myObjectsCheckingValue[1]=0;
myObjectsErrorMessage[1]="No Emails found in List...";

for (i=0;i<myObjects.length;i++){
if(myObjectsWhatCompare[i]==myObjectsCheckingValue[i]){
document.all.errorMessage.innerHTML=myObjectsErrorMessage[i];
myObjects[i].focus();
return false;
}
}
//end block

//block to add data 
var total="";
for(var i=0; i < document.all.EmailList_Group.length; i++){
total +=document.all.EmailList_Group[i].value + ",";
document.all.H_EmailList.value=total;
}
//end block

}




</script>
<script language="javascript" type="text/javascript" src="../include/required_functions.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css">

</head>

<?php if($GroupName!=""){?>
<body onLoad="changeScrollbarColor(); onLoadFillEmailList('<?php echo $myEmailList; ?>');">
<?php } ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%" height="50"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%"><a href="#" title="Home"><img src="../images/on.gif" alt="Home" border="0" height="16" width="16"></a></td>
            <td width="76%" class="headGray">
			<?php
			if ($GroupName!=""){ 
			echo "Modify ";
			}
			else{
			echo "Add ";
			}
			?>			
			group module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" name="form1" onSubmit="return validateForm();">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="4" class="bHead">Group Module
                      <input name="id" type="hidden" id="id" value="<?php echo $GroupName; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="4"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="138" height="30">Group Name (<span class="style1">*</span>)</td>
                    <td><input name="GroupName" type="text" class="textbox_long" id="GroupName" value="<?php echo $GroupName; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
				  
				  <?php if($EntryDate!=""){ ?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Last Modified  On </td>
                    <td><?php echo $EntryDate;?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
				  
			<tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Emails (<span class="style1">*</span>)</td>
                    <td><input name="Emails" type="text" class="textbox_long" id="Emails">
                      <input name="Add" type="button" class="Button1" id="Add" value="Add to the List" onClick="return addSelected();"></td>
                    <td>&nbsp;</td>
                  </tr>
			<tr class="tablesRowBG_2">
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td valign="top">&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr class="tablesRowBG_2">
			  <td>&nbsp;</td>
			  <td height="30" colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="35%"><select name="EmailList" size="10" multiple=true class="bText" id="EmailList" style="width:250px;">
                    <?php
						$query1 = "select distinct Email from ukchl_newsletter_usermaster where IsOK=1 order by Email";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_num_rows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$Email = $row1["Email"]; 
						?>
                    <option value="<?php echo $Email;?>"><?php echo $Email; ?></option>
                    <?php
						}
						}
						?>
                  </select>
                    <input name="Addselected" type="button" class="Button1" id="Addselected" onClick="moveSelected();" value="Add Selected to the Group &raquo;"></td>
                  <td width="30%">&nbsp;</td>
                  <td width="35%">
                      <div align="left">
                        <select name="EmailList_Group" size="10" multiple=true class="bText" id="EmailList_Group" style="width:250px;">
                        </select>
                        <input name="H_EmailList" type="hidden" id="H_EmailList">                        
                        <input name="RemoveSelected" type="button" class="Button1" id="RemoveSelected" onClick="removeSelected();" value="Remove Selected from the Group">
                      </div></td>
                </tr>
              </table></td>
			  <td>&nbsp;</td>
			  </tr>				  
                  <tr class="tablesRowBG_1">
                    <td width="20">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td><div align="right"><a href="list.php" class="tableInner">View All</a></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="4" class="tablesRowHeadingBG"><div align="center">
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
