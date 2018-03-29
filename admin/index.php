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

<h2>Manage Offers</h2>

<?
include("../dbinfo.inc.php");
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM offers ORDER BY make";
$result=mysql_query($query);

$num=mysql_numrows($result); 
mysql_close();

?>



<table cellspacing="0" cellpadding="5" style="border-collapse: collapse">
<tr> 
<th align="left">Pic</th>
<th align="left">Make</th>
<th align="left">Model</th>
<th>Stock</th>
<th>Product</th>
<th>Initial</th>
<th>Term</th>
<th>Mileage</th>
<th>Maint</th>
<th>PCH?</th>
<th>Rental</th>
<th>Comms</th>
<th>Co2</th>
<th>MPG</th>
<th>Expire</th>
<th>Source</th>
<th>Edit</th>
<th>Del</th>

</tr>

<?
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

<tr> 
<td><a href="http://www.fleetstreetltd.co.uk/images/veh-pic/<? echo "$pic"; ?>"><? echo "$pic"; ?></a></td>
<td><b><? echo "$make"; ?></b></td>
<td><? echo "$model"; ?></td>
<td align="center"><? if($stock == 1) { echo "Yes"; } else { echo "No"; }?></td> 
<td><? echo "$product"; ?></td>
<td align="center"><? echo "$initial"; ?></td>
<td align="center"><? echo "$term"; ?></td>
<td align="center"><? echo "$mileage"; ?></td>
<td align="center"><? if($maint == 1) { echo "Yes"; } else { echo "No"; }?></td>
<td align="center"><? if($pch == 1) { echo "Yes"; } else { echo "No"; }?></td>
<td align="center"><b>&pound;<? echo "$rental"; ?></b></td>
<td align="center">&pound;<? echo "$comms"; ?></td>
<td align="center"><? echo "$co2"; ?></td>
<td align="center"><? echo "$mpg"; ?></td>
<td align="center"><? echo "$expire"; ?></td>
<td align="center"><? echo "$source"; ?></td>

<td><a href="update.php?id=<? echo "$id" ?>"><img src="../images/edit.png" alt="Edit" title="Edit" /></a></td>
<td><a href="delete.php?id=<? echo "$id" ?>"><img src="../images/delete.png" alt="Delete" title="Delete" /></a></td>
</tr>
<?
++$i;
} 
echo "</table>";
?>

<br /><br />
<a href="mysql_to_csv.php">Export to CSV</a><br /><br />

<? include('../footer.php'); ?>

</body>
