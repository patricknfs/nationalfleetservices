<?php 
include ("../../include/dbconnect.php");
$CatID=$_REQUEST["CatID"];
$SubCatID=$_REQUEST["SubCatID"];
$sql="SELECT sno,SubCatName FROM DER_SubCatMaster where CatID=$CatID";
$result = mysql_query($sql);
$options="<select name='SubCatID' class='bText' id='SubCatID'>";
$options="$options<option value='0'>---Select Subcategory---</option>";
while ($row = mysql_fetch_array($result)){
$sno=$row["sno"];
$SubCatName=$row["SubCatName"];
if($SubCatID==$sno){$mySelected = " selected";}
else{$mySelected = "";}
$options="$options<br><option value='$sno' $mySelected>$SubCatName</option>";
}
$options="$options</select>";
$message=$options;
echo "$message";
?> 
