<?php
include('header.php');
?>

<script type=text/javascript>
function getowned() { 
if (confirm("Are you sure you want to claim this enquiry?")) 
return true; 
else 
return false; 
}
</script>

<?php
/* Connecting, selecting database */
$link = mysql_connect('localhost', "fs-admin", "camp=Flam");
@mysql_select_db('db_fleetstreet')
   or die("Could not connect : " . mysql_error());
   

   $status = $_GET['status'];
   $sortfield = $_GET['sortfield'];
   $theowner = $_SESSION['username'];


    if ($status == "")
    {
        $qstatus = "en_archived = 0";
    }
    elseif ($status == "a")
    {
        $qstatus = "en_archived = 1";
    }
    else
    {
        echo "<h2>Enquiries - all status ".$status."</h2>\n";
        $qstatus = "en_status =".$status;
    }


if ($sortfield == "")
$sortfield = "en_reminder";


    $query = "SELECT DISTINCT en_no, en_ApplicantCompany, en_ApplicantForenameName, en_ApplicantSurname, en_VehicleMake, en_ApplicantTelephone, en_ProposalType, en_owner, en_reminder, en_reminder_hour, en_timestamp, en_ReminderNote FROM `enquiries` WHERE en_owner = '' ORDER by ".$sortfield." ASC;";
    
	$result = mysql_query($query, $link) or die ("Query failed : ".mysql_error());

    /* Printing results in HTML */
?>



<?
if(isset($_SESSION['username'])) {
echo "<div class='success_message'>Welcome back, you are logged in as <b>" . $_SESSION['username'] . "</b> under IP address: <b>" . $_SERVER["REMOTE_ADDR"] . "</b></div>";
}
?>

<br />

<?



?>

<?
if (mysql_num_rows($result) <> 0)
{
include('new_enq.php');
}else{
echo "<br /><h4>No New Enquiries</h4>";
}
?>


<?php
/* Connecting, selecting database */
$link = mysql_connect('localhost', "fs-admin", "camp=Flam");
@mysql_select_db('db_fleetstreet')
   or die("Could not connect : " . mysql_error());
   
$theowner = $_SESSION['username'];

$query = "SELECT en_no, en_ApplicantCompany, en_ApplicantForenameName, en_ApplicantSurname, en_VehicleMake, en_VehicleModel, en_ProposalType, en_reminder, en_ReminderNote, en_reminder_hour, en_owner FROM `enquiries` WHERE en_reminder <= CURdate() AND `en_reminder` <> 0 ORDER by en_reminder, en_reminder_hour ASC";
$result = mysql_query($query) or die ("Query failed : ".mysql_error());
if (mysql_num_rows($result) <> 0)
{

echo "<br /><h4>Enquiry Reminders Due Today</h4> \n";
echo "<table id=reminder> \n";

echo "<tr width=6%><th>ID</th> \n";
echo "<th width=17%>Action Due</th> \n";
echo "<th width=44%>Customer</th> \n";
echo "<th width=23%>Vehicle</th> \n";
echo "<th width=10%>Type</th></tr> \n";

while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
{
$vehicle = $line['en_VehicleMake'];
if (strlen($vehicle) > 48) {
$vehicle = substr($vehicle,0,48)."<br>".substr($vehicle,48);
}

// If Company set then add syntax to $name
if ($line['en_ApplicantCompany'] <> '') {
	$name = $line['en_ApplicantCompany'].' - '.$line['en_ApplicantForenameName'].' '.$line['en_ApplicantSurname'];
}else{
	$name = $line['en_ApplicantForenameName'].' '.$line['en_ApplicantSurname'];
};


if (strlen($name ) > 35) {
$name = substr($name,0,35)."<br>".substr($name,35);
}
echo ('<tr><td><a href="http://www.fleetstreetltd.co.uk/connect/admin/enquiry-'.$line['en_no'].'">'.$line['en_no'].'</a></td><td><b>'.date("d/m/y",strtotime($line['en_reminder'])).' - '.$line['en_reminder_hour'].':00</b></td><td><a title="header=[] body=['.$line['en_ReminderNote'].']" href="http://www.fleetstreetltd.co.uk/connect/admin/enquiry-'.$line['en_no'].'">'.$name.'</a></td><td>'.$vehicle.'</td><td>'.$line['en_ProposalType'].'</td></tr>'."\n");
}

echo "</table> \n";
} else {
echo "<br /><h4>You have no reminders due today</h4>";


//Count enquiries with no owner
$querys = "SELECT en_owner, COUNT(en_owner) FROM enquiries WHERE en_owner LIKE '' GROUP BY en_owner";
$results = mysql_query($querys) or die(mysql_error());

while($row = mysql_fetch_array($results)){

?>
There are currently <a href="http://www.fleetstreetltd.co.uk/connect/admin"><? echo $row['COUNT(en_owner)'] ?> available enquiries</a>
<?
}}
?>
</div>

<div id="rightcolumn">
<? include('rightcolumn.php'); ?>
</div>

<div id="footer">

<? include('footer.php'); ?>

</div>
</div>
<script src="boxover.js"></script>
</body>
</html>