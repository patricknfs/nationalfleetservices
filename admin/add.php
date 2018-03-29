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

<h2>Add Offer</h2>

<form action="insert.php" method="post">

<table cellspacing="0" cellpadding="5" style="border-collapse: collapse">

<tr><td>Pic</td><td>
<select name="pic">
<option value="">- Select Image -
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
</select></td></tr>

<tr><td>Make</td><td>
<input type="text" name="make"></td></tr>

<tr><td>Model</td><td>
<input type="text" name="model"></td></tr>

<tr><td>Stock</td><td>
<input type='checkbox' name='stock' value='1' /></td></tr>

<tr><td>Product</td><td>
<input type="text" name="product"></td></tr>

<tr><td>Initial</td><td>
<input type="text" name="initial"></td></tr>

<tr><td>Term</td><td>
<input type="text" name="term"></td></tr>

<tr><td>Mileage</td><td>
<input type="text" name="mileage"></td></tr>

<tr><td>Maintenance</td><td>
<input type='checkbox' name='maint' value='1' /></td></tr>

<tr><td>PCH</td><td>
<input type='checkbox' name='pch' value='1' /></td></tr>

<tr><td>Rental</td><td>
<input type="text" name="rental"></td></tr>

<tr><td>Comms</td><td>
<input type="text" name="comms"></td></tr>

<tr><td>Co2</td><td>
<input type="text" name="co2"></td></tr>

<tr><td>MPG</td><td>
<input type="text" name="mpg"></td></tr>

<tr><td>Expires</td><td>
<input type="text" name="expire"></td></tr>

<tr><td>Source</td><td>
<input type="text" name="source"></td></tr>

<tr><td></td><td><input type="Submit"></td></tr>

</table>

</form>

</body>