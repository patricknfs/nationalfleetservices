<head>
<style>
	body {
		font-family: Arial;
		font-size: 10pt;
	}
	
	table {
		font-family: Arial;
		font-size: 10pt;
		border:1px solid #DDD;
	}
	
	th {
		background: #F5F5F5;
		border-bottom:1px solid #DDD;
	}
	
	table tr {
	background-color: #FFF;
	}

	table tr:hover {
	background-color: #f5f5f5;
	}
	
	table td {
		border-bottom:1px solid #DDD;
	}
	
</style>
</head>

<body>

<? include ("offhead.php"); ?>

<h2>Update Offer</h2>

<?php

include("../dbinfo.inc.php");
mysql_connect("213.171.219.91",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM offers WHERE id='{$_GET['id']}'";
$result=mysql_query($query);
$num=mysql_numrows($result); 
mysql_close();

$i=0;
while ($i < $num) {
$pic=mysql_result($result,$i,"pic");
$make=mysql_result($result,$i,"make");
$model=mysql_result($result,$i,"model");
$product=mysql_result($result,$i,"product");
$initial=mysql_result($result,$i,"initial");
$term=mysql_result($result,$i,"term");
$mileage=mysql_result($result,$i,"mileage");
$maint=mysql_result($result,$i,"maint"); 
$stock=mysql_result($result,$i,"stock"); 
$pch=mysql_result($result,$i,"pch"); 
$rental=mysql_result($result,$i,"rental"); 
$comms=mysql_result($result,$i,"comms"); 
$co2=mysql_result($result,$i,"co2"); 
$mpg=mysql_result($result,$i,"mpg"); 
$expire=mysql_result($result,$i,"expire"); 
$source=mysql_result($result,$i,"source"); 
$id=mysql_result($result,$i,"id"); 



?>

<form action="updated.php">
<input type="hidden" name="ud_id" value="<? echo $_GET['id']; ?>">

<table cellspacing="0" cellpadding="5" style="border-collapse: collapse">
<tr><td>Pic</td><td>

<select name="ud_pic">
<option value="<? echo "$pic" ?>"><? echo "$pic" ?>
<?php
$dirPath = dir('../images/veh-pic');
$imgArray = array();
while (($file = $dirPath->read()) !== false)
{
  if ((substr($file, -3)=="gif") || (substr($file, -3)=="jpg") || (substr($file, -3)=="png"))
  {
     $imgArray[ ] = trim($file);
  }
}
$dirPath->close();
sort($imgArray);
$c = count($imgArray);
for($i=0; $i<$c; $i++)
{
    echo "<option value=\"" . $imgArray[$i] . "\">" . $imgArray[$i] . "\n";
}
?>
</select>

</td></tr>

<tr><td>Make</td><td>
<input type="text" name="ud_make" value="<? echo "$make" ?>"></td></tr>

<tr><td>Model</td><td>
<input type="text" name="ud_model" value="<? echo "$model" ?>"></td></tr>

<tr><td>Stock</td><td>
<? if($stock == 1) { $set_checked = " CHECKED";}
else{$set_checked = ""; }
print "<input TYPE=checkbox NAME=ud_stock VALUE=1" . $set_checked . "/>"; ?></td></tr>

<tr><td>Product</td><td>
<input type="text" name="ud_product" value="<? echo "$product" ?>"></td></tr>

<tr><td>Initial</td><td>
<input type="text" name="ud_initial" value="<? echo "$initial" ?>"></td></tr>

<tr><td>Term</td><td>
<input type="text" name="ud_term" value="<? echo "$term" ?>"></td></tr>

<tr><td>Mileage</td><td>
<input type="text" name="ud_mileage" value="<? echo "$mileage" ?>"></td></tr>

<tr><td>Maintenance</td><td>
<? if($maint == 1) { $set_checked = " CHECKED";}
else{$set_checked = ""; }
print "<input TYPE=checkbox NAME=ud_maint VALUE=1" . $set_checked . "/>"; ?></td></tr>

<tr><td>PCH</td><td>
<? if($pch == 1) { $set_checked = " CHECKED";}
else{$set_checked = ""; }
print "<input TYPE=checkbox NAME=ud_pch VALUE=1" . $set_checked . "/>"; ?></td></tr>

<tr><td>Rental</td><td>
<input type="text" name="ud_rental" value="<? echo "$rental" ?>"></td></tr>

<tr><td>Comms</td><td>
<input type="text" name="ud_comms" value="<? echo "$comms" ?>"></td></tr>

<tr><td>Co2</td><td>
<input type="text" name="ud_co2" value="<? echo "$co2" ?>"></td></tr>

<tr><td>MPG</td><td>
<input type="text" name="ud_mpg" value="<? echo "$mpg" ?>"></td></tr>

<tr><td>Expires</td><td>
<input type="text" name="ud_expire" value="<? echo "$expire" ?>"></td></tr>

<tr><td>Source</td><td>
<input type="text" name="ud_source" value="<? echo "$source" ?>"></td></tr>

<tr><td></td><td><input type="submit" name="submit" value="Update"></td></tr>

</table>

</form>

<?
++$i;
} 
?>

</body>