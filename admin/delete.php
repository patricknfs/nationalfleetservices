<?
include ("offhead.php");

include("../dbinfo.inc.php");
mysql_connect("213.171.219.91",$username,$password);

$query="DELETE FROM offers WHERE id='{$_GET['id']}'";
@mysql_select_db($database) or die( "Unable to select database");
mysql_query($query);

echo "<p class=added>";
echo "Offer Deleted.";
echo "</p>";

mysql_close();
?>