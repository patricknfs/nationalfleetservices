<table id="enqstats">

<tr><td><b>Type</b></td><td><b>Count</b></td></tr>

<tr><td>
<?
//Count enquiries with no owner
$querys = "SELECT en_owner, COUNT(en_owner) FROM enquiries WHERE en_reminder <= CURdate() AND `en_reminder` <> 0 AND en_owner LIKE '$theowner' GROUP BY en_owner";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){
?>
Reminders Today:</td><td> <a href="http://www.fleetstreetltd.co.uk/connect"><? echo $row['COUNT(en_owner)'] ?> Due</a>
<? } ?>
</td></tr>

<tr><td>
<?
//Count enquiries with no owner
$querys = "SELECT en_owner, COUNT(en_owner) FROM enquiries WHERE en_owner LIKE '' GROUP BY en_owner";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){
?>
Available Enquiries:</td><td> <a href="http://www.fleetstreetltd.co.uk/connect"><? echo $row['COUNT(en_owner)'] ?> New</a>
<? } ?>
</td></tr>

<tr><td>
<?
//Count LIVE enquiries with you as owner
$querys1 = "SELECT COUNT(en_owner) FROM enquiries WHERE en_archived = 0 AND en_owner LIKE '$theowner'";

$results1 = mysql_query($querys1) or die(mysql_error());

while($row1 = mysql_fetch_array($results1)){
?>
Live Enquiries:</td><td> <a href="http://www.fleetstreetltd.co.uk/connect/live"><? echo $row1['COUNT(en_owner)'] ?></a>
<? } ?>
</td></tr>

<tr><td>
<?
//Count ARCHIVED enquiries with you as owner
$querys2 = "SELECT COUNT(en_owner) FROM enquiries WHERE en_archived = 1 AND en_owner LIKE '$theowner'";

$results2 = mysql_query($querys2) or die(mysql_error());

while($row2 = mysql_fetch_array($results2)){
?>
Archived Enquiries:</td><td> <a href="http://www.fleetstreetltd.co.uk/connect/archived"><? echo $row2['COUNT(en_owner)'] ?></a>
<? } ?>
</td></tr>

</table>