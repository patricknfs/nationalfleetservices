<?
include('header.php');
?>

<script type=text/javascript>
function getowned() { 
if (confirm("Are you sure you want to own this enquiry?")) 
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
   $wotsup = $_GET['wotsup'];
   $sortfield = $_GET['sortfield'];
   $theowner = $_SESSION['username'];
   
//wotsup display message
if($wotsup) {
	echo '<p class=success_message><b>Enquiry '.$wotsup.' Successfully</b></p><br />';
} else {
}



    if ($status == "")
    {
        echo "<h4>Live Enquiries</h4>\n";
        $qstatus = "en_archived = 0";
    }
    elseif ($status == "a")
    {
        echo "<h4>Archived Enquiries</h4>\n";
        $qstatus = "en_archived = 1";
    }
    else
    {
        echo "<h2>Enquiries - all status ".$status."</h2>\n";
        $qstatus = "en_status =".$status;
    }


if ($sortfield == "")
$sortfield = "en_reminder";


    $query = "SELECT DISTINCT en_no, en_ApplicantCompany, en_ApplicantForenameName, en_ApplicantSurname, en_ApplicantTelephone, en_VehicleMake, en_owner, en_reminder, en_reminder_hour, en_timestamp, en_ReminderNote FROM `enquiries` WHERE ".$qstatus." AND en_owner = '$theowner' ORDER by ".$sortfield." ASC;";
    
	$result = mysql_query($query, $link) or die ("Query failed : ".mysql_error());

    /* Printing results in HTML */
?>

<?
if (mysql_num_rows($result) <> 0)
{
?>


<table id="reminder">
	<tr>
        <th width="6%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_no" title="Click to sort on this column">ID</a>
        </th>
        <th width="42%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_ApplicantForenameName" title="Click to sort on this column">Enquirer</a>
        </th>
        <th width="23%">
            <a href="enqlist.php?status=<?=$status?>&theowner=<?=$theowner?>&sortfield=en_VehicleMake" title="Click to sort on this column">Vehicle</a>
        </th>
        <th width="16%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_reminder" title="Click to sort on this column">Reminder</a>
        </th>
        <th width="13%">
            <a href="enqlist.php?status=<?=$status?>&sortfield=en_timestamp" title="Click to sort on this column">Updated</a>
        </th>
    </tr>
    <?php
    
    while ($owners = mysql_fetch_array($result, MYSQL_ASSOC))
    {
		echo '<tr>';
        echo '<td><a href="enqedit.php?enqno='.$owners['en_no'].'">'.$owners['en_no'].'</a></td>';
		echo '<td><b>'.$owners['en_ApplicantCompany'].'</b>&nbsp;'.$owners['en_ApplicantForenameName'].'&nbsp;'.$owners['en_ApplicantSurname'].'</td>';
		echo '<td>'.$owners['en_VehicleMake'].'</td>';
		echo '<td>'.date("d/m/y",strtotime($owners['en_reminder'])).' '.$owners['en_reminder_hour'].':00</td>';
		echo '<td>'.date("d/m/y",strtotime($owners['en_timestamp'])).'</td>';
		echo '</tr>';
		
        echo ("\n");
    }
    ?>
</table>

<?
}else{
echo "<br /><h4>No Enquiries Here!</h4>";
}
?>

</div>

<div id="rightcolumn">
<? include('rightcolumn.php'); ?>
</div>

<div id="footer">

<? include('footer.php'); ?>

</div>
</div>
</body>
</html>