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

if($sno!=""){
$sql="SELECT * FROM DER_ProductMaster where sno=$sno";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

//getting data from the database into local variables
$CatID=$row["CatID"];
$SubCatID=$row["SubCatID"];
$ProductName=$row["ProductName"];
$ProductSmallDescription=$row["ProductSmallDescription"];
$BrandName=$row["BrandName"];
$SupplierName=$row["SupplierName"];
$ProductID=$row["ProductID"];
$Price=$row["Price"];
$Discount=$row["Discount"];
$CurrencyID=$row["CurrencyID"];
$ThumbImage=$row["ThumbImage"];
$FullImage=$row["FullImage"];
$Descriptions=$row["Descriptions"];
$Ingredients=$row["Ingredients"];
$Precautions=$row["Precautions"];
$How_to_Use=$row["How_to_Use"];
$WorksWith=$row["WorksWith"];
$EntryDate=$row["EntryDate"];




//Let me now get the different fields.
list ($year, $month, $day) =  explode('-', $EntryDate);
//Now i apply the date function 
$EntryDate =  date("F j, Y", mktime(0, 0, 0, $month, $day, $year));
}

if($ThumbImage==""){
$ThumbImageView="../../uploads/nofound.gif";
}
else{
$ThumbImageView="../../uploads/$ThumbImage";
}

if($FullImage==""){
$FullImageView="../../uploads/nofound.gif";
}
else{
$FullImageView="../../uploads/$FullImage";
}
if($Discount==""){$Discount="0";}

$Discount=number_format($Discount,2);

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

<script language="javascript" type="text/javascript" src="../../include/commentLimit.js"></script>
<script type="text/javascript"> 

function funSubmitForm(){
	var frm = document.form1;
	if(validateForm()==false){
		return;
	}
	funSetDescription();
	frm.enctype="multipart/form-data";
	frm.action = "process.php";
	frm.method = "post";
	frm.target = "_self";
	frm.submit();
}

function funPreviewForm(){
	var frm = document.form1;
	if(validateForm()==false){
		return;
	}
	funSetDescription();
	frm.enctype="multipart/form-data";
	frm.action = "product-preview.php";
	frm.method = "post";
	frm.target = "_blank";
	frm.tmpFullImagePath.value = document.getElementById('FullImage').value;
	frm.submit();
}

function funSetDescription(){
	var frm = document.form1;
	frm.tmpDescription.value = document.getElementById("wysiwyg" + "Descriptions").contentWindow.document.body.innerHTML;
}

function handleHttpResponse_showSubCat() {  
if (http.readyState == 4) { 
if(http.status==200) { 
var results=http.responseText; 
document.getElementById('divResponseSubCat').innerHTML = results; 
} 
} 
} 
        
function getSubCategories(getCatID,getSubCatID) {  
var url="getSubCategories.php?";
url=url + 'CatID=' + getCatID;
url=url + '&SubCatID=' + getSubCatID;
http.open("GET", url, true); 
http.onreadystatechange = handleHttpResponse_showSubCat; 
http.send(null); 
} 
      
function getHTTPObject() { 
var xmlhttp; 
if(window.XMLHttpRequest){ 
xmlhttp = new XMLHttpRequest(); 
} 
else if (window.ActiveXObject){ 
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
if (!xmlhttp){ 
xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
} 
} 
return xmlhttp; 
} 
var http = getHTTPObject(); // We create the HTTP Object 

</script> 


<script language="JavaScript" type="text/javascript" src="editorFiles/wysiwyg.js">
</script>






<script language="javascript" type="text/javascript">
<!--

