<?
include('header.php');
?>



<?

$link = mysql_connect('localhost', "fs-admin", "camp=Flam");
@mysql_select_db('db_fleetstreet')
   or die("Could not connect : " . mysql_error());
   
$querys = "SELECT en_owner, en_no FROM enquiries WHERE en_no='".$_GET['en_no']."'";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){

if($row['en_owner'] == "") {

$results = mysql_query("UPDATE enquiries SET en_owner='".$_SESSION['username']."', en_reminder='".date("y/m/d")."', en_reminder_hour='01' WHERE en_no='".$_GET['en_no']."'") 
or die(mysql_error());  

header("Location:enqedit.php?enqno=".$_GET['en_no']."");
} else {

echo '<div style="text-align: center;"><h3>Oops! this enquiry has already been snapped up by '.$row['en_owner'].'</h3><br /><br />';
echo '<img src="img/road_runner.jpg" /></div>';
}}
?>

</div>

<div id="rightcolumn">

</div>

<div id="footer">

<?
/* Free resultset */
mysql_free_result($result);

/* Closing connection */
mysql_close($link);
?>

</div>
</div>
</body>
</html>