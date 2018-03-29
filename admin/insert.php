<?

include ("offhead.php");

include("../dbinfo.inc.php");
mysql_connect("localhost",$username,$password);
@mysql_select_db($database) or die( "Unable to select database"); 


$id=$_POST['id'];
$pic=$_POST['pic'];
$make=$_POST['make'];
$model=$_POST['model'];
$product=$_POST['product'];
$initial=$_POST['initial'];
$term=$_POST['term'];
$mileage=$_POST['mileage'];
$maint=$_POST['maint'];
$stock=$_POST['stock'];
$pch=$_POST['pch'];
$rental=$_POST['rental'];
$comms=$_POST['comms'];
$co2=$_POST['co2'];
$mpg=$_POST['mpg'];
$expire=$_POST['expire'];
$source=$_POST['source'];


$query = "INSERT INTO offers VALUES ('','$pic','$make','$model','$product','$initial','$term','$mileage','$maint','$stock','$pch','$rental','$comms','$co2','$mpg','$expire','$source')";
mysql_query($query);

echo "Offer ";
echo "$id";
echo " Added. (";
echo "$make $model".")<br /><br />";
echo "http://www.fleetstreetltd.co.uk/forms/get-a-quote.php?id=";
echo "$id";

mysql_close();
?> 