function validateForm(){


//code part will work as a required field validator control
var myObjects=new Array();
var myObjectsWhatCompare=new Array();
var myObjectsCheckingValue=new Array();
var myObjectsErrorMessage=new Array();

myObjects[0]=document.getElementById('CatID');
myObjectsWhatCompare[0]=document.getElementById('CatID').value;
myObjectsCheckingValue[0]="0";
myObjectsErrorMessage[0]="Please Select Category";

myObjects[1]=document.getElementById('SubCatID');
myObjectsWhatCompare[1]=document.getElementById('SubCatID').value;
myObjectsCheckingValue[1]="0";
myObjectsErrorMessage[1]="Please Select Sub-Category";

myObjects[2]=document.getElementById('ProductName');
myObjectsWhatCompare[2]=document.getElementById('ProductName').value;
myObjectsCheckingValue[2]="";
myObjectsErrorMessage[2]="Please Enter Product Name";

myObjects[3]=document.getElementById('Price');
myObjectsWhatCompare[3]=document.getElementById('Price').value;
myObjectsCheckingValue[3]="";
myObjectsErrorMessage[3]="Please Enter Price";

myObjects[4]=document.getElementById('Price');
myObjectsWhatCompare[4]=isNumeric(document.getElementById('Price').value);
myObjectsCheckingValue[4]=false;
myObjectsErrorMessage[4]="Price must be numeric";

myObjects[5]=document.getElementById('CurrencyID');
myObjectsWhatCompare[5]=document.getElementById('CurrencyID').value;
myObjectsCheckingValue[5]="0";
myObjectsErrorMessage[5]="Please Select Currency";

myObjects[6]=document.getElementById('Discount');
myObjectsWhatCompare[6]=isNumeric(document.getElementById('Discount').value);
myObjectsCheckingValue[6]=false;
myObjectsErrorMessage[6]="Please Enter discount, only numeric values allowed";

for (i=0;i<myObjects.length;i++){
if(myObjectsWhatCompare[i]==myObjectsCheckingValue[i]){
alert(myObjectsErrorMessage[i]);
document.getElementById('errorMessage').innerHTML=myObjectsErrorMessage[i];
myObjects[i].focus();
return false;
}
}
//end block

/*
//block to validate Images Entry
if(document.getElementById('ThumbImage').value=="" && document.getElementById('H_ThumbImage').value==""){
alert("Please select the Thumb Image of the Product");
document.getElementById('errorMessage').innerHTML="Please select the Thumb Image of the Product";
document.getElementById('ThumbImage').focus();
return false;
}


if(document.getElementById('FullImage').value=="" && document.getElementById('H_FullImage').value==""){
alert("Please select the Full Image of the Product");
document.getElementById('errorMessage').innerHTML="Please select the Full Image of the Product";
document.getElementById('FullImage').focus();
return false;
}
//end block
*/


}


function showImage(getSource,getDestination){
getDestination.src=getSource;
}

function alpha(e) {
var k;
document.all ? k = e.keyCode : k = e.which;
return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8);
return (k<0 );
}


function preview()
{
	cat_id = document.form1.CatID.value;
sub_cat_id = document.form1.SubCatID.value;
product_name = document.form1.ProductName.value;
small_desc = document.form1.ProductSmallDescription.value;
brand_name = document.form1.BrandName.value;
supplier_name = document.form1.SupplierName.value;
product_id = document.form1.ProductID.value;
price = document.form1.Price.value;
discount = document.form1.Discount.value;
currency_id = document.form1.CurrencyID.value;
thumb = document.form1.ThumbImage.value;
full_image = document.form1.FullImage.value;
desc = document.form1.Descriptions.value;

ingredients = document.form1.Ingredients.value;
precautions = document.form1.Precautions.value;
use = document.form1.How_to_Use.value;
works_with = document.form1.WorksWith.value;

	window.open("preview.php?cat_id="+cat_id+"&sub_cat_id="+sub_cat_id+"&product_name="+product_name+"&small_desc="+small_desc+"&brand_name="+brand_name+"&supplier_name="+supplier_name+"&product_id="+product_id+"&price="+price+"&discount="+discount+"&currency_id="+currency_id+"&thumb"+thumb+"&full_image="+full_image+"&desc="+desc+"&ingredients="+ingredients+"&precautions="+precautions+"&use="+use+"&works_with="+works_with+"","popup","top=5,left=30,toolbars=no,maximize=yes,resize=yes,width=600,height=800,location=no,directories=no,scrollbars=yes");
}

//-->
</script>
<script language="javascript" type="text/javascript" src="../include/required_functions.js"></script>
<link href="../include/style.css" rel="stylesheet" type="text/css">

</head>

