

<table id="enqstats">

<tr><td><b>Type</b></td><td><b>Count</b></td></tr>

<tr><td>
<?
//Count Reminders due today
$querys = "SELECT en_owner, COUNT(en_owner) FROM enquiries WHERE en_reminder <= CURdate() AND `en_reminder` <> 0";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){
?>
Reminders Today:</td><td> <a href="index.php"><? echo $row['COUNT(en_owner)'] ?> Due</a>
<? } ?>
</td></tr>

<tr><td>
<?
//Count enquiries with no owner
$querys = "SELECT en_owner, COUNT(en_owner) FROM enquiries WHERE en_owner LIKE '' GROUP BY en_owner";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){
?>
Available Enquiries:</td><td> <a href="index.php"><? echo $row['COUNT(en_owner)'] ?> New</a>
<? } ?>
</td></tr>

<tr><td>
<?
//Count LIVE enquiries with you as owner
$querys1 = "SELECT COUNT(en_owner) FROM enquiries WHERE en_archived = 0";

$results1 = mysql_query($querys1) or die(mysql_error());

while($row1 = mysql_fetch_array($results1)){
?>
Live Enquiries:</td><td> <a href="enqlist.php"><? echo $row1['COUNT(en_owner)'] ?></a>
<? } ?>
</td></tr>

<tr><td>
<?
//Count ARCHIVED enquiries with you as owner
$querys2 = "SELECT COUNT(en_owner) FROM enquiries WHERE en_archived = 1";

$results2 = mysql_query($querys2) or die(mysql_error());

while($row2 = mysql_fetch_array($results2)){
?>
Archived Enquiries:</td><td> <a href="enqlist.php?status=a"><? echo $row2['COUNT(en_owner)'] ?></a>
<? } ?>
</td></tr>

<tr><td><b>User</b></td><td><b>Count</b></td></tr>

<?
//Count enquiries with no owner
$querys = "SELECT en_owner, COUNT(en_owner) FROM enquiries GROUP BY en_owner";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){
?>
<tr><td><? echo $row['en_owner'] ?></td><td><a href="index.php"><? echo $row['COUNT(en_owner)'] ?></a></td></tr>
<? } ?>

<tr><td><b>Stage</b></td><td><b>Count</b></td></tr>

<?
//Count enquiries with no owner
$querys = "SELECT en_stage, COUNT(en_stage) FROM enquiries GROUP BY en_stage";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){
?>
<tr><td><? echo $row['en_stage'] ?></td><td><a href="index.php"><? echo $row['COUNT(en_stage)'] ?></a></td></tr>
<? } ?>

</table>