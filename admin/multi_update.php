<? include ("offhead.php"); ?>

<h2>Updated Offers</h2>

<?php

mysql_connect("213.171.219.91","fleetstreet","Fleet684!");
mysql_select_db("fleetstreet") or die("Unable to select database");
 
$size = count($_POST['make']);
 
$i = 0;
while ($i < $size) {
	$pic= $_POST['pic'][$i];
	$make= $_POST['make'][$i];
	$model= $_POST['model'][$i];
	$product= $_POST['product'][$i];
	$term= $_POST['term'][$i];
	$mileage= $_POST['mileage'][$i];
	$maint= $_POST['maint'][$i];
	$stock= $_POST['stock'][$i];
	$pch= $_POST['pch'][$i];
	$rental= $_POST['rental'][$i];
	$comms= $_POST['comms'][$i];
	$co2= $_POST['co2'][$i];	
	$mpg= $_POST['mpg'][$i];
	$expire= $_POST['expire'][$i];
	$source= $_POST['source'][$i];
	$id = $_POST['id'][$i];
 
	$query = "UPDATE offers SET 
	pic = '$pic',
	make = '$make',
	model = '$model',
	product = '$product',
	term = '$term',
	mileage = '$mileage',
	maint = '$maint',
	stock = '$stock',
	pch = '$pch',
	rental = '$rental',
	comms = '$comms',
	co2 = '$co2',
	mpg = '$mpg',
	expire = '$expire',
	source = '$source' WHERE id = '$id' LIMIT 1";
	mysql_query($query) or die ("Error in query: $query");
	echo "$id $make $model<br /><br /><em>Updated!</em><br /><br />";
	++$i;
}
?>