<body onLoad="changeScrollbarColor(); getSubCategories('<?php echo $CatID; ?>','<?php echo $SubCatID; ?>');">
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
			Product module </td>
            <td width="18%" class="tableHead">Login As :: <?php echo $_SESSION["AdminName"];?> </td>
          </tr>
          <tr>
            <td colspan="3"><p>&nbsp;</p>              
              <form action="process.php" method="post" enctype="multipart/form-data" name="form1" onSubmit="">
                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                  <tr class="tablesRowHeadingBG">
                    <td height="20" colspan="6" class="bHead">Product Module
                      <input name="id" type="hidden" id="id" value="<?php echo $sno; ?>"></td>
                  </tr>
                  <tr>
                    <td height="25" colspan="6"><div align="center" class="bText" id="errorMessage" style="color:#FF0000;"></div></td>
                    </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="266" height="30">Category (<span class="style1">*</span>)</td>
                    <td colspan="3"><select name="CatID" class="bText" id="CatID" onChange="getSubCategories(document.getElementById('CatID').value,document.getElementById('SubCatID').value);">
                      <option value="0" selected>---Select Category---</option>
                      <?php
						$query1 = "select distinct sno,CategoryName from DER_CategoryMaster order by sno";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_numrows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$sno1 = $row1["sno"]; 
						$CategoryName = $row1["CategoryName"]; 
						?>
                      <option value="<?php echo $sno1;?>" <?php if($CatID==$sno1){echo " selected";} ?>><?php echo $CategoryName; ?></option>
                      <?php
						}
						}
						?>
                    </select></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="266" height="30">Subcategory  (<span class="style1">*</span>)</td>
                    <td colspan="3">
					<div id="divResponseSubCat">
					<select name="SubCatID" class="bText" id="SubCatID">
                      <option value="0" selected>---Select Subcategory---</option>
                    </select>
					</div>
					</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="266" height="30">Product Name  (<span class="style1">*</span>)</td>
                    <td colspan="3"><input name="ProductName" type="text" class="textbox_long" id="ProductName" value="<?php echo $ProductName; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Product Small Description (optional) </td>
                    <td colspan="3"><input name="ProductSmallDescription" type="text" class="textbox_long" id="ProductSmallDescription" value="<?php echo $ProductSmallDescription; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Product Brand Name (optional) </td>
                    <td colspan="3"><input name="BrandName" type="text" class="textbox_long" id="BrandName" value="<?php echo $BrandName; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Supplier Name (optional) </td>
                    <td colspan="3"><input name="SupplierName" type="text" class="textbox_long" id="SupplierName" value="<?php echo $SupplierName; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Product ID (optional) </td>
                    <td colspan="3"><input name="ProductID" type="text" class="textbox_Date" style="width:60px;" id="ProductID" value="<?php echo $ProductID; ?>"></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Price (<span class="style1">*</span>)</td>
                    <td colspan="3"><input name="Price" type="text" class="textbox_Date" id="Price" style="width:60px;" value="<?php echo $Price; ?>" maxlength="8">
                        <select name="CurrencyID" class="bText" id="CurrencyID" style="width:80px;">
                          <option value="0" selected>Currency</option>
                          <?php
						$query1 = "select distinct sno,CurrencyName from DER_CurrencyMaster order by CurrencyName";  
						$result1 = mysql_query($query1);  
						$total1 = mysql_numrows($result1); 
						if ($total1!=0)
						{
						while ($row1 = mysql_fetch_array($result1))
						{
						$sno2 = $row1["sno"]; 
						$CurrencyName = $row1["CurrencyName"]; 
						?>
                          <option value="<?php echo $sno2;?>" <?php if($CurrencyID==$sno2){echo " selected";} ?>><?php echo $CurrencyName; ?></option>
                          <?php
						}
						}
						?>
                      </select></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="266" height="30">Discount  in % (<span class="style1">*</span>)</td>
                    <td colspan="3">                      <input name="Discount" type="text" class="textbox_Date" id="Discount" style="width:60px;" value="<?php echo $Discount; ?>" maxlength="5"> 
                      If no discount available, pleaese left it as '0' </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="266" height="30">Thumb Image   </td>
                    <td width="294"><input name="ThumbImage" type="file" class="Button1" id="ThumbImage" onChange="showImage(document.getElementById('ThumbImage').value,document.getElementById('ImagePreview1'));" onKeyPress="return alpha(document.getElementById('ThumbImage').value);" accept="image/*"> 
                      <br>
                      To be displayed on product list page<br>
                      Please follow a 150 X 100 <strong>size</strong> </td>
                    <td width="83"><img src="<?php echo $ThumbImageView; ?>" name="ImagePreview1" id="ImagePreview1"><span class="pagiinText">
                      <input name="H_ThumbImage" type="hidden" class="txtBox" id="H_ThumbImage" value="<?php echo $ThumbImage;?>">
                    </span></td>
                    <td width="310" valign="bottom"><?php if ($ThumbImage!="") {?>
                        <input name="ImageAction1" type="radio" value="1" checked >
  Keep this Image<br>
  <input name="ImageAction1" type="radio" value="2">
  <span class="heading">Replace this Image </span><br>
  <input name="ImageAction1" type="radio" value="3">
  <span class="heading">Delete this Image </span>
  <?php } ?>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td width="266" height="30">Full Image</td>
                    <td><input name="FullImage" type="file" class="Button1" id="FullImage" onChange="showImage(document.getElementById('FullImage').value,document.getElementById('ImagePreview'));">                      <br>
                        To be displayed on product discription page <br>
                        Please follow a 100 X 150 <strong>ratio</strong> </td>
                    <td width="83"><img src="<?php echo $FullImageView; ?>" name="ImagePreview" id="ImagePreview"><span class="pagiinText">
                      <input name="H_FullImage" type="hidden" class="txtBox" id="H_FullImage" value="<?php echo $FullImage;?>">
					  <input type="hidden" name="tmpFullImagePath" value="">
                    </span></td>
                    <td valign="bottom"><?php if ($FullImage!="") {?>
                        <input name="ImageAction" type="radio" value="1" checked >
                        Keep this Image<br>
                        <input name="ImageAction" type="radio" value="2">
                        <span class="heading">Replace this Image </span><br>
                        <input name="ImageAction" type="radio" value="3">
                        <span class="heading">Delete this Image </span>
                        <?php } ?>
                    </td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td width="20">&nbsp;</td>
                    <td height="30" valign="top">Product Description    (<span class="style1">*</span>) </td>
                    <td colspan="3" valign="top">
					<textarea id="Descriptions" name="Descriptions" style="height: 170px; width: 500px;"><?php echo $Descriptions; ?></textarea>
					<script language="javascript1.2">
					 generate_wysiwyg('Descriptions');
					</script>
					<input type="hidden" name="tmpDescription" value="">
					</td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Ingredients (optional) </td>
                    <td colspan="3">
					
					<textarea name="Ingredients" cols="40" rows="2" class="textbox_long" id="Ingredients"><?php echo $Ingredients; ?></textarea>
					<span class="ButtonPink"><script>displaylimit('document.all.Ingredients',1000)</script></span>
					
					</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Precautions (optional) </td>
                    <td colspan="3">
					<textarea name="Precautions" cols="40" rows="2" class="textbox_long" id="Precautions"><?php echo $Precautions; ?></textarea>
					<span class="ButtonPink"><script>displaylimit('document.all.Precautions',1000)</script></span>
					</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">How to Use (optional) </td>
                    <td colspan="3">
					<textarea name="How_to_Use" cols="40" rows="2" class="textbox_long" id="How_to_Use"><?php echo $How_to_Use; ?></textarea>
					<span class="ButtonPink"><script>displaylimit('document.all.How_to_Use',1000)</script></span>
					</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30">Works With (optional) </td>
                    <td colspan="3">
					<textarea name="WorksWith" cols="40" rows="2" class="textbox_long" id="WorksWith"><?php echo $WorksWith; ?></textarea>
					<span class="ButtonPink"><script>displaylimit('document.all.WorksWith',1000)</script></span>
					</td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php 
				  if($sno!=""){
				  ?>
                  <tr class="tablesRowBG_2">
                    <td>&nbsp;</td>
                    <td height="30" valign="top">Creation Date </td>
                    <td colspan="3" valign="top"><?php echo $EntryDate; ?></td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php } ?>
                  <tr class="tablesRowBG_1">
                    <td width="20">&nbsp;</td>
                    <td height="20">&nbsp;</td>
                    <td colspan="3"><div align="right"><a href="list.php" class="bText_link">View All</a></div></td>
                    <td width="20">&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td height="20" colspan="6" class="tablesRowHeadingBG"><div align="center">
                      <input name="Submit" type="button" class="Button1" value="Submit" onClick="javascript: funSubmitForm();"> 
                      &nbsp;
                    <input name="Preview" type="button" class="Button1" value="Preview" onClick="javascript: funPreviewForm();"> 
